<template>
    <div>
        <h1>마이페이지</h1>


                            <span id="userid"><label>아이디</label>{{ userid }}</span><br>
                            <span id="nickname"> <label>닉네임</label>{{ nickname }}</span><br>
                            <span>
                            <span id="level"><label>산행등급</label>{{ rank }}</span>
                            <router-link  :to="{ name: 'level' }" class = "btn btn-primary"> !</router-link>
                            </span><br>
                            <span id="hour"> <label>총 산행 시간</label>{{ mttime }}</span><br>
                            <span id="speed"><label>평균 등산 속도</label>{{ avgspeed }}</span><br>
                            <span id="history"><label>최근 등산 기록</label>{{ history }}</span><br>
                            <router-link  :to="{ name: 'graph' }" class = "btn btn-primary"> 이전 등산기록</router-link>
                            <br>
                            <br>
                            <router-link  :to="{ name: 'modify' }" class = "btn btn-primary"> 수정</router-link>
                            <router-link style='margin-left: 298px' :to="{ name: 'main' }" class = "btn btn-primary"> 취소</router-link>

    </div>
</template>
<script>
    export default {
        data()  {
            return {
                userid : '',
                nickname: '',
                rank : '',
                mttime : '',
                avgspeed : '',
                history : '',
            }
        },
        created: function () {
            let uri = 'http://localhost:8000/mypage/' + sessionStorage.getItem('uuid');
            this.axios.get(uri).then((response) => {

                var datavalue = Object.values(response.data);
                console.log(response.data);
                this.userid = sessionStorage.getItem('userid');
                this.nickname = sessionStorage.getItem('nickname');
                this.rank = datavalue[0].grade;
                this.mttime = datavalue[0].hiking_time;
                this.avgspeed = datavalue[0].avg_speed + ' km/h';
                this.history = '&nbsp;&nbsp;&nbsp;&nbsp;'
                    +datavalue[0].recent_hiking.created_at.substring(0,10) + '/' + datavalue[0].hiking_group_name
                    +'/';

            })
        }
    }
</script>