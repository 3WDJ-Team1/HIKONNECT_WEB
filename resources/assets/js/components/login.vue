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
            dummylogin() {
               alert(this.item.idv+this.item.pwv);
            },
            login() {

                let uri= 'http://localhost:8000/login';
                this.axios.post(uri,this.item).then(function (response) {
                    $('#id').val('');
                    $('#pw').val('');
                    alert('로그인 완료');
                    console.log(response);
                    //트루 or 펄스(이유)
                })
            }


        }
    }
</script>