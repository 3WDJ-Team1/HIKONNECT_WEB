<template>
    <v-app style="position: absolute; top: 0;">
        <h1 style="z-index: 1000; position: absolute; top:7%; left: 30%; color: white; font-weight: 500">
            A convenient group hiking
            <br>&nbsp;to maintain a healthy life
        </h1>
        <h3 style="z-index: 1000; position: absolute; top:20%; left: 40%; color: white; font-weight: 500">
            It design your life
        </h3>
        <div class="row">
            <v-carousel hide-controls>
                <v-carousel-item src="http://hikonnect.ga/images/main_1.jpeg">
                    <!-- <v-btn
                            class="red darken-4 mt-5"
                            dark
                            href="http://localhost:8000/#/group"
                            large
                            style="border: 0; background-color: #ffb500; opacity: 1; font-size: 40px; height: auto; width: 22%; font-family: 'Gothic A1', sans-serif; padding: 0; position: relative; top:70%; left: 38%">
                        그룹 리스트로 이동하기
                    </v-btn> -->
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/main_2.jpeg">
                    <!-- <v-btn
                            class="mt-5"
                            dark
                            href="https://play.google.com/store/apps/details?id=kr.ac.yjc.wdj.hikonnect"
                            large
                            style="border: 0; background-color: #ffb500; opacity: 1; font-size: 40px; height: auto; width: 22%; font-family: 'Gothic A1', sans-serif; padding: 0; position: relative; top:70%; left: 38%">
                        어플 다운 받으러 가기
                    </v-btn> -->
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/main_3.jpeg">
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/mountain_1.jpg">
                </v-carousel-item>
            </v-carousel>
            </div>
            <div style="background-color: #eaeaea;">
                <div class="row" style="margin-right: 4%; margin-left: 4%; margin-top: 4%; margin-bottom: 2%;">
                    <div class="col-4">
                        <div class="row" style="width: 80%; margin: auto;">
                            <img class="col-2" height="60" src="http://localhost:8000/images/alone.png" alt="">
                            <p class="col-10"><b>그룹 멤버들의 고립감 해소</b>
                            <br><br>
                            그룹 멤버 간 연락이 잘 되지 않아 발생하는 고립감을 해소하고, 어디서나 팀원의 위치를 파악 가능하여 함께 하고 있다는 기분이 들게 한다.</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row" style="width: 80%; margin: auto;">
                            <img class="col-2" height="60" src="http://localhost:8000/images/why.png" width="270" alt="">
                            <p class="col-10"><b>그룹 멤버들의 이탈 방지</b>
                            <br><br>
                            위치 메모와 실시간으로 연락 가능한 무전 기능을 통해 그룹 멤버들의 산행로 이탈 가능성을 낮출 수 있다.</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row" style="width: 80%; margin: auto;">
                            <img class="col-2" height="60" src="http://localhost:8000/images/data.png" width="270" alt="">
                            <p class="col-10"><b>데이터 송수신 보장</b>
                            <br><br>
                            내부 통신망을 구축해, 데이터 커버리지 밖에서도 연결이 끊어지지 않고 유지될 수 있다.</p>
                        </div>
                    </div>
                </div>
                </div>
                <div style="background-color: #eaeaea;">
                <div class="row" style="margin-right: 4%; margin-left: 4%; margin-bottom: 4%;">
                    <div class="col-4">
                        <div class="row" style="width: 80%; margin: auto;">
                            <img class="col-2" height="70" src="http://localhost:8000/images/tell.png" alt="">
                            <p class="col-10"><b>중계가 필요없는 무전기능</b>
                            <br><br>
                            보통 3km이내의 거리에서만 무전을 할 수 있으므로 그 이상의 거리의 멤버에게는 중계를 해 주어야하는 번거러움을 해결할 수 있다.
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row" style="width: 80%; margin: auto;">
                            <img class="col-2" height="60" src="http://localhost:8000/images/timmer.png" width="270" alt="">
                            <p class="col-10"><b>하산 여부 체크</b>
                            <br><br>
                            하산하던 사람이 도착지 부근 50M 부근에 접근하면 등산완료버튼 활성화, 클릭 시 자신의 등산완료를 멤버들에게 알릴 수 있으며 등산기록을 확인할 수 있다.</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row" style="width: 80%; margin: auto;">
                            <img class="col-2" height="60" src="http://localhost:8000/images/memo.png" width="270" alt="">
                            <p class="col-10"><b>위치메모로 갈림길에서 길 안내</b>
                            <br><br>
                            선두가 남긴 위치 메모로 갈림길에서 길을 안내하면 후미는 선두가 남긴 위치 메모로 길을 잃는 것을 방지</p>
                        </div>
                    </div>
                </div>
                </div>
                 <div style="background-color: #00924545;">
            <div class="row" style="height: auto; margin: 3%;">
                <div class="col-5">
                    <div class="moveBox">
                                <img width="40" style="margin:2%; margin-left: 4%; display: inline;" src="http://localhost:8000/images/phone.png" alt="">
                                <p style="display: inline; font-size: 20px; text-align: center; font-weight: bold; text-align: center; vertical-align: middle;">App Store</p>
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <div class="moveBox" style="float: left;">
                            <img width="40" style="margin:2%; margin-left: 4%; display: inline;" src="http://localhost:8000/images/list.png" alt="">
                                <p style="display: inline; font-size: 20px; text-align: center; font-weight: bold; text-align: center; vertical-align: middle;">Groups List</p>
                    </div>
                    </div>
                </div>
                </div>
    </v-app>
</template>
<script>
    export default {
        data: () => ({
            items: [
                {
                    src: 'http://localhost:8000/images/main_1.jpeg'
                },
                {
                    src: 'http://hikonnect.ga/images/main_3.jpeg'
                },
                {
                    src: 'http://hikonnect.ga/images/mountain_3.png'
                },
                {
                    src: 'http://hikonnect.ga/images/unnamed.jpg'
                }
            ],
            title: 'Your Logo',
            httpAddr: Laravel.host,
            contactList: [
                {
                    icon: "phone",
                    value: "010-3342-3589"
                },
                {
                    icon: "place",
                    value: "대한민국 대구광역시 영진전문대학"
                },
                {
                    icon: "email",
                    value: "kasueu0814@gmail.com"
                }
            ]
        }),
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
        height: 393px;
    }
    .carousel .carousel__controls .btn {
        width: 1%;
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
    .carousel__controls {
        visibility: hidden;
    }
    .moveBox {
        float: right;
        -webkit-border-top-right-radius: 50px 40px;
        -webkit-border-top-left-radius: 50px 40px;
        -webkit-border-bottom-right-radius: 50px 40px;
        -webkit-border-bottom-left-radius: 50px 40px; 
        padding: 1.8%;
         background-color: white; 
         width: 28%; 
         height: auto; 
         margin: auto; 
         box-shadow: 10px 10px 20px #009245b3;
    }
</style>