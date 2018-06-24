<template>
    <div>
        <h5>노란 선을 클릭하여 경로를 만들어요.</h5>
        <div style="border: 1px solid white; padding-bottom: 10px; padding-top: 10px; margin-top: 10px; margin-bottom: 10px;">
            <img width="13px" style="margin-right: 5px;" src="http://hikonnect.ga/images/tiny-mouse.png" alt="">좌클릭은 경로 선택 시
            <br>
            <img width="13px" style="margin-right: 5px;" src="http://hikonnect.ga/images/right.png" alt="">우클릭은 경로 선택 해지 시
            <br>
            사용해 주세요
        </div>
        <span style="color: yellow;">※경로가 클릭되지 않을 시 지도를 확대해서 정확한 위치를 클릭하세요.</span>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-6">
                <img src="http://hikonnect.ga/images/start.png" alt=""> 시작점
            </div>
            <div class="col-md-6">
                <span style="padding-right: 30px;"><img src="http://hikonnect.ga/images/dest.png" alt=""> 반환점</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="http://hikonnect.ga/images/end.png" alt=""> 도착점
            </div>
            <div class="col-md-6">
                <img src="http://hikonnect.ga/images/end.png" alt=""><span style="font-size: 10px;">도착점과 시작점이 동일할 시</span>
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