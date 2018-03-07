<template>
    <div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="nav navbar-nav">
                   <router-link  :to="{ name : 'main'}">홈으로</router-link>
                </div>
                <div>
                    <ul class="nav navbar-nav">

                        <li><router-link :to ="{ name: 'test'}">공지사항</router-link></li>
                        <li><router-link :to="{ name : '#'}">그룹방 조회 & 생성</router-link></li>
                        <li><router-link :to="{ name : '#'}">나의 그룹</router-link></li>
                        <li><router-link :to="{ name : '#'}">알림</router-link></li>
                        <li ><router-link :to="{ name : '#'}">마이페이지</router-link></li>
                    </ul>
                    <div style="position: absolute; margin-left: 700px">
                    <p v-if="sessionver() == 'true'"><button v-on:click ="logout">로그아웃 </button> </p>
                    <p v-else> <router-link :to ="{ name: 'login'}"><button> 로그인</button></router-link></p>
                    </div>
                </div>
            </div>
        </nav>
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