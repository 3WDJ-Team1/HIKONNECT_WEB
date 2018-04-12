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
                v-for="userData in userDataArr"
                :key="userData.uuid"
                v-if="userData.name.charAt(0) == alphabet">
                <b-card-header
                    header-tag="header"
                    role="tab"
                    @click="sendMemberData(userData)"
                    class='member_list_card_header'>
                    <div
                        href="#"
                        v-b-toggle ="'n' + userData.uuid">
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
                                    <img :src="userData.profilePic">
                                </v-avatar>
                            </v-flex>
                            <v-flex
                                xs6
                                class="text-center">
                                <h4 style="line-height:220%;">{{ userData.name }}</h4>
                            </v-flex>
                            <v-flex
                                xs12
                                sm6
                                md3
                                class="text-center">
                                <h4 style="line-height:220%;">{{ userData.grade }}</h4>
                            </v-flex>
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
            groupUuid: '',
            memberList: [
                // { uuid: ~~~~ }, 
                "001316ba-9cd4-3301-a605-54816b8f9229",
                "0453de25-933f-3cef-810d-db577e001b59",
                "1899b9ca-4516-3cdc-9d34-4d20ab72653d",
                "2c6546b0-e79e-392c-924f-797c5f573699",
                "31a06654-2ddd-3dd2-8f65-e97b4e0245ce",
                "31dce0c7-39e1-33cf-97c8-694e9a8bb039",
                "8bef132f-3f05-35f4-b8a9-c5bd56d6577e",
                "b9d7df2f-eac3-3dc8-8980-ca7c9675fb97",
                "d353bdfd-b44b-3b98-b5eb-bfa19916940f",
                "f42f795e-0701-3772-90c9-d1b9e697fb3e",
                "f9ffd59f-f71e-3578-b37d-03112df229dd",
                "fa796add-910e-3bbb-a4d0-50b47760b8c8",
                "fd4b4476-1b7b-3d2a-a12f-21d339102a88",
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
            getMembersData(argMemberUuid) {
                axios.get(this.$HttpAddr + "/userProfile/" + argMemberUuid)
                .then( response => {
                    this.userDataArr.push(response.data[0]);
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
            // this.getGroupUserData("02b1790f-5b77-3e54-877f-8612c0b9865b");
            for ( let i = 0 ; i < this.memberList.length ; i++){
                this.getMembersData(this.memberList[i]);
            }
        },
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