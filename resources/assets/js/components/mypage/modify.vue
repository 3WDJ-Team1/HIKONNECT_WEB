<template>
    <div class="container" style="margin-left: 130px;" >
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 150px">
                    <div class="panel-heading">로그인</div>

                    <div class="panel-body">
                        <input type="text" v-model="item.idv" class="form-control" placeholder="Enter id" id="id"/>
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
                    let uri = 'http://localhost:8000/user/1';
                this.axios.patch(uri, sessionStorage.getItem('login')).then((response) => {
                    console.log(response);
                });
            }
        }
    }
</script>