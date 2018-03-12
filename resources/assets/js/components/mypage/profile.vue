<template>
    <div>
        <h1>마이페이지</h1>
        <div class="container" style="margin-left: 130px;" >
            <div class="row">
                <div class="col-md-5 col-md-offset-2">
                    <div class="panel panel-default" style="margin-top: 150px">
                        <div class="panel-body">
                           <label>닉네임</label><h3></h3>
                            <label>닉네임</label><h3></h3>
                            <label>닉네임</label><h3></h3>
                            <label>닉네임</label><h3></h3>
                            <label>닉네임</label><h3></h3>
                            <label>닉네임</label><h3></h3>
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

    }
</script>