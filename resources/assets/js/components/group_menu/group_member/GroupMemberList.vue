<!-- 
    @file   GroupMemberList.vue
    @brief  A component of group member list
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   update everything
 -->
<template>
    <div>
        <waitingMember></waitingMember>
        <div>
            <b-card
                    style="margin-top: 10px; margin-bottom: 10px;"
                    class='member_list_card'
                    v-for="userData in memberList"
                    :key="userData.nickname">
                    <div
                            v-b-toggle ="'n' + userData.nickname">
                        <v-layout row>
                            <v-flex
                                    style="padding-bottom: 2px;"
                                    xs12
                                    sm6
                                    md3
                                    class="text-center">
                                <v-avatar
                                        size="68"
                                        slot="activator"
                                >
                                    <img :src="'http://172.26.2.88:3000/images/UserProfile/' + userData.userid + '.jpg'">
                                </v-avatar>
                            </v-flex>
                            <v-flex
                                    xs6
                                    class="text-center">
                                <h3 style="margin: 18px 0 15px;">{{ userData.nickname }}</h3>
                            </v-flex>
                        </v-layout>
                    </div>
                <b-collapse
                        :id="'n' + userData.nickname"
                        accordion="member_list"
                        role="tabpanel">
                    <b-card-body>
                        <router-view
                                name="member_detail">
                        </router-view>
                    </b-card-body>
                </b-collapse>
            </b-card>
            <!-- <infinite-loading @infinite="infiniteHandlerMember" spinner="bubbles"></infinite-loading> -->
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
            page        : 0,
        }),
        methods: {
            sendMemberData(argObj) {
                this.$EventBus.$emit('memberData', argObj);
            },
            infiniteHandlerMember($state) {
                axios.get(this.$HttpAddr + "/list_member/" + this.groupUuid)
                    .then( response => {
                        console.log(response.data[0]);
                        this.memberList = response.data[0].enter;
                        this.waitingMember = response.data[0].not_enter;
                        this.$EventBus.$emit('sendNotEnterMember', this.waitingMember);
                    });
            }
        },
        created() {
            this.groupUuid = this.$route.params.groupid;
            this.infiniteHandlerMember();
            this.$EventBus.$on('memberCheckSign', ()=>{
                this.memberList = [];
                this.waitingMember = [];
                this.infiniteHandlerMember();
            });
        },
        watch: {
            '$route' (to, from) {
                this.groupUuid = this.$route.params.groupid;
            }
        }
    }
</script>

<style>
</style>