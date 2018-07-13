<!--
    @file   NoticeListUp.vue
    @brief  A component to show notices in group
    @author Sungeun Kang <kasueu0814@gmail.com>, Jiyoon Lee <jiyoon3421@gmail.com>
    @todo   insert buttons
 -->
<template>
    <div>
        <!-- 리스트의 카드 클릭시 상세 정보 띄우기 모달-->
        <sweet-modal ref="write" blocking>
            <noticeModal :noticeItem="noticeItem" v-if="updateSign"></noticeModal>
            <updateModal :updateItem="updateItem" v-if="!updateSign"></updateModal>
        </sweet-modal>
        <!-- 글쓰기 버튼
                position이 그룹에 참가 된 멤버나 관리자 일 경우에만 보여지도록 컨트롤 -->
        <router-view
                v-if="position"
                name="write"></router-view>
        <card id="cardBox" style="margin: 10px;" v-for="notice in notices" :key="notice.uuid" >
            <div class="row" id="groupListContainer">
                <div style="padding: 0px;" class="col-md-12" id="noticeCard" @click="noticeModal(notice)">
                    <h3 style="display:inline-block; padding-left: 25px;">{{ notice.title }}</h3>
                    <h6 style="color: #9A9A9A; display:inline-block;">作成者: {{ notice.writer }}</h6>
                    <h5 style="display:inline-block; float: right; padding-top: 30px; padding-right: 25px;">作成日: {{ notice.created_at }}</h5>
                </div>
            </div>
        </card>
        <!-- 무한 스크롤 -->
        <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
             <span slot="no-more" style="font-size: 30px; font-family: 'Do Hyeon', sans-serif;">
                公知事項がありません。 :(
             </span>
        </infinite-loading>
    </div>
</template>

<script>
    // 무한 스크롤
    import InfiniteLoading from 'vue-infinite-loading';
    // 카드
    import Card from '../../Cards/Card'
    // 상세 페이지 모달
    import noticeModal from './noticeModal'
    // 수정 페이지 모달
    import updateModal from './updateModal'
    export default {
        components: {
            InfiniteLoading,
            Card,
            noticeModal,
            updateModal
        },
        data: () => ({
            /**
             * list_num     (Integer)       무한스크롤 시 페이지 넘버
             * notices      (Array)         공지사항 카드에 들어갈 item들의 배열
             * groupId      (String)        그룹 아이디
             * position     (Boolean)       현재 사용자의 신분(그룹에 참여되어 있는지 아닌지)
             */
            list_num: 0,
            notices: [],
            groupId: "",
            position: false,
            updateSign: true,
            updateItem: {},
            noticeItem: {}
        }),
        created() {
            // url에서 그룹 아이디 받아오기
            this.groupId = this.$route.params.groupid;
            // 공지사항 수정버튼 클릭시 공지사항 수정 모달 띄워지기
            this.$EventBus.$on('updateNoticeSign', (noticeInfo) => {
                this.updateSign = false;
                this.updateItem = noticeInfo;
            });
            // 공지사항이 삭제되었을 경우 공지사항 리스트 재배열 하기
            this.$EventBus.$on('deleteNoticeSign', () => {
                // alert창 띄우기
                const notification = {
                    template: "<span><b>削除完了</b></span>"
                };
                this.$notifications.notify(
                    {
                        component: notification,
                        icon: 'nc-icon nc-app',
                        horizontalAlign: 'center',
                        verticalAlign: 'top',
                        type: 'success'
                    });
                // 공지사항 리스트 초기화
                this.notices = [];
                // 자동완성 페이지 0으로 초기화
                this.list_num = 0;
                // 공지사항 받아오기
                this.infiniteHandler();
            });
            // 공지를 작성한 경우 리스트를 재배열 해야하므로 공지를 작성한 겨우 event가 온다.
            this.$EventBus.$on('newNoticeWrited', () => {
                // 공지사항 리스트 초기화
                this.notices = [];
                // 자동완성 페이지 0으로 초기화
                this.list_num = 0;
                // 공지사항 받아오기
                this.infiniteHandler();
            });

            // 현재 사용자의 포지션을 받아오는 event
            this.$EventBus.$on('positionGet', (position) => {
                this.position = position
            });
        },
        methods: {
            // card 클릭 시 상세 페이지 모달 띄우기
            noticeModal(notice) {
                this.updateSign = true;
                // 상세 페이지 컴포넌트에 정보 보내기
                this.noticeItem = notice
                // 모달 열기
                this.$refs.write.open();
            },
            // 공지사항 배열 서버에서 가지고 오기
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