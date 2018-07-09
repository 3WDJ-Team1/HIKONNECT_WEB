<template>
    <div>
        <h2 style="font-family: 'Do Hyeon', sans-serif;">노란 선을 클릭하여 <br> 경로를 만들어요.</h2>
        <div style="font-family: 'Do Hyeon', sans-serif; border: 1px solid white; padding-bottom: 10px; padding-top: 10px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">
            <img width="13px" style="margin-right: 5px;" src="http://hikonnect.ga/images/tiny-mouse.png" alt="">좌클릭은 경로 선택 시
            <br>
            <img width="13px" style="margin-right: 5px;" src="http://hikonnect.ga/images/right.png" alt="">우클릭은 경로 선택 해지 시
            <br>
            <span style="font-family: 'Do Hyeon', sans-serif;">사용해 주세요</span>
        </div>
        <span style="font-size: 20px; font-family: 'Do Hyeon', sans-serif; color: yellow;">※경로가 클릭되지 않을 시 지도를 확대해서 <br>정확한 위치를 클릭하세요.</span>
        <div class="row" style="font-size: 25px; font-family: 'Do Hyeon', sans-serif; margin-bottom: 15px;">
            <div class="col-md-6">
                <img src="http://localhost:8000/images/start.png" style="font-size: 2em" alt=""> 시작점
            </div>
            <div class="col-md-6">
                <span style="padding-right: 10px;"><img style="font-size: 2em" src="http://localhost:8000/images/check.png" alt=""> 반환점</span>
            </div>
        </div>
        <div class="row" style="font-size: 25px; font-family: 'Do Hyeon', sans-serif;">
            <div class="col-md-6">
                <img style="font-size: 2em" src="http://localhost:8000/images/end.png" alt=""> 도착점
            </div>
            <div class="col-md-6">
                <img style="font-size: 2em;" src="http://localhost:8000/images/startEnd.png" alt="">
                시종점
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "map-explain"
    }
</script>

<style scoped>

</style>