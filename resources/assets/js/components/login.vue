<template>
    <div class="container">
        <h1>안녕</h1>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <input type="text" v-model="item.idv"/>
                        <input type="password" v-model="item.pwv"/>
                        <input type='button' v-on:click="login" value="로그인">
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
                    console.log(response);
                    //트루 or 펄스(이유)
                })
            }


        }
    }
</script>