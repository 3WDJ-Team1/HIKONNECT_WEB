<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div style=" margin: auto; width: 95%; background-color: white; margin-top: 30px; margin-bottom: 30px; box-shadow: 5px 5px 10px 1px #cecece;">
        <div style="height: 50px; background-color: white"></div>
        <div style="margin: 0; height: 50px; background-color: #24B674; color: white; text-align: center;" class="row">
            <div class="col-3">
                <p style="margin: 5px; font-size: 2em; font-family: 'Do Hyeon', sans-serif;">그룹이름/관리자명</p>
            </div>
            <div class="col-5" >
                <p style="margin: 5px; font-size: 2em; font-family: 'Do Hyeon', sans-serif; text-align: left;">모집내용</p>
            </div>
            <div class="col-1">
                <p style="margin: 5px; font-size: 2em; font-family: 'Do Hyeon', sans-serif; vertical-align: middle;">최대인원수</p>
            </div>
            <div class="col-1">
                <p style="margin: 5px; font-size: 2em; font-family: 'Do Hyeon', sans-serif;">최소인원수</p>
            </div>
            <div class="col-2">
            </div>
        </div>
        <card style="margin: 20px;" id="ccard" v-for="(item, key) in list" :key="key">
            <div class="row" id="groupListContainer">
                <div class="col-3">
                    <h2 style="margin: 8px 8px 0; font-family: 'Do Hyeon', sans-serif; padding-left: 30px;">{{ item.title }}</h2>
                    <h4 style="margin: 5px 40px 20px; font-family: 'Do Hyeon', sans-serif; color: #9A9A9A;">관리자: {{ item.nickname }}</h4>
                </div>
                <div class="col-5">
                    <h4 style="margin: 0; font-family: 'Do Hyeon', sans-serif; float: left; padding-top: 10px;">{{ item.content }}</h4>
                </div>
                <div class="col-1" style="text-align: center;">
                    <h2 style="line-height: 100px; margin: 0; font-family: 'Do Hyeon', sans-serif; display:inline-block;">
                        {{ item.min_member }}명
                    </h2>
                </div>
                <div class="col-1" style="text-align: center;">
                    <h2 style="line-height: 100px; margin: 0; font-family: 'Do Hyeon', sans-serif; display:inline-block;">
                        {{ item.max_member }}명
                    </h2>
                </div>
                <div class="col-2" style="text-align: center; margin-top: 10px;">
                    <div class="move_box">
                        <a
                                style="cursor:pointer; font-size: 25px; font-family: 'Do Hyeon', sans-serif;"
                                class="nav-link"
                                v-if="!isLogined"
                                @click="moveGroupPage(item)"
                        >
                            바로가기
                        </a>
                    </div>
                </div>
            </div>
        </card>

        <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
             <span slot="no-more" style="font-family: 'Do Hyeon', sans-serif; font-size: 30px;">
                그룹 리스트가 없습니다 :(
             </span>
        </infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import Card from '../Cards/Card'
    import groupMake from './group_make'

    export default {
        data() {
            return {
                userid: sessionStorage.getItem('userid'),
                // 검색시 default값 a
                select: "a",
                // 검색시 default값 a
                input: "a",
                // 무한 스크롤 시 스크롤이 얼마나 내려갔는지 표시
                list_num: 0,
                // 리스트를 보여줄 때 카드에 들어갈 정보들을 모두 담아놓은 배열
                list: [],
                toGroupDetail: '/group',
            };
        },
        created() {
            // 그룹 만든 이후 리스트 다시 불러오기
            this.$EventBus.$on('group_make_sign', (sign) => {
                this.list = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
            // 리스트 다시 불러오기
            this.$EventBus.$on('groupListSearch', (sel, input) => {
                this.select = sel;
                this.input = input;
                this.list = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
        },
        methods: {
            moveGroupPage(item)    {
                this.$router.push(this.toGroupDetail + '/' + item.uuid);
            },
            enterGroup(uuid, verticalAlign, horizontalAlign) {
                // 로그인 되어 있을 경우
                axios.post(this.$HttpAddr + '/member', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: uuid
                }).then(response => {
                    // alert창 띄워주기
                    const notification = {
                        template: "<span><b>그룹에 참가되었습니다.</b></span>"
                    };
                    this.$notifications.notify(
                        {
                            component: notification,
                            icon: 'nc-icon nc-app',
                            horizontalAlign: horizontalAlign,
                            verticalAlign: verticalAlign,
                            type: 'success'
                        });
                    this.joinButton = false;
                });
            },
            /**
             * 그룹 리스트 받아오기
             * @author      Jiyoon Lee, Sungeun Kang <kasueu0814@gmail.com>
             * @augments    $state state of infinite-loading */
            infiniteHandler($state) {
                this.axios.post(this.$HttpAddr + '/groupList',
                    {
                        select: this.select,
                        input: this.input,
                        page: this.list_num
                    }).then(response => {
                    if (response) {
                        this.list = this.list.concat(response.data);
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
        },
        components: {
            Card,
            InfiniteLoading,
            groupMake
        }
    }
</script>
<style>
    #ccard .card-body {
        padding-bottom: 0;
    }
    .theme--dark .btn:not(.btn--icon):not(.btn--flat), .application .theme--dark.btn:not(.btn--icon):not(.btn--flat) {
        width: 110px;
        height: 110px;
    }
    .btn--floating .btn__content {
        font-size: 25px;
    }
    select.form-control:not([size]):not([multiple]) {
        height: 50px;
        font-size: 20px;
    }
    .form-control {
        height: 50px;
        font-size: 20px;
    }
    .move_box {
              border: 2px solid #8ED9E9;
              text-align: center;
              padding-right: 10px;
              padding-left: 10px;
              margin-left: 3px;
              margin-top:10px;
              -webkit-border-top-right-radius: 40px 30px;
              -webkit-border-top-left-radius: 40px 30px;
              -webkit-border-bottom-right-radius: 40px 30px;
              -webkit-border-bottom-left-radius: 40px 30px;
          }

    .move_box:hover {
        background-color: #1dc7ea;
    }
</style>
