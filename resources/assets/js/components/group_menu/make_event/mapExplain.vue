<template>
    <div>
        <h2 style="font-family: 'Gothic A1', sans-serif;">黄色い線をクリックして <br> 経路を作ります。</h2>
        <div style="font-family: 'Gothic A1', sans-serif; border: 1px solid white; padding-bottom: 10px; padding-top: 10px; margin-top: 10px; margin-bottom: 10px; font-size: 25px;">
            <img width="13px" style="margin-right: 5px;" src="http://hikonnect.ga/images/tiny-mouse.png" alt="">左クリック→経路を選択
            <br>
            <img width="13px" style="margin-right: 5px;" src="http://hikonnect.ga/images/right.png" alt="">右クリック→選択した経路を解除
            <br>
            <span style="font-family: 'Gothic A1', sans-serif;">使用してください。</span>
        </div>
        <span style="font-size: 20px; font-family: 'Gothic A1', sans-serif; color: yellow;">※経路がクリックできない場合マップを拡大して <br>正しい位置をクリックしてください。</span>
        <div class="row" style="font-size: 25px; font-family: 'Gothic A1', sans-serif; margin-bottom: 15px;">
            <div class="col-md-6">
                <img src="http://localhost:8000/images/start.png" style="font-size: 2em" alt=""> スタートマーク
            </div>
            <div class="col-md-6">
                <span style="padding-right: 10px;"><img style="font-size: 2em" src="http://localhost:8000/images/check.png" alt=""> 折り返し点</span>
            </div>
        </div>
        <div class="row" style="font-size: 25px; font-family: 'Gothic A1', sans-serif;">
            <div class="col-md-6">
                <img style="font-size: 2em" src="http://localhost:8000/images/end.png" alt=""> エンドマーク
            </div>
            <div class="col-md-6">
                <img style="font-size: 2em;" src="http://localhost:8000/images/startEnd.png" alt="">
                始終点
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