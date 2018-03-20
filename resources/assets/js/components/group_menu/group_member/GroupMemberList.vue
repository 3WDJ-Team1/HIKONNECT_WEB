<!-- 
    @file   GroupMemberList.vue
    @brief  A component of group member list
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   update everything
 -->
<template>
    <div style="position: relative;" v-scroll="">
        <div
            style="display: inline_block;"
            v-for="alphabet in alphabets">
            <h2
                class="text-center"
                :id="alphabet">
                {{ alphabet }}
            </h2>
            <b-card
                class='member_list_card'
                v-for="userData in userDataArr" v-if="userData.name.charAt(0) == alphabet">
                <b-card-header
                    header-tag="header"
                    class="p-1"
                    role="tab"
                    @click="sendMemberData(userData)">
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
                                    <img src="http://localhost:8000/tmp/3f88711059fc7b50ae3ebd9a326fe2c91504071410_watermark.jpg">
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
            ],
            userDataArr: [
                // { Capitol: A }
            ],
            alphabets: [
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K',
                'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
                'W', 'X', 'Y', 'Z', '#'],
            httpAddr: Laravel.host,
        }),
        methods: {
            getGroupUserData(argGroupUuid) {
                // axios.get(this.httpAddr)
                // .then( response => {
                //     this.userData = response.data;
                // })
            },
            sendMemberData(argObj) {
                this.$EventBus.$emit('memberData', argObj);
                isDetailShown = !isDetailShown;
            },
        },
        created() {
            // this.getGroupUserData();
            // httpAddr+/groupMembers/groupUUID
            axios.get('http://hikonnect.ga/groupMembers/0847f4bd-3a59-3d20-863b-b6d2c2301a3b')
            .then(response => {
                this.memberList = response.data;
            });
            for ( let i = 0 ; i < this.memberList.length ; i++){
                axios.get(this.httpAddr + '/userProfile/' + this.memberList[i])
                .then(response => {
                    this.userDataArr.push()
                });
            }
        },
    }
</script>

<style>
.member_list_card {
    background-color: white;
    border-bottom: 1px solid whitesmoke;
    box-shadow: none;
}
.give_padding {
    padding: 1%;
    display: inline-block;
}
</style>