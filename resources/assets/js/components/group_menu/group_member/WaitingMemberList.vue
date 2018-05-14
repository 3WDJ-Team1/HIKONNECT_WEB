<template>
    <div>
        <v-container>
            <v-layout
                    row
                    wrap>
                <v-flex
                        d-flex
                        xs12
                        sm12
                        md12>
                    <v-card
                            style="padding-bottom: 1%; padding-top: 1%; border: 0;"
                            v-for="user in waitingMembers"
                            :key="user.user"
                            flat>
                        <v-layout
                                row
                                wrap>
                            <v-flex
                                    d-flex
                                    xs3
                                    sm3
                                    md2
                                    align-center
                                    align-content-center
                                    justify-center>
                                <v-avatar
                                        slot="activator"
                                        size="42">
                                    <img :src="user.image_path" alt="avatar"/>
                                </v-avatar>
                            </v-flex>
                            <v-flex
                                    d-flex
                                    xs9
                                    sm6
                                    md8
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
                                            xs6
                                            sm6
                                            md6>
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
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>
<script>
    export default {
        data: () => ({
            groupId         : '',
            waitingMembers  : [],
            isPushed        : false,
        }),
        methods: {
            getWaitingMembers() {
                axios.get("http://172.26.2.88:8000/api/list_member/" + this.groupId + "/0")
                    .then( response => {
                        this.waitingMembers = this.waitingMembers.concat(response.data);
                    });
            },
            applyUser(userUuid) {
                console.log(userUuid);
                axios.put(this.$HttpAddr + "/member/true", {
                    userid: userUuid,
                    uuid: this.groupId
                }).then (response => {
                    if(response) {
                        alert('참여 신청을 수락 하였습니다.');
                        location.reload();
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
                        alert('참여 신청을 거절 하였습니다.');
                    }
                });
            }
        },
        created() {
            this.groupId = this.$route.params.groupid;
            this.getWaitingMembers();
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