<template>
    <v-app>
        <v-container style="padding: 0px;">
                    <v-card
                            style="padding-bottom: 1%; border-top: 0px;
    border-left: 0px; padding-top: 1%; border-right: 0px; border-radius: 0px; padding-left: 40px; margin: 0px;"
                            v-for="user in waitingMembers"
                            :key="user.nickname"
                            flat>
                        <v-layout
                                row
                                wrap>
                            <v-flex
                                    d-flex
                                    md2
                                    align-center
                                    align-content-center
                                    justify-center>
                                <v-avatar
                                        slot="activator"
                                        size="42">
                                    <img :src="'http://172.26.2.88:3000/images/UserProfile/' + user.userid + '.jpg'" alt="avatar"/>
                                </v-avatar>
                            </v-flex>
                            <v-flex
                                    d-flex
                                    md7
                                    align-center
                                    align-content-center
                                    justify-center
                                    style="font-size: 1.5rem;">
                                {{ user.nickname }}
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
                                                style="padding: 0;"
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
                                                style="padding: 0;"
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
        data: () => ({
            groupId         : '',
            waitingMembers  : [],
            isPushed        : false,
        }),
        methods: {
            applyUser(userUuid) {
                console.log(userUuid);
                axios.put(this.$HttpAddr + "/member/true", {
                    userid: userUuid,
                    uuid: this.groupId
                }).then (response => {
                    if(response) {
                        this.waitingMembers = [];
                        const notification = {
                            template: "<span><b>참여 신청을 수락 하였습니다.</b></span>"
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
                        this.$EventBus.$emit('memberChechSign')
                    }
                });
            },

            rejectUser(argUserUuid) {
                axios.put(this.$HttpAddr + '/member/false', {
                    userid: argUserUuid,
                    uuid: this.groupId
                }).then (response => {
                    console.log(response.data);
                    if (response) {
                        const notification = {
                            template: "<span><b>참여 신청을 거절 하였습니다.</b></span>"
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
                        this.$EventBus.$emit('memberCheckSign')
                    }
                });
            }
        },
        created() {
            this.groupId = this.$route.params.groupid;
            this.$EventBus.$on('sendNotEnterMember', (noEnter)=>{
                this.waitingMembers = this.waitingMembers.concat(noEnter);
            });
            this.$EventBus.$on('reloadMember', () => {
                this.created();
            });
        },
        watch: {
            '$route' (to, from) {
                this.groupId = this.$route.params.groupid;
            }
        }
    }
</script>
<style>
</style>