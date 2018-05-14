<template>
    <div>
        <card v-for="(item, key) in list" :key="key">
            <div class="row" id="row">
                <div class="col-md-12">
                    <h3>{{ item.title }}</h3>&nbsp;&nbsp;&nbsp;<h6 style="color: #9A9A9A;">관리자: {{ item.nickname }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    최소인원수: {{ item.min_members }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;최대인원수: {{ item.max_members }}
                </div>
                <div class="col-md-7">
                    <button class="btn btn-outline-secondary float-right">그룹 정보 수정</button>
                    <button class="btn btn-outline-secondary float-right" v-if="joinButton" @click="showAlert('top', 'center', 'join', item.uuid)">
                        그룹 참가하기
                    </button>
                    <button class="btn btn-outline-secondary float-right" @click="showAlert('top', 'center', 'move', item.uuid)">그룹 페이지로 이동</button>
                    <!--<v-btn flat v-if="updateVisible(item.uuid)">그룹 정보 수정</v-btn>-->
                </div>
            </div>
            <div slot="footer" class="text-center">
                <h7 style="color: #FF6633;">모집내용:</h7>&nbsp;&nbsp;&nbsp;{{ item.content }}
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
    export default {
        data() {
            return {
                position: '',
                // 그룹을 만들있으면 true 아니면 false
                group_make_sign: false,
                // 그룹관리자가 로그인 되어 있으면 true 아니면 false
                ownerLogined: false,
                // 등산 참가 버튼
                joinButton: true,
                // 카드에서 클릭시 열고 닫힘 표시
                show: false,
                // 검색시 default값 a
                select: "a",
                // 검색시 default값 a
                input: "a",
                // 무한 스크롤 시 스크롤이 얼마나 내려갔는지 표시
                list_num: 0,
                // 리스트를 보여줄 때 카드에 들어갈 정보들을 모두 담아놓은 배열
                list: [],
                // 다른 페이지로 이동을 위해 변수지정
                toGroupDetail: '/group',
            };
        },
        created() {
            // 그룹 만든 이후 리스트 다시 불러오기
            this.$EventBus.$on('group_make_sign', (sign) => {
                this.group_make_sign = sign;
                this.list = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
            // 그룹명으로 검색 후 리스트 다시 불러오기
            this.$EventBus.$on('input_name', (sel, mountain) => {
                this.select = sel;
                this.input = mountain;
                this.list = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
            // 작성자명으로 검색 후 리스트 다시 불러오기
            this.$EventBus.$on('input_writer', (sel, writer) => {
                this.select = sel;
                this.input = writer;
                this.list = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
        },
        methods: {
            gogo(index) {
              this.show[index] = !this.show[index];
            },
            // updateVisible(uuid) {
            //     if (sessionStorage.userid != undefined) {
            //         // 로그인 되어 있으면
            //         this.axios.post('http://172.26.2.88:8000/api/checkMember', {
            //             uuid: uuid,
            //             userid: sessionStorage.getItem('userid'),
            //         }).then(response => {
            //             console.log(response.data)
            //             if (response.data == 'owner') {
            //                 this.joinButton = false;
            //                 return true;
            //             } else if (response.data == 'member') {
            //                 this.joinButton = false;
            //                 return false;
            //             }
            //         });
            //     }
            // },
            // 조인버튼 누를 시 로그인 되어 있어야 사용가능
            showAlert(verticalAlign, horizontalAlign, ss, uuid) {
                // 로그인 안 되어 있을 경우
                if (sessionStorage.getItem('userid') == undefined) {
                    // alert창 띄워주기
                    const notification = {
                        template: "<span><b>로그인 후 사용가능합니다.</b></span>"
                    };
                    this.$notifications.notify(
                        {
                            component: notification,
                            icon: 'nc-icon nc-app',
                            horizontalAlign: horizontalAlign,
                            verticalAlign: verticalAlign,
                            type: 'warning'
                        })
                } else {
                    if (ss == 'join') {
                        // 로그인 되어 있을 경우 버튼 참가신청 수락
                        this.enterGroup(uuid)
                    }
                    else if (ss == 'move') {
                        // 그룹 페이지로 이동
                        this.$router.push(this.toGroupDetail + '/' + uuid)
                    }
                }
            },
            enterGroup(uuid) {
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
                this.list_num += 10;
            },
        },
        components: {
            Card,
            InfiniteLoading,
        }
    }
</script>
<style>
    .col-md-12 {
        padding: 0px;
    }
    .card > *:first-child:not(.btn) {
        padding: 0px;
    }
    h1, .h1, h2, .h2, h3, .h3, h4, .h4 {
        font-weight: 300;
        margin: 20px 0 15px;
        display: inline-block;
    }
    .card h6 {
        display: inline-block;
    }
    .col-md-8 {
        padding: 0px;
    }
    .col-md-7 {
        padding: 0px;
    }
    .col-md-5 {
        padding: 0px;
        padding-top: 18px;
    }
</style>
