<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <v-app>
        <v-container style="padding: 0px; max-width: 100%;">
                    <v-card
                            style="padding-bottom: 1%; border-top: 0px;
    border-left: 0px; padding-top: 1%; border-right: 0px; border-radius: 0px; padding-left: 40px; margin: 0px;"
                            v-for="user in waitingMember"
                            :key="user.nickname"
                            flat>
                        <v-layout
                                row
                                wrap>
                            <v-flex
                                    d-flex
                                    md1
                                    align-center
                                    class="text-center"
                                    align-content-center
                                    justify-center>
                                <p style="color: #ED8D00; margin-bottom: 0; font-family: 'Do Hyeon', sans-serif; font-size: 25px;">参加申請者</p>
                            </v-flex>
                            <v-flex
                                    d-flex
                                    md2
                                    align-center
                                    align-content-center
                                    justify-center>
                                <v-avatar
                                        slot="activator"
                                        size="80">
                                    <img :src="'http://hikonnect.ga:3000/images/UserProfile/' + user.userid + '.jpg'" alt="avatar"/>
                                </v-avatar>
                            </v-flex>
                            <v-flex
                                    d-flex
                                    md6
                                    class="text-center">
                                <h2 style="margin: 0; margin-top: 20px; font-family: 'Do Hyeon', sans-serif">{{ user.nickname }}</h2>
                            </v-flex>
                            <v-flex
                                    xs12
                                    sm3
                                    md2>
                                <v-layout
                                        row
                                        wrap>
                                    <v-flex
                                            xs6
                                            sm6
                                            md6>
                                        <v-btn
                                                color="cyan lighten-2"
                                                dark
                                                style="width: 120px; height: 40px; margin-top: 25px; padding: 0;"
                                                @click="applyUser(user.userid)"
                                                :disabled="isPushed">
                                            <v-icon>done</v-icon>
                                        </v-btn>
                                    </v-flex>
                                    <v-flex
                                            md4>
                                        <v-btn
                                                color="red darken-3"
                                                dark
                                                style="width: 120px; height: 40px; margin-top: 25px; padding: 0;"
                                                @click="rejectUser(user.userid)"
                                                :disabled="isPushed">
                                            <v-icon>block</v-icon>
                                        </v-btn>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-card>
        </v-container>
    </v-app>
</template>
<script>
    export default {
        props: {
            waitingMember: {
                type: Array
            }
        },
        data: () => ({
            groupId         : '',
            isPushed        : false,
        }),
        methods: {
            // 참여 수락
            applyUser(userUuid) {
                axios.put(this.$HttpAddr + "/member/true", {
                    userid: userUuid,
                    uuid: this.groupId
                }).then (response => {
                    if(response) {
                        this.waitingMembers = [];
                        const notification = {
                            template: "<span><b>受諾しました。</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });

                        this.waitingMembers = [];
                        this.$EventBus.$emit('memberCheckSign', 'true')
                    }
                });
            },
            // 참여 거절
            rejectUser(argUserUuid) {
                axios.put(this.$HttpAddr + '/member/false', {
                    userid: argUserUuid,
                    uuid: this.groupId
                }).then (response => {
                    if (response) {
                        const notification = {
                            template: "<span><b>拒絶しました。</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'warning'
                            });


                        this.waitingMembers = [];
                        this.$EventBus.$emit('memberCheckSign', 'true')
                    }
                });
            }
        },
        created() {
            this.groupId = this.$route.params.groupid;
        },
    }
</script>
<style>
</style>