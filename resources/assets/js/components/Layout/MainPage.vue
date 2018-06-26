<template>
    <v-app>
        <template>
            <v-carousel hide-controls>
                <v-carousel-item src="http://hikonnect.ga/images/main3.png">
                    <v-btn
                            class="red darken-4 mt-5"
                            dark
                            href="http://localhost:8000/#/group"
                            large
                            style="border: 0; background-color: #ffb500; opacity: 1; font-size: 40px; height: auto; width: 22%; font-family: 'Do Hyeon', sans-serif; padding: 0; position: relative; top:70%; left: 38%">
                        그룹 리스트로 이동하기
                    </v-btn>
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/main.png">
                    <v-btn
                            class="mt-5"
                            dark
                            href="https://play.google.com/store/apps/details?id=kr.ac.yjc.wdj.hikonnect"
                            large
                            style="border: 0; background-color: #ffb500; opacity: 1; font-size: 40px; height: auto; width: 22%; font-family: 'Do Hyeon', sans-serif; padding: 0; position: relative; top:70%; left: 38%">
                        어플 다운 받으러 가기
                    </v-btn>
                </v-carousel-item>
                <v-carousel-item src="http://hikonnect.ga/images/main2.png">
                </v-carousel-item>
            </v-carousel>
        </template>
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

    .carousel .carousel__controls .btn {
        width: 1%;
        border-radius: 50%;
        min-height: 92%;
        border-radius: 50%;
        border-color: #88888800;
    }
    .jumbotron {
        padding: 0;
    }

</style>