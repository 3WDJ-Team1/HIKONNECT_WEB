<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <v-app>
        <v-container style="padding: 0px; max-width: 100%;">
                    <v-card
                            style="padding: 1% 1.1%; margin: auto; border: 1px solid rgba(0, 0, 0, 0.125); box-shadow: 0px 2px 1px -1px rgba(0,0,0,0.2), 0px 1px 1px 0px rgba(0,0,0,0.14), 0px 1px 3px 0px rgba(0,0,0,0.12); margin-bottom: 15px; width: 98%;"
                            v-for="user in waitingMember"
                            :key="user.nickname"
                            flat>
                        <div class="row">
                            <div
                                    class="col-2">
                                <p style="float: left; margin-left: 20px; color: #ED8D00; margin-bottom: 0; line-height: 100px; font-family: 'Gothic A1', sans-serif; font-size: 25px;">参加申請者</p>
                            </div>
                            <div
                                    class="col-2">
                                <v-avatar
                                        slot="activator"
                                        size="100">
                                    <img :src="'http://hikonnect.ga:3000/images/UserProfile/' + user.userid + '.jpg'" alt="avatar"/>
                                </v-avatar>
                            </div>
                            <div
                                    align-center
                                    class="col-5">
                                <h1 style="line-height: 98px; margin: 0; text-align: center; font-family: 'Gothic A1', sans-serif">{{ user.nickname }}</h1>
                            </div>
                            <div
                                    class="col-3"
                                    >
                                        <v-btn
                                                color="cyan lighten-2"
                                                dark
                                                style="width: 150px; height: 40px; margin-right: 3%;
    margin-top: 25px;
    padding: 0px;
    margin-left: 4%;"
                                                @click="applyUser(user.userid)"
                                                :disabled="isPushed">
                                            <v-icon>done</v-icon>
                                        </v-btn>
                                        <v-btn
                                                color="red darken-3"
                                                dark
                                                style="width: 150px; height: 40px; margin-top: 25px; padding: 0;"
                                                @click="rejectUser(user.userid)"
                                                :disabled="isPushed">
                                            <v-icon>block</v-icon>
                                        </v-btn>
                                </div>
                        </div>
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