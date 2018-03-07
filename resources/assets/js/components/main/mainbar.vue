<template>
    <div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                   <router-link class="btn-primary" :to="{ name : 'main'}">홈으로</router-link>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li ><router-link :to="{ name : 'main'}">마이페이지</router-link></li>
                        <li> <router-link :to ="{ name: 'login'}">로그인</router-link></li>
                        <li><router-link :to ="{ name: 'register'}">개새끼</router-link></li>
                        <li><router-link :to="{ name : 'test'}">asd</router-link></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
    export default {

    }
</script>