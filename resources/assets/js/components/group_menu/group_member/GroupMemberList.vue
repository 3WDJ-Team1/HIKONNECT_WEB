<!-- 
    @file   GroupMemberList.vue
    @brief  A component of group member list
    @author Sungeun Kang <kasueu0814@gmail.com>, Jiyoon Lee <jiyoon3421@gmail.com>
    @todo   update everything
 -->
<template>
    <div>
        <waitingMember :waitingMember="waitingMember" v-if="positionString"></waitingMember>
        <div>
            <b-card
                    style="margin-top: 0px; margin-bottom: 0px;"
                    class='member_list_card'
                    v-for="userData in memberList"
                    :key="userData.nickname">
                    <div>
                        <v-layout row>
                            <v-flex
                                    style="padding-bottom: 2px;"
                                    xs2
                                    class="text-center">
                                <v-avatar
                                        size="68"
                                        slot="activator"
                                >
                                    <img :src="'http://hikonnect.ga:3000/images/UserProfile/' + userData.userid + '.jpg'">
                                </v-avatar>
                            </v-flex>
                            <v-flex
                                    xs7
                                    class="text-center">
                                <h3 style="margin: 18px 0 15px;">{{ userData.nickname }}</h3>
                            </v-flex>
                            <v-flex
                                    v-b-toggle ="'n' + userData.nickname"
                                    visible='false'
                                    xs3
                                    class="text-center">
                                <button style="padding-left: 12px; width: 100px; font-size: 12px; font-weight: bold; margin-top: 15px;" v-if="position" class="btn btn-info">
                                    멤버 정보보기
                                </button>
                                <button v-if="positionString" @click="outGroup(userData)" type="submit" style="width: 100px; font-size: 12px; font-weight: bold; margin-top: 15px;" class="btn btn-warning btn-fill">
                                    강퇴 시키기
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
                        <router-view :userData="userData"
                                name="member_detail">
                        </router-view>
                    </b-card-body>
                </b-collapse>
            </b-card>
        </div>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import waitingMember from './WaitingMemberList'
    export default {
        components: {
            waitingMember,
            InfiniteLoading,
        },
        data: () => ({
            groupUuid   : "",
            memberList  : [],
            waitingMember: [],
            position: false,
            positionString: false
        }),
        methods: {
            // 멤버 강퇴 시키기
            outGroup(userData)  {
                console.log(userData.userid);
                console.log(this.$route.params.groupid);
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
            // 멤버 정보 서버에서 가지고 오기
            pullMemberList($state) {
                axios.get(this.$HttpAddr + "/list_member/" + this.groupUuid)
                    .then( response => {
                        this.memberList = response.data[0].enter;
                        this.waitingMember = response.data[0].not_enter;
                    });
            }
        },
        created() {
            // 로그인 된 이용자의 위치 가지고 오기
            this.$EventBus.$on('sendPositionInfo', (position) => {
                if (position != 'guest') {
                    this.position = true;
                }
                if (position == 'owner') {
                    this.positionString = true;
                }
            });
            this.groupUuid = this.$route.params.groupid;
            this.pullMemberList();
            // waitingMemberList에서 수락/거절 시 리스트 재배열을 위해 event가 온다.
            this.$EventBus.$on('memberCheckSign', () => {
                this.memberList = [];
                this.waitingMember = [];
                this.pullMemberList();
            });
        },
    }
</script>

<style>
</style>