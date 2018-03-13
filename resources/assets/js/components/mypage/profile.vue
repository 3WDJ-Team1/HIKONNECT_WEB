<template>
    <div>
        <h1>마이페이지</h1>
        <div class="container" style="margin-left: 130px;" >
            <div class="row">
                <div class="col-md-5 col-md-offset-2">
                    <div class="panel panel-default" style="margin-top: 150px">
                        <div class="panel-body">

                            <label>아이디</label><h3 id="userid"></h3>
                            <label>닉네임</label><h3 id="nickname"></h3>
                            <label>산행등급</label><h3 id="level"></h3>
                            <label>총 산행 시간</label><h3 id="hour"></h3>
                            <label>평균 등산 속도</label><h3 id="speed"></h3>
                            <label>최근 등산 기록</label><h3 id="history"></h3>
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
        mounted: function () {

        }
    }
</script>