<!-- 
    @file   NoticeListUp.vue
    @brief  A component to show notices in group
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   insert buttons
 -->
<template>
    <!-- @div#group_notice  the wrapper of notice list -->
    <div class="text-center" id="group_notice">
        <!-- @router-view   'write' floating button -->
        <!--<router-view-->
                <!--v-if="isOwner"-->
                <!--name="write"></router-view>-->
        <router-view
                name="write"></router-view>
        <!-- @div           notice list area -->
        <div>
            <!-- @div       A card of notice
                            notice div are formed automatically by data.notices -->
            <div v-for="notice in notices" :key="notice.uuid">
                <!-- @div   the wrapper of notice card -->
                <div class="card_wrapper">
                    <!-- @div   The title and author of a notice
                                if you click this, b-collapse will be shown. -->
                    <div v-b-toggle ="'n' + notice.uuid" class="m-1">
                        <h3 class="card-title">{{ notice.title }}</h3>
                        <p  class="card-text">writer : {{ notice.nickname }} | hits : {{ notice.hits }}</p>

                    </div>
                    <!-- @div(b-collapse)   The contents of a notice. -->
                    <b-collapse :id="'n' + notice.uuid">
                        <div class  ="notice_text">
                            {{ notice.content }}
                        </div>
                        <!-- @router-view   'delete' button component
                                            porpsNotice will send notice.uuid to children components -->

                        <router-view
                                name="delete"
                                :propsNotice="notice"
                                v-if="isOwner"></router-view>
                        <!-- @router-view   'modify(edit)' button component
                                            porpsNotice will send notice.uuid to children components -->
                        <router-view
                                name="modify"
                                :propsNotice="notice"
                                v-if="isOwner"></router-view>
                    </b-collapse>
                </div>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler" spinner="bubbles"></infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        components: {
            InfiniteLoading,
        },
        data : ()  => ({
            /**
             * groupName    (String)        the name of group
             * notices      (Array)         the array of notices object
             * page         (Integer)       current page of loading
             * size         (Integer)       how much response data we need
             * bottom       (Boolean)       is scroll in bottom of page?
             * loader       (Object)        the Settings for loading icon
             *      loading (Boolean)       is now loading?
             *      color   (String)        color of icon
             *      margin  (String)        margin of each div of icon
             *      size    (String)        size of each div
             */
            // groupName and notices will be changed by http response.
            groupName   : "3WDJ-Team1",
            notices     : [
                // the type of notices is 'object' certainly.
            ],
            page        : 0,
            size        : 5,
            bottom      : false,
            loader      : {
                loading : true,
                color   : "#4df1e1",
                margin  : "2px",
                size    : "10px"
            },
            groupId: "",
            isOwner: false,
        }),
        // When this component was created,
        created() {
            // url에서 그룹 아이디 받아오기
            this.groupId = this.$route.params.groupid;
            this.$EventBus.$on('newNoticeWrited', () => {
                this.$router.push('/group/' + this.groupId);
            });
            this.isGroupOwner();
        },
        methods: {
            /**
             * @function    bottomVisible
             * @brief       check is bottom visible with the value of scroll position
             */
            bottomVisible: function () {
                const scrollY       = window.scrollY;
                const visible       = document.documentElement.clientHeight;
                const pageHeight    = document.documentElement.scrollHeight;
                const bottomOfPage  = visible + scrollY + 1 >= pageHeight;
                return bottomOfPage || pageHeight < visible;
            },
            /**
             * @function    addNotice
             * @brief       send http request to server, and update this.notice
             */
            infiniteHandler($state) {
                let url = this.$HttpAddr + '/notice/' + this.groupId + "/" + ((this.page - 1) * this.size + 10);
                axios.get(url)
                    .then(response => {
                        if (response) {
                            console.log(response.data);
                            this.notices = this.notices.concat(response.data);
                            $state.loaded();
                            // 백엔드에서 넘어오는 값에 같은 값이 잇음!
                        }else {
                            $state.complete();
                        }
                    });
                this.page++;
            },
            isGroupOwner() {
                axios.get(this.$HttpAddr + '/isOwner/' + this.groupId + "/" + sessionStorage.getItem('uuid'))
                    .then( response => {
                        this.$EventBus.$emit('isOwner', response);
                        this.isOwner = response.data;
                    });
            },
        },
        watch: {
            /**
             * @function    bottom
             * @argument    this.bottom
             * @brief       watch the value of this.bottom.
             *              if the value is true, addNotice function is invoked.
             */
            '$route' (to, from) {
                this.groupId = this.$route.params.groupid;
            }
        }
    }
</script>

<style>
    /* class for card wrapper */
    .card_wrapper {
        display: inline-block;
        width: 100%;
        margin: 0.3%;
        padding: 3%;
        border: 2px solid whitesmoke;
        background-color: white;
    }
    /* class for inner text of notice cards */
    .notice_text {
        width: 90%;
        margin: 0 auto;
        word-break: keep-all;
    }
    #group_notice {
        width: 98%;
        margin-bottom: 8%;
        margin: 0 auto;
    }
    .loader {
        margin-top: 2%
    }
</style>