<template>
    <div>

        <span v-if="sessionver() == 'true'" v-on:click ="logout">&nbsp;&nbsp;<a href="#">로그아웃 </a> </span>
        <span v-else>
            <span><router-link :to ="{ name: 'register'}">회원가입&nbsp;&nbsp;</router-link></span>
            <router-link :to ="{ name: 'login'}">&nbsp;&nbsp;로그인</router-link></span>
    </div>
</template>
<script>
    export default {
        methods: {
            sessionver() {
                if(sessionStorage.getItem('login') != null) {
                    return 'true';
                }
            },
            logout() {
                sessionStorage.clear();
                this.$router.push({ name: 'main'});
                window.location.reload();
            }
        }
    }
</script>