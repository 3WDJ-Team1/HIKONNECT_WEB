<template>
    <div class="container" style="margin: 0 auto">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 80px">
                    <div class="panel-heading">회원가입</div>

                    <div class="panel-body">
                        <input type="text"     style="margin-top: 10px" v-model="item.nm" class="form-control" placeholder="Enter name" id="nm"/>
                        <input type="text"     style="margin-top: 10px" v-model="item.idv" class="form-control" placeholder="Enter id" id="id"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwv" class="form-control" placeholder="Enter password" id="pw"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwvc" class="form-control" placeholder="Enter password again" id="pwvc"/>
                        <br>
                        <input type='button' class="btn btn-primary" v-on:click="login" value="회원가입">
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
                    $('#nm').val('');
                    $('#id').val('');
                    $('#pw').val('');
                    $('#pwvc').val('');
                    alert('회원가입 완료');
                })
            }


        }
    }
</script>