<template>
    <v-app style="position: absolute; top: 0;">
        <div style="z-index: 1000; position: absolute; top:35%; width: 100%; color: white; font-weight: 500">
                    <div class="row" style="height: auto; margin: 3%;">
                        <div class="col-6" style="padding-right: 3%;">
                            <div class="moveBox" href="https://play.google.com/store/apps/details?id=kr.ac.yjc.wdj.hikonnect">
                                        <img width="40" style="margin:2%; margin-left: 4%; display: inline;" src="http://hikonnect.ga/images/phone.png" alt="">
                                        <p style="display: inline; font-size: 20px; text-align: center; font-weight: bold; text-align: center; vertical-align: middle;">App Store</p>
                            </div>
                        </div>
                    <div class="col-6" style="padding-left: 3%;">
                        <div class="moveBox" style="float: left;" >
                                <img width="40" style="margin:2%; margin-left: 4%; display: inline;" src="http://hikonnect.ga/images/list.png" alt="">
                                    <p style="display: inline; font-size: 20px; text-align: center; font-weight: bold; text-align: center; vertical-align: middle;">Groups List</p>
                        </div>
                        </div>
                    </div>
                </div>
        <div class="row">
            <v-carousel hide-controls>
                <v-carousel-item src="http://hikonnect.ga/images/main_2.jpeg">
                </v-carousel-item>
            </v-carousel>
            </div>
            <div>
                <div class="row" style="margin: 3% 10%;">
                    <div class="col-4" style="padding: 2%;">
                        <div style="text-align: center;">
                            <img class="col-2" height="60" src="http://hikonnect.ga/images/alone.png" alt="">
                        </div>
                        <div>
                            <p class="col-10" style="color: #C9C9C9;"><b>그룹 멤버들의 고립감 해소</b>
                            <br><br>
                            그룹 멤버 간 연락이 잘 되지 않아 발생하는 고립감을 해소하고, 어디서나 팀원의 위치를 파악 가능하여 함께 하고 있다는 기분이 들게 한다.</p>
                        </div>
                    </div>
                    <div class="col-4" style="padding: 2%;">
                        <div style="text-align: center;">
                            <img class="col-2" height="60" src="http://hikonnect.ga/images/why.png" width="270" alt="">
                        </div>
                        <div>
                            <p class="col-10"><b>그룹 멤버들의 이탈 방지</b>
                            <br><br>
                            위치 메모와 실시간으로 연락 가능한 무전 기능을 통해 그룹 멤버들의 산행로 이탈 가능성을 낮출 수 있다.</p>
                        </div>
                    </div>
                    <div class="col-4" style="padding: 2%;">
                        <div style="text-align: center;">
                            <img class="col-2" height="60" src="http://hikonnect.ga/images/data.png" width="270" alt="">
                        </div>
                        <div>
                            <p class="col-10"><b>데이터 송수신 보장</b>
                            <br><br>
                            내부 통신망을 구축해, 데이터 커버리지 밖에서도 연결이 끊어지지 않고 유지될 수 있다.</p>
                        </div>
                    </div>
                    </div>
                </div>
    </v-app>
</template>
<script>
    export default {
    }
</script>
<style>
    .carousel__controls {
        background: rgba(0, 0, 0, 0.0);
    }

    .definition {
        font-size: 1.2em;
    }
    .carousel {
        height: 650px;
    }
    .carousel .carousel__controls .btn {
        width: 2.7%;
        height: 1%;
        border-radius: 50%;
        min-height: 92%;
        border-radius: 50%;
        border-color: #88888800;
    }
    .jumbotron__image {
        top: 50%;
    }
    .jumbotron {
        padding: 0;
    }
    .moveBox {
        float: right;
        -webkit-border-top-right-radius: 50px 45px;
        -webkit-border-top-left-radius: 50px 45px;
        -webkit-border-bottom-right-radius: 50px 45px;
        -webkit-border-bottom-left-radius: 50px 45px;
        padding: 1.8%;
        border: 3px solid white;
        width: 40%; 
        height: auto; 
        margin: auto;
    }
</style>