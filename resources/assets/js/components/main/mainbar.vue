<!--
@function
sessionver 세션을 확인하는 함수
alerter    알림내용을 보여주는 함수

@variable

alerting   몇 개의 알림이 있는지 알려주는 변수
-->
<template>
    <div>
        <nav class="navbar navbar-default" style="width: 700px">
            <div class="container-fluid" >
                <div class="nav navbar-nav">
                   <li><router-link  :to="{ name : 'main'}">홈으로</router-link></li>
                </div>
                <div>
                    <ul class="nav navbar-nav">

                        <li><router-link :to ="{ name: '#'}">공지사항</router-link></li>
                        <li><router-link :to="{ name : '#'}">그룹방 조회 & 생성</router-link></li>
                        <li><router-link :to="{ name : '#'}">나의 그룹</router-link></li>
                        <li><router-link :to="{ name : '#'}">알림</router-link>
                        <li type="text" v-if="sessionver() == 'true'">{{ alerting }}</li>
                        <li><router-link :to="{ name : 'mypage'}">마이페이지</router-link></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
    export default {
        methods: {
            sessionver() {
                if(sessionStorage.getItem('userid') != null) {
                    this.alerter();
                    return 'true';
                }
            },
            alerter() {
                setInterval(function () {
                        let uri = 'http://localhost:8000/main/' + sessionStorage.getItem('uuid');
                        this.axios.get(uri).then((response) => {
                            this.alerting = response.data;
                            console.log(response.data);
                        })
                             }, 3000)
            }
        },
            data() {
                return {
                    alerting: 0,
                }
            }

    }
</script>