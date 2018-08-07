<!-- 
    @file   GroupMemberList.vue
    @brief  A component of group member list
    @author Sungeun Kang <kasueu0814@gmail.com>, Jiyoon Lee <jiyoon3421@gmail.com>
    @todo   update everything
 -->
<template>
    <div>
        <div class="row" style="height: 60px; background-color: #22b573; margin-top: 40px; margin-bottom: 20px;">
            <div class="col-2" style="color: white; font-size: 1.8rem; text-align: center; line-height: 60px;">ポジション</div>
            <div class="col-2"></div>
            <div class="col-5" style="color: white; font-size: 1.8rem; text-align: center; line-height: 60px;">ニックネーム</div>
            <div class="col-3"></div>
        </div>
        <b-card
                style="border-radius: 0px; margin: auto; margin-bottom: 15px; width: 98%;"
                class='member_list_card'
                v-for="userData in leaderData"
                :key="userData.nickname">
            <div class="row" style="width: 100%; margin-left: 0.2%">
                    <div class="col-2">
                        <h2 style="float: left; font-family: 'Gothic A1', sans-serif; color: #42d0ed;">リーダー</h2>
                    </div>
                    <div
                            style="padding: 2px;"
                            class="col-2">
                        <v-avatar
                                style="float: left;"
                                size="100"
                                slot="activator"
                        >
                            <img :src="'http://hikonnect.ga:3000/images/UserProfile/' + userData.userid + '.jpg'">
                        </v-avatar>
                    </div>
                    <div
                            class="col-5">
                        <h2 style="margin; 0; line-height: 35px; font-family: 'Gothic A1', sans-serif; text-align: center;">{{ userData.nickname
                            }}</h2>
                    </div>
                    <div
                            class="col-3">
                        <button v-b-toggle="'n' + userData.nickname" v-if="position == 'enter'" class="btn btn-info"  style="float: right; margin-top: 26px; padding: 0; margin-right: 0.9%; width: 150px; height: 40px;">
                            <span style="font-family: 'Gothic A1', sans-serif; font-size: 20px;">ユーザー情報</span>
                        </button>
                    </div>
                </div>
            <b-collapse
                    v-if="position"
                    :id="'n' + userData.nickname"
                    accordion="member_list"
                    role="tabpanel">
                <b-card-body>
                    <member_detail :userData="userData">
                    </member_detail>
                </b-card-body>
            </b-collapse>
        </b-card>
        <waitingMember :waitingMember="waitingMember" v-if="owner == 'owner'"></waitingMember>
        <b-card
                style="margin: auto; width: 98%; margin-bottom: 15px;"
                class='member_list_card'
                v-for="userData in memberList"
                :key="userData.nickname">
            <div>
                <div class="row" >
                    <div
                            class="col-2">
                        <h2 style="float: left; margin-left: 20px; font-family: 'Gothic A1', sans-serif; color: #ff92bb;">メンバー</h2> 
                    </div>
                    <div
                            style="padding-bottom: 2px;"
                            class="col-2">
                        <v-avatar
                                size="100"
                                slot="activator"
                        >
                            <img :src="'http://hikonnect.ga:3000/images/UserProfile/' + userData.userid + '.jpg'">
                        </v-avatar>
                    </div>
                    <div
                            class="text-center col-5">
                        <h2 style="line-height: 60px; font-family: 'Gothic A1', sans-serif; margin: 18px 0 15px;">{{ userData.nickname
                            }}</h2>
                    </div>
                    <div
                            class="text-center col-3 row">
                            <div class="col-6">
                                <button v-if="owner == 'owner'" @click="outGroup(userData)" type="submit"
                                style="margin-top: 26px; padding: 0; width: 150px; height: 40px;"
                                class="btn btn-warning btn-fill">
                                    <span style="font-family: 'Gothic A1', sans-serif; font-size: 20px;">追放する</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button v-b-toggle="'n' + userData.nickname"
                                style="margin-top: 26px; padding: 0; width: 150px; height: 40px;"
                                v-if="position == 'enter'" class="btn btn-info">
                                    <span style="font-family: 'Gothic A1', sans-serif; font-size: 20px;">ユーザー情報</span>
                                </button>
                            </div>
                    </div>
                </div>
            </div>
            <b-collapse
                    v-if="position"
                    :id="'n' + userData.nickname"
                    accordion="member_list"
                    role="tabpanel">
                <b-card-body>
                    <member_detail :userData="userData">
                    </member_detail>
                </b-card-body>
            </b-collapse>
        </b-card>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import waitingMember from './WaitingMemberList'
    import member_detail from './GroupMemberDetail'

    export default {
        components: {
            waitingMember,
            InfiniteLoading,
            member_detail
        },
        data: () => ({
            groupUuid: "",
            memberList: [],
            waitingMember: [],
            leaderData: [],
            owner: '',
            position: false
        }),
        methods: {
            pullMemberList() {
                this.axios.get(this.$HttpAddr + "/list_member/" + this.$route.params.groupid)
                    .then(response => {
                        this.memberList = response.data[0].enter;
                        this.leaderData.push(this.memberList[0]);
                        this.memberList.shift();
                        this.waitingMember = response.data[0].not_enter
                    });
            },
            // 멤버 강퇴 시키기
            outGroup(userData) {
                this.axios.post(this.$HttpAddr + '/out_schedule', {
                    userid: userData.userid,
                    uuid: this.$route.params.groupid
                }).then((response) => {
                    if (response.data == "true") {
                        this.axios.post(this.$HttpAddr + '/out_group', {
                            userid: userData.userid,
                            uuid: this.$route.params.groupid
                        }).then(response => {
                            if (response.data == 'true') {
                                const notification = {
                                    template: "<span><b>追放しました。</b></span>"
                                };
                                this.$notifications.notify(
                                    {
                                        component: notification,
                                        icon: 'nc-icon nc-app',
                                        horizontalAlign: 'center',
                                        horizontalAlign: 'center',
                                        verticalAlign: 'top',
                                        type: 'success'
                                    });
                                this.memberList = [];
                                this.waitingMember = [];
                                this.pullMemberList();
                            }
                        });
                    }
                });
            },
        },
        created() {
            this.pullMemberList();
            // 로그인 된 이용자의 위치 가지고 오기
            this.$EventBus.$on('ownerGet', (owner) => {
                this.owner = owner;
            });
            this.$EventBus.$on('positionGet', (position) => {
                this.position = position
            });
            this.groupUuid = this.$route.params.groupid;
            // waitingMemberList에서 수락/거절 시 리스트 재배열을 위해 event가 온다.
            this.$EventBus.$on('memberCheckSign', () => {
                this.leaderData = [];
                this.memberList = [];
                this.waitingMember = [];
                this.pullMemberList();
            });
        },
    }
</script>

<style>
</style>