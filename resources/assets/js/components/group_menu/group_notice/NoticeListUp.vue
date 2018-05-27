<!--
    @file   NoticeListUp.vue
    @brief  A component to show notices in group
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   insert buttons
 -->
<template>
    <div>
        <sweet-modal ref="write" blocking>
            <noticeModal></noticeModal>
        </sweet-modal>

        <router-view
                v-if="position"
                name="write"></router-view>
        <card id="cardBox" style="margin: 10px;" v-for="notice in notices" :key="notice.uuid" >
            <div class="row" id="groupListContainer">
                <div style="padding: 0px;" class="col-md-12" id="noticeCard" @click="noticeModal(notice)">
                    <h3 style="display:inline-block; padding-left: 25px;">{{ notice.title }}</h3>
                    <h6 style="color: #9A9A9A; display:inline-block;">관리자: {{ notice.writer }}</h6>
                    <h5 style="display:inline-block; float: right; padding-top: 30px; padding-right: 25px;">작성일: {{ notice.created_at }}</h5>
                </div>
            </div>
        </card>
        <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
             <span slot="no-more">
                There is no more Hacker News :(
             </span>
        </infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import Card from '../../Cards/Card'
    import noticeModal from './noticeModal'
    export default {
        components: {
            InfiniteLoading,
            Card,
            noticeModal
        },
        data: () => ({
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
            list_num: 0,
            notices: [],
            groupId: "",
            isOwner: false,
            position: false
        }),
        // When this component was created,
        created() {
            // url에서 그룹 아이디 받아오기
            this.groupId = this.$route.params.groupid;
            this.$EventBus.$on('newNoticeWrited', () => {
                this.notices = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
            this.isGroupOwner();
            this.$EventBus.$on('sendPositionInfo', (position) => {
                if(position != 'guest') {
                    this.position = true;
                }
            });
        },
        methods: {
            /**
             * @function    addNotice
             * @brief       send http request to server, and update this.notice
             */
            noticeModal(notice) {
                this.$EventBus.$emit('sendNoticeModal', notice);
                this.$refs.write.open();
            },
            infiniteHandler($state) {
                this.axios.get(this.$HttpAddr + '/list_announce/' + this.groupId + "/" + this.list_num)
                    .then(response => {
                        if (response) {
                            this.notices = this.notices.concat(response.data);
                            $state.loaded();
                            if (response.data.length < 10) {
                                $state.complete();
                            }
                        }
                        else {
                            $state.complete();
                        }
                    });
                this.list_num += 1;
            },
            isGroupOwner() {
                axios.get(this.$HttpAddr + '/isOwner/' + this.groupId + "/" + sessionStorage.getItem('uuid'))
                    .then(response => {
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
            '$route'(to, from) {
                this.groupId = this.$route.params.groupid;
            }
        }
    }
</script>

<style>
    #cardBox .card-body {
        padding: 0px 15px 0px 15px;
    }
    .application--wrap {
        min-height: 0px;
    }
    #cardBox .card-footer {
        padding-left: 25px;
        padding-right: 25px;
    }
    #noticeCard:hover  {
        background-color: #f7f7f8;
    }
</style>