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
                                            @click="applyUser(user.user)"
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
                                            @click="rejectUser(user.user)"
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
                axios.get(this.$HttpAddr + '/appliedUsers/' + this.groupId)
                .then( response => {
                    console.log(response);
                    this.waitingMembers = this.waitingMembers.concat(response.data);
                });
            },
            applyUser(userUuid) {
                axios.patch(this.$HttpAddr + '/replyUserEntry', {
                    groupUuid   : this.groupId,
                    userUuid    : userUuid,
                    isAccept    : 1
                }).then (response => {
                    this.isPushed = true;
                    if (response) {
                        location.reload();
                    }
                });
            },
            rejectUser(argUserUuid) {
                axios.delete(this.$HttpAddr + '/rejectUserEntry', {
                    groupUuid : this.groupId,
                    userUuid  : argUserUuid
                }).then (response => {
                    this.isPushed = true;
                    if (response) {
                        location.reload();
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