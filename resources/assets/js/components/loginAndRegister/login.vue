<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>, Sungeun Kang <kasueu0814@gmail.com>
 -->
<template>
    <v-container
            row
            align-content-center
            justify-center
            fluid
            style="padding-left: 0; padding-right: 0; margin-left: 0px;">

        <v-row>
            <h1
                    style="font-weight: bold; color: #47714c;">
                로그인
            </h1>
        </v-row>
        <v-row>
            <form>
            <div class="row">
                <div class="col-md-12">
                    <fg-input type      ="text"
                              label     ="ID"
                              v-model   ="userId">
                    </fg-input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <fg-input
                              @keyup.enter.native="login"
                              label       ="PASSWORD"
                              v-model     ="userPw"
                              type        ="password">
                    </fg-input>
                </div>

            </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-fill" style="background-color: #47714c; border-color: #47714c;"
                            @click="login">
                        제출
                    </button>
                </div>
            </form>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        data: () => ({
            userId: "",
            userPw: "",
        }),
        methods: {
            login() {
                let uri = this.$HttpAddr + '/loginprocess';
                this.axios.post(uri, {
                    idv: this.userId,
                    pwv: this.userPw
                }).then((response) => {
                    if (response.data == 'false') {
                        this.$EventBus.$emit('errorModalOpen', '아이디가 바르지 않습니다');
                    }
                    else if(response.data == 'pwfalse') {
                        this.$EventBus.$emit('errorModalOpen', '올바른 비밀번호를 입력하세요');
                    }
                    else  {
                        this.$EventBus.$emit('complitedModalOpen', 'true');
                        var datavalue   = Object.values(response.data);
                        var userid      = datavalue[0];
                        var scope       = datavalue[4];
                        var scv         = 0;
                        var phonesc     = 0;
                        var gendersc    = 0;
                        var agesc       = 0;
                        var createdY    = datavalue[9].substring(0, 10);
                        var agegroup    = datavalue[3];
                        var age         = '';
                        var gendergroup = datavalue[2];
                        var gender      = '';
                        if (gendergroup == 0) {
                            gender = '남자'
                        }
                        else
                            gender = '여자';
                        switch (agegroup) {
                            case 10 :
                                age = '10대';
                                break;
                            case 20 :
                                age = '20대';
                                break;
                            case 30 :
                                age = '30대';
                                break;
                            case 40 :
                                age = '40대';
                                break;
                            case 50 :
                                age = '50대';
                                break;
                            case 60 :
                                age = '60대 이상';
                                break;
                        }
                        if(scope / 10000 >= 1 ) {
                            scv     = 'all';
                            scope   = scope - 10000;
                        }
                        else {
                            scv     = 'group';
                            scope   = scope - 1000;
                        }
                        if(scope / 100 >= 1 ) {
                            phonesc = 'true';
                            scope   = scope - 100;
                        }
                        else {
                            phonesc = 'false';
                        }
                        if(scope / 10 >= 1 ) {
                            gendersc    = 'true';
                            scope       = scope - 10;
                        }
                        else {
                            gendersc = 'false';
                        }
                        if(scope == 1 ) {
                            agesc = 'true';
                        }
                        else {
                            agesc = 'false';

                        }
                        // 수정한 값으로 session값 모두 바꾸기
                        sessionStorage.setItem('userid',userid);
                        sessionStorage.setItem('phone',datavalue[6]);
                        sessionStorage.setItem('password',datavalue[7]);
                        sessionStorage.setItem('nickname',datavalue[1]);
                        sessionStorage.setItem('phonesc',phonesc);
                        sessionStorage.setItem('gendersc',gendersc);
                        sessionStorage.setItem('agesc',agesc);
                        sessionStorage.setItem('scv',scv);
                        sessionStorage.setItem('gender',gender);
                        sessionStorage.setItem('age',age);
                        sessionStorage.setItem('createdY',createdY);
                        this.$EventBus.$emit('setRightDrawerFlipped', 'true');
                    }
                });

            },
            onSlideStart(slide) {
                this.sliding = true;
            },
            onSlideEnd(slide) {
                this.sliding = false;
            }
        },
        created() {
            this.userId = "";
            this.userPw = "";
        }
    }
</script>
<style>
    .container-custom {
        margin: 0 auto;
        padding: 0;
    }
</style>