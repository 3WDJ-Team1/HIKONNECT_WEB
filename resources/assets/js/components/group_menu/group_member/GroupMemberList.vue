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
                {
                    uuid: '1234',
                    name: 'AAA',
                    grade: 'test',
                    gender: 'female',
                    phone: '000-0000-0000',
                    avgSpeed: '3km/h',
                    profilePic: '',
                    permission: {
                        target: 'all',
                        _phone: true,
                        _age: true,
                        _gender: true,
                    }
                },
                {
                    uuid: '1235',
                    name: 'ABB',
                    grade: 'test',
                    gender: 'female',
                    phone: '000-0000-0000',
                    avgSpeed: '3km/h',
                    permission: {
                        target: 'all',
                        _phone: true,
                        _age: true,
                        _gender: true,
                    }
                },
                {
                    uuid: '1236',
                    name: 'BBB',
                    grade: 'test',
                    gender: 'female',
                    phone: '000-0000-0000',
                    avgSpeed: '3km/h',
                    permission: {
                        target: 'all',
                        _phone: true,
                        _age: true,
                        _gender: true,
                    }
                },
                {
                    uuid: '1237',
                    name: 'FFF',
                    grade: 'test',
                    gender: 'female',
                    phone: '000-0000-0000',
                    avgSpeed: '3km/h',
                    permission: {
                        target: 'all',
                        _phone: true,
                        _age: true,
                        _gender: true,
                    }
                },
                {
                    uuid: '1238',
                    name: 'KKK',
                    grade: 'test',
                    gender: 'female',
                    phone: '000-0000-0000',
                    avgSpeed: '3km/h',
                    permission: {
                        target: 'all',
                        _phone: true,
                        _age: true,
                        _gender: true,
                    }
                },
                {
                    uuid: '1239',
                    name: 'OOOO',
                    grade: 'test',
                    gender: 'female',
                    phone: '000-0000-0000',
                    avgSpeed: '3km/h',
                    permission: {
                        target: 'all',
                        _phone: true,
                        _age: true,
                        _gender: true,
                    }
                },
                {
                    uuid: '1240',
                    name: 'ZZZZZ',
                    grade: 'test',
                    gender: 'female',
                    phone: '000-0000-0000',
                    avgSpeed: '3km/h',
                    permission: {
                        target: 'all',
                        _phone: true,
                        _age: true,
                        _gender: true,
                    }
                },
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