<template>
    <div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                   <router-link  :to="{ name : 'main'}">홈으로</router-link>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li> <router-link :to ="{ name: 'login'}">로그인</router-link></li>
                        <li><router-link :to ="{ name: 'test'}">공지사항</router-link></li>
                        <li><router-link :to="{ name : '#'}">그룹방 조회 & 생성</router-link></li>
                        <li><router-link :to="{ name : '#'}">나의 그룹</router-link></li>
                        <li><router-link :to="{ name : '#'}">알림</router-link></li>
                        <li ><router-link :to="{ name : '#'}">마이페이지</router-link></li>
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