<template>
    <div>
        <h1>마이페이지</h1>
        <div class="container" style="margin-left: 130px;" >
            <div class="row">
                <div class="col-md-5 col-md-offset-2">
                    <div class="panel panel-default" style="margin-top: 150px">
                        <div class="panel-body">

                            <span id="userid"><label>아이디</label></span><br>
                            <span id="nickname"> <label>닉네임</label></span><br>
                            <span id="level"><label>산행등급</label></span><br>
                            <span id="hour"> <label>총 산행 시간</label></span><br>
                            <span id="speed"><label>평균 등산 속도</label></span><br>
                            <span id="history"><label>최근 등산 기록</label></span><br>
                            <router-link  :to="{ name: 'graph' }" class = "btn btn-primary"> 이전 등산기록</router-link>
                            <br>
                            <br>
                            <router-link  :to="{ name: 'modify' }" class = "btn btn-primary"> 수정</router-link>
                            <router-link style='margin-left: 298px' :to="{ name: 'main' }" class = "btn btn-primary"> 취소</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        created: function () {
            let uri = 'http://localhost:8000/mypage/' + sessionStorage.getItem('uuid');
            this.axios.get(uri).then((response) => {

                var datavalue = Object.values(response.data);
                console.log(response.data);
                $('#userid').append('&nbsp;&nbsp;&nbsp;&nbsp;'+sessionStorage.getItem('userid'));
                $('#nickname').append('&nbsp;&nbsp;&nbsp;&nbsp;'+sessionStorage.getItem('nickname'));
                $('#level').append('&nbsp;&nbsp;&nbsp;&nbsp;'+datavalue[0].grade);
                $('#hour').append('&nbsp;&nbsp;&nbsp;&nbsp;'+datavalue[0].hiking_time);
                $('#speed').append('&nbsp;&nbsp;&nbsp;&nbsp;'+datavalue[0].avg_speed+' km/h');
                $('#history').append('&nbsp;&nbsp;&nbsp;&nbsp;'
                    +datavalue[0].recent_hiking.created_at.substring(0,10) + '/' + datavalue[0].hiking_group_name
                    +'/');

            })
        }
    }
</script>