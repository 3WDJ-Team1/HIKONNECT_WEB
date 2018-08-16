<template>
    <v-app style="position: absolute; top: 0;">
        <div style="z-index: 1000; color: white;">
                    <div>
                        <p style="position: absolute; top:20%; width: 100%; text-align: center; font-size: 3rem; font-family: 'Cantata One', serif;">A convenient group hiking
                            <br> to maintain a healthy life</p>
                    </div>
                    <div class="row" style="position: absolute; top:37%; width: 100%;">
                        <div class="col-6" style="padding-right: 1%;">
                            <div class="moveBox" href="https://play.google.com/store/apps/details?id=kr.ac.yjc.wdj.hikonnect">
                                        <img width="40" style="margin:2% 11% 2% 4%; display: inline;" src="http://hikonnect.ga/images/store.png" alt="">
                                        <p style="display: inline; font-size: 25px; text-align: center; vertical-align: middle;">App Store</p>
                            </div>
                        </div>
                    <div class="col-6" style="padding-left: 3%;">
                        <div class="moveBox" style="float: left;" >
                                <img width="40" style="margin:2% 11% 2% 4%; display: inline;" src="http://hikonnect.ga/images/lists.png" alt="">
                                    <p style="display: inline; font-size: 25px; text-align: center; vertical-align: middle;">Groups List</p>
                        </div>
                        </div>
                    </div>
                </div>
        <div class="row">
            <v-carousel hide-controls>
                <v-carousel-item src="http://hikonnect.ga/images/m1.jpg">
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/m4.jpeg">
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/m3.jpeg">
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/m2.jpeg">
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/m5.jpeg">
                </v-carousel-item>
                 <v-carousel-item src="http://hikonnect.ga/images/m6.jpeg">
                </v-carousel-item>
            </v-carousel>
            </div>
            <div>
                <div class="row" style="margin-top: 2%;">
                    <div class="col-4" style="border-right: 1px solid #C9C9C9; padding-right: 7%; padding-left: 7%;">
                        <div style="text-align: center;" class="row">
                            <img width="40" style="margin: auto auto 5%; margin-top: 6%;" height="40" src="http://hikonnect.ga/images/alones.png">
                        </div>
                        
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <p style="text-align: center; margin: 0; color: #C9C9C9;"><b>グループメンバーの孤立感解消</b></p>
                                <p style="font-size: 12px; padding: 7%; color: #6C6C6C;">グループメンバー間の連絡がうまくいかず、発生する孤立感を解消して、どこでもチームメンバーの位置を把握できて一緒にしているという気持ちにされる。</p>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                    <div class="col-4" style="border-right: 1px solid #C9C9C9; padding-right: 7%; padding-left: 7%;">
                        <div style="text-align: center;" class="row">
                            <img width="40" style="margin: auto auto 5%; margin-top: 6%;" height="40" src="http://hikonnect.ga/images/whys.png">
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <p style="text-align: center; margin: 0; color: #C9C9C9;"><b>グループメンバーの離脱防止</b></p>
                                <p style="font-size: 12px; padding: 7%; color: #6C6C6C;">位置のメモとリアルタイムで連絡可能な無線機能を通じてグループメンバーのサンヘンロ離脱の可能性を下げることができる。</p>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                    <div class="col-4" style="padding-right: 7%; padding-left: 7%;">
                        <div style="text-align: center;" class="row">
                            <img width="40" style="margin: auto auto 5%; margin-top: 6%;" height="40" src="http://hikonnect.ga/images/datas.png">
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <p style="text-align: center; margin: 0; color: #C9C9C9;"><b>データ送受信保障</b></p>
                                <p style="font-size: 12px; padding: 7%; color: #6C6C6C;">内部通信網を構築して、データカバレッジの外でも連結が切れないで維持することができる。</p>
                            </div>
                            <div class="col-1"></div>
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
        border: 1px solid white;
        width: 40%; 
        height: auto; 
        margin: auto;
    }
</style>