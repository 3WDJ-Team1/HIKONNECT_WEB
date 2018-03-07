<template>
    <div class="container" style="margin: 0 auto">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 20px">
                    <div class="panel-heading">로그인</div>

                    <div class="panel-body">
                        <input type="text" v-model="item.idv" class="form-control" placeholder="Enter id" id="id"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwv" class="form-control" placeholder="Enter password" id="pw"/>
                        <br>
                        <input type='button' class="btn btn-primary" v-on:click="login" value="로그인">
                        <router-link style='margin-left: 270px' :to="{ name: 'main' }" class = "btn btn-primary"> 취소</router-link>
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
                        console.log(response.data);
                        if (response.data == 'true') {
                            alert('로그인 완료');
                            this.$router.push({ name: 'main'});
                            sessionStorage.setItem('login',$('#id').val());
                            window.location.reload();

                        }
                        else if(response.data == 'false') {
                            alert('로그인 실패');


                        }
                    });
                }

            }


        }
    }
</script>