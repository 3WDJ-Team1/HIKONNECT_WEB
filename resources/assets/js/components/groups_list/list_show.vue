<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <card id="cardBox" style="margin: 10px;" v-for="(item, key) in list" :key="key">
            <div class="row" id="groupListContainer">
                <div style="padding: 0px;">
                    <h3 style="display:inline-block; padding-left: 25px;">{{ item.title }}</h3>&nbsp;&nbsp;&nbsp;
                    <h6 style="color: #9A9A9A; display:inline-block;">관리자: {{ item.nickname }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5" style="padding: 0px; padding-top: 18px;padding-left: 25px;">
                    최소인원수: {{ item.min_member }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;최대인원수: {{ item.max_member }}
                </div>
                <div class="col-md-7" id="item7">
                    <button class="btn btn-outline-secondary float-right"
                            @click="moveGroupPage(item)">그룹 페이지로 이동
                    </button>
                </div>
            </div>
            <div slot="footer" class="text-center">
                <h6 style="color: #FF6633; padding-top: 10px; float: left">모집내용:&nbsp;&nbsp;</h6>
                <h6 style="float: left; padding-top: 10px;">{{ item.content }}</h6>
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
</style>
