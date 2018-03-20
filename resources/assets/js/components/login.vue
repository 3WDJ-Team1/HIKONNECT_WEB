<template>
    <div class="container" style="margin-left: 130px;" >
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 150px">
                    <div class="panel-heading">로그인</div>

                    <div class="panel-body">
                        <input type="text" v-model="item.idv" class="form-control" placeholder="Enter id" id="id"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwv" class="form-control" placeholder="Enter password" id="pw"/>
                        <br>
                        <input type='button' class="btn btn-primary" v-on:click="login" value="로그인">
                        <router-link style='margin-left: 298px' :to="{ name: 'main' }" class = "btn btn-primary"> 취소</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
       data(){
           return{
               item:{}
           }
       },
        methods: {
            login() {
                if($('#id').val() == "" || $('#pw').val() == "") {
                    alert('아이디 또는 비밀번호에 값이 비었습니다.');
                }
                else {
                    let uri = 'http://localhost:8000/loginprocess';
                    this.axios.post(uri, this.item).then((response) => {
                        if (response.data == 'false') {
                            alert('아이디가 없습니다.');
                        }
                        else if(response.data == 'pwfalse') {
                            alert('비밀번호가 틀렸습니다');
                        }
                        else  {
                            alert('로그인 완료');

                            var datavalue = Object.values(response.data);
                            var scope = datavalue[0].scope;
                            var scv = 0;
                            var phonesc = 0;
                            var gendersc = 0;
                            var agesc = 0;
                            var agegroup = datavalue[0].age_group;
                            var age = '';
                            var gendergroup = datavalue[0].gender;
                            var gender = '';


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
                                scv = 'all';
                                scope = scope - 10000;
                            }
                            else {
                                scv = 'group';
                                scope = scope - 1000;
                            }

                            if(scope / 100 >= 1 ) {
                                phonesc = 'true';
                                scope = scope - 100;
                            }
                            else {
                                phonesc = 'false';
                            }

                            if(scope / 10 >= 1 ) {
                                gendersc = 'true';
                                scope = scope - 10;
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

                            sessionStorage.setItem('year',2018);
                            sessionStorage.setItem('userid',$('#id').val());
                            sessionStorage.setItem('uuid',datavalue[0].uuid);
                            sessionStorage.setItem('phone',datavalue[0].phone);
                            sessionStorage.setItem('uuid',datavalue[0].uuid);
                            sessionStorage.setItem('password',datavalue[0].password);
                            sessionStorage.setItem('nickname',datavalue[0].nickname);
                            sessionStorage.setItem('phonesc',phonesc);
                            sessionStorage.setItem('gendersc',gendersc);
                            sessionStorage.setItem('agesc',agesc);
                            sessionStorage.setItem('scv',scv);
                            sessionStorage.setItem('gender',gender);
                            sessionStorage.setItem('age',age);
                            sessionStorage.setItem('image_path',datavalue[0].image_path);
                            this.$router.push({ name: 'main'});
                            window.location.reload();
                        }
                    });
                }

            }


        }
    }
</script>