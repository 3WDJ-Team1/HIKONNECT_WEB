<!-- 
    @file   GroupMemberList.vue
    @brief  A component of group member list
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   update everything
 -->
<template>
    <div style="position: relative;">
        <div
            style="display: inline_block; background-color: whitesmoke;"
            v-for="alphabet in alphabets"
            :key="alphabet">
            <h2
                class="text-center"
                :id="alphabet">
                {{ alphabet }}
            </h2>
            <b-card
                class='member_list_card'
                v-for="userData in memberList"
                :key="userData.nickname"
                v-if="userData.nickname.charAt(0) == alphabet">
                <b-card-header
                    header-tag="header"
                    role="tab"
                    @click="sendMemberData(userData)"
                    class='member_list_card_header'>
                    <div
                        href="#"
                        v-b-toggle ="'n' + userData.phone">
                        <!-- need to insert profile pic -->
                        <v-layout row>
                            <v-flex
                                xs12
                                sm6
                                md3
                                class="text-center">
                                <v-avatar
                                    size="42"
                                    slot="activator"
                                    style="margin-top: 3%;"
                                    >
                                    <img :src="userData.image_path">
                                </v-avatar>
                            </v-flex>
                            <v-flex
                                xs6
                                class="text-center">
                                <h4 style="line-height:220%;">{{ userData.nickname }}</h4>
                            </v-flex>
                            <!-- <v-flex
                                xs12
                                sm6
                                md3
                                class="text-center">
                                <h4 style="line-height:220%;">{{ userData.grade }}</h4>
                            </v-flex> -->
                        </v-layout>
                    </div>
                </b-card-header>
                <b-collapse
                    :id="'n' + userData.uuid"
                    accordion="member_list"
                    role="tabpanel">
                    <b-card-body>
                    <router-view
                        name="member_detail">
                    </router-view>
                    </b-card-body>
                </b-collapse>
            </b-card>
        </div>
    </div>
</template>

<script>
    
    export default {
        data: () => ({
            groupUuid: "",
            memberList: [
                // { uuid: ~~~~ }, 
                
            ],
            userDataArr: [
                // { Capitol: A }
            ],
            alphabets: [
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K',
                'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
                'W', 'X', 'Y', 'Z', '#'],
        }),
        methods: {
            getGroupUserData(argGroupUuid) {
                axios.get(this.$HttpAddr + "/groupMembers/" + argGroupUuid)
                .then( response => {
                    this.memberList = response.data;
                })
            },
            sendMemberData(argObj) {
                this.$EventBus.$emit('memberData', argObj);
                isDetailShown = !isDetailShown;
            },
        },
        created() {
            // this.getGroupUserData();
            // httpAddr+/groupMembers/groupUUID
            this.groupUuid = this.$route.params.groupid;
            this.getGroupUserData(this.groupUuid);
        },
        watch: {
            '$route' (to, from) {
                this.groupUuid = this.$route.params.groupid;
            }
        }
    }
</script>

<style>
.member_list_card {
    background-color: white;
    border-bottom: 1px solid whitesmoke;
    box-shadow: none;
    margin-top: 0;
    margin-bottom: 0;
}
.member_list_card_header {
    background-color: white;
    border: 0;
    margin: 0;
    padding: 0;
}
</style>