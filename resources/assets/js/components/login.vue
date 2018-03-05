<template>
    <div>
        <h1>login</h1>
        <input type="text" v-model="id"/>
        <input type="password" v-model="pw"/>
    </div>
</template>
<script>
    export default {
        data(){
            let data = {};

            return data
        }
    }
    const app = new Vue({
        el: '#app',

        data: {
            isSignUp: false,
        },

        methods: {
            toggleSignUp() {
                this.isSignUp = !this.isSignUp;
            }
        }
    });
</script>