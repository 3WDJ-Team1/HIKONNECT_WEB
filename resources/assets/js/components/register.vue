<template>
    <div class="container" style="margin: 0 auto">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 80px">
                    <div class="panel-heading">회원가입</div>

                    <div class="panel-body">
                        <input type="text"     style="margin-top: 10px" v-model="item.idv" class="form-control" placeholder="Enter id" id="id"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwv" class="form-control" placeholder="Enter password" id="pw"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwvc" class="form-control" placeholder="Enter password again" id="pwvc"/>
                        <br>
                        <input type='button' class="btn btn-primary" v-on:click="regist" value="확인">
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
            regist() {

                let uri= 'http://localhost:8000/login';
                if($('#id').val() == "" || $('#pw').val() == ""
                    || $('#pwvc').val() == "") {
                    alert('값이 비어있습니다');
                }
                else if($('#pw').val() != $('#pwvc').val()) {
                    alert('비밀 번호와 비밀번호 확인이 다릅니다')
                }
                else {
                    this.axios.get(uri, this.item).then(function (response) {
                        alert('회원가입 완료');
                    })
                }
            }


        }
    }
</script>