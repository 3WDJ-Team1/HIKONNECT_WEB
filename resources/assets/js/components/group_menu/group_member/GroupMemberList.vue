<!-- 
    @file   GroupMemberList.vue
    @brief  A component of group member list
    @author Sungeun Kang <kasueu0814@gmail.com>, Jiyoon Lee <jiyoon3421@gmail.com>
    @todo   update everything
 -->
<template>
    <div>
        <b-card
                style="margin-top: 0px; margin-bottom: 0px; background-color: #e6e6e6;"
                class='member_list_card'
                v-for="userData in leaderData"
                :key="userData.nickname">
            <div style="background-color: white; margin-left: 1px; margin-right: 1px; border-radius: 6px; margin-bottom: 4px;">
                <v-layout row style="padding: 10px; margin-left: 10px;">
                    <v-flex
                            xs1
                            class="text-center">
                        <h1 style="font-family: 'Do Hyeon', sans-serif; margin: 24px 0 15px; color: #42d0ed;">리더</h1>
                    </v-flex>
                    <v-flex
                            xs2
                            style="padding-bottom: 2px;"
                            class="text-center">
                        <v-avatar
                                size="100"
                                slot="activator"
                        >
                            <img :src="'http://hikonnect.ga:3000/images/UserProfile/' + userData.userid + '.jpg'">
                        </v-avatar>
                    </v-flex>
                    <v-flex
                            xs6
                            class="text-center">
                        <h1 style="font-family: 'Black Han Sans', sans-serif; margin: 20px 0 15px;">{{ userData.nickname
                            }}</h1>
                    </v-flex>
                    <v-flex
                            xs3
                            class="text-center">
                        <button v-b-toggle="'n' + userData.nickname" v-if="position" class="btn btn-info"  style="margin-top: 25px; padding: 0; width: 160px; height: 45px;">
                            <span style="font-family: 'Do Hyeon', sans-serif; font-size: 30px;">정보보기</span>
                        </button>
                    </v-flex>
                </v-layout>
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
                style="margin-top: 0px; margin-bottom: 0px;"
                class='member_list_card'
                v-for="userData in memberList"
                :key="userData.nickname">
            <div>
                <v-layout row style="margin-right: 10px;">
                    <v-flex
                            style="padding-bottom: 2px;"
                            xs2
                            class="text-center">
                        <v-avatar
                                size="80"
                                slot="activator"
                        >
                            <img :src="'http://hikonnect.ga:3000/images/UserProfile/' + userData.userid + '.jpg'">
                        </v-avatar>
                    </v-flex>
                    <v-flex
                            xs7
                            class="text-center">
                        <h2 style="font-family: 'Do Hyeon', sans-serif; margin: 18px 0 15px;">{{ userData.nickname
                            }}</h2>
                    </v-flex>
                    <v-flex
                            xs3
                            class="text-center">
                        <button v-b-toggle="'n' + userData.nickname"
                                style="margin-top: 17px; padding: 0; width: 120px; height: 45px;"
                                v-if="position" class="btn btn-info">
                            <span style="font-family: 'Do Hyeon', sans-serif; font-size: 30px;">정보보기</span>
                        </button>
                        <button v-if="owner == 'owner'" @click="outGroup(userData)" type="submit"
                                style="margin-top: 17px; padding: 0; width: 160px; height: 45px;"
                                class="btn btn-warning btn-fill">
                            <span style="font-family: 'Do Hyeon', sans-serif; font-size: 30px;">강퇴 시키기</span>
                        </button>
                    </v-flex>
                </v-layout>
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
                                    template: "<span><b>강퇴하셨습니다.</b></span>"
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