<template>
    <div>
        <h1>마이페이지</h1>
        <div class="container" style="margin-left: 130px;" >
            <div class="row">
                <div class="panel panel-default" style="margin-top: 150px">
                    <div class="panel-body">

                        <span><label>아이디</label></span>{{ userid }}<br>
                        <span> <label>닉네임</label>{{ nickname }} </span><br>
                        <span>
                            <span><label>산행등급</label>{{ rank }}  </span>
                            <router-link  :to="{ name: 'level' }" class = "btn btn-primary"> !</router-link>
                            </span><br>
                        <span> <label>총 산행 시간</label>{{ mttime }}  </span><br>
                        <span><label>평균 등산 속도</label> {{ avgspeed }}  </span><br>
                        <span><label>최근 등산 기록</label> &nbsp;&nbsp;&nbsp;&nbsp;{{ history }}  </span><br>
                        <router-link  :to="{ name: 'graph' }" class = "btn btn-primary"> 등산 기록 그래프</router-link>
                        <br>
                        <br>
                        <router-link  :to="{ name: 'modify' }" class = "btn btn-primary"> 수정</router-link>
                        <router-link style='margin-left: 298px' :to="{ name: 'main' }" class = "btn btn-primary"> 취소</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data()  {
            return {
                userid : sessionStorage.getItem('userid'),
                nickname: sessionStorage.getItem('nickname'),
                rank : '동네 앞산',
                mttime : '없음',
                avgspeed : '없음',
                history : '없음',
            }
        },
        created: function () {
            let uri = 'http://localhost:8000/api/mypage/' + sessionStorage.getItem('uuid');
            this.axios.get(uri).then((response) => {
                var datavalue = Object.values(response.data);
                console.log(response.data);
                if(response.data != 'false') {
                    this.userid = sessionStorage.getItem('userid');
                    this.nickname = sessionStorage.getItem('nickname');
                    this.rank = datavalue[0].grade;
                    this.mttime = datavalue[0].hiking_time;
                    this.avgspeed = datavalue[0].avg_speed + ' km/h';
                    this.history = datavalue[0].recent_hiking.created_at.substring(0, 10) + '/' + datavalue[0].hiking_group_name
                    + '/';
                }
            })
        }
    }
</script>