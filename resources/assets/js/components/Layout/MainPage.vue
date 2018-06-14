
<template>
    <v-app>
        <v-content style="padding: 0;">
            <section>
                <v-parallax
                        :src="httpAddr + '/images/main_2.jpeg'"
                        height="650">
                    <v-layout
                            column
                            align-center
                            justify-center
                            class="white--text">
                        <h1
                                class="white--text mb-2
                        display-1
                        text-xs-center">
                            하이커넥트
                        </h1>
                        <div class="subheading mb-3 text-xs-center">감바리야</div>
                        <v-btn
                                class   ="red darken-4 mt-5"
                                dark
                                href="https://play.google.com/store/apps/details?id=kr.ac.yjc.wdj.hikonnect"
                                large
                                style   ="padding: 0;">
                            GET APPLICATION
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-layout
                        column
                        wrap
                        class="my-5"
                        align-center
                        style="padding: 3% 0;"
                >
                    <v-flex
                            xs12
                            sm4
                            class="my-3">
                        <div    class="text-xs-center">
                            <h2     class="headline">연결 지향 프로젝트</h2>
                            <span   class="subheading">
                    하이커넥트는 동행인들의 연결을 위해 만들어졌습니다.
                </span>
                        </div>
                    </v-flex>
                    <v-flex xs12 md12>
                        <v-container grid-list-xl>
                            <v-layout
                                    row
                                    wrap
                                    align-center>
                                <v-flex
                                        xs12
                                        md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon
                                                    x-large
                                                    class="light-blue--text">person_pin</v-icon>
                                        </v-card-text>
                                        <v-card-title
                                                primary-title
                                                class="layout justify-center">
                                            <div class="headline text-xs-center">실시간 위치 확인</div>
                                        </v-card-title>
                                        <v-card-text class="definition">
                                            하이커넥트는 동행인의 실시간 위치를 확인하여, 지도에 나타냅니다.
                                            본인의 페이스에 맞추어 빠른 사람은 빠르게, 느린 사람은 느리게 가더라도,
                                            자신과 동행인의 거리를 파악하고, 떨어져 있더라도 함께하고 있음을 느껴보세요.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon
                                                    x-large
                                                    class="light-blue--text">radio</v-icon>
                                        </v-card-text>
                                        <v-card-title
                                                primary-title
                                                class="layout justify-center">
                                            <div class="headline">무전 기능</div>
                                        </v-card-title>
                                        <v-card-text class="definition">
                                            하이커넥트는 핸드폰을 통해 1:n 으로 통신하는 무전 기능을 제공합니다.
                                            무전기를 따로 들고 다니지 않아도 효율적으로 다수의 사람에게 무전을 보낼 수 있습니다.
                                            게다가, 중간에서 중계해주는 귀찮은 일은 하지 않아도 되지요.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon
                                                    x-large
                                                    class="light-blue--text">phonelink_ring</v-icon>
                                        </v-card-text>
                                        <v-card-title
                                                primary-title
                                                class="layout justify-center">
                                            <div class="headline text-xs-center">데이터가 안될 때의 사용</div>
                                        </v-card-title>
                                        <v-card-text class="definition">
                                            기본적으로 하이커넥트는 LTE를 기반으로 서비스를 제공합니다만,
                                            데이터 커버리지(LTE 및 3G를 이용할 수 있는 무선 인터넷 환경)를 벗어나는 곳에서는
                                            wifi-direct 기술을 이용하여 P2P 통신을 함으로써, 연결을 유지할 수 있습니다.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section>
                <v-parallax
                        :src="httpAddr + '/images/main_3.jpeg'"
                        height="700">
                    <v-layout
                            column
                            align-center
                            justify-end>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-layout
                        column
                        wrap
                        class="my-5"
                        align-center
                        style="padding: 3% 0;"
                >
                    <v-flex
                            xs12
                            sm4
                            class="my-3">
                        <div    class="text-xs-center">
                            <h2     class="headline">산행로 이탈 방지</h2>
                            <span   class="subheading">
                    산행로 숙지 미숙에 의한 조난 해소
                </span>
                        </div>
                    </v-flex>
                    <v-flex xs12 md12>
                        <v-container grid-list-xl>
                            <v-layout
                                    row
                                    wrap
                                    align-center>
                                <v-flex
                                        xs12
                                        md6>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon
                                                    x-large
                                                    class="light-blue--text">near_me</v-icon>
                                        </v-card-text>
                                        <v-card-title
                                                primary-title
                                                class="layout justify-center">
                                            <div class="headline text-xs-center">예정 산행로 표시</div>
                                        </v-card-title>
                                        <v-card-text class="definition">
                                            하이커넥트는 그룹을 만들 당시 입력된 경로를 토대로, 올바른 산행로를 지도에 나타냅니다.
                                            산행로 위에 뜨는 동행인들과 함께 연결(connect)되어 있음을 느껴보세요.
                                            본인이 길을 제대로 가고 있는 지, 다른 사람들도 제대로 가고 있는 지 한 눈에 파악할
                                            수 있습니다.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md6>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon
                                                    x-large
                                                    class="light-blue--text">pin_drop</v-icon>
                                        </v-card-text>
                                        <v-card-title
                                                primary-title
                                                class="layout justify-center">
                                            <div class="headline">위치 메모</div>
                                        </v-card-title>
                                        <v-card-text class="definition">
                                            하이커넥트는 위치에 메모를 남겨, 해당 반경에 들어서면 알림을 주는 위치 메모 서비스를
                                            제공합니다.
                                            위치 메모 서비스를 이용해, 분기점에서 길을 잃지 않을 수 있고,
                                            특정 위치의 특정한 상황에 미리 대처할 수 있습니다.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section>
                <v-container grid-list-xl>
                    <v-layout
                            row
                            wrap
                            justify-center
                            class="my-5">
                        <v-flex
                                xs12
                                sm12
                                md12>
                            <v-card class="elevation-0 transparent">
                                <v-card-title
                                        primary-title
                                        class="layout justify-center">
                                    <div class="headline">Contact us</div>
                                </v-card-title>
                                <v-card-text class="layout justify-center">
                                    영진전문대학 컴퓨터정보계열 3WDJ 1조
                                </v-card-text>
                                <v-list class="transparent layout justify-center" >
                                    <v-list-tile
                                            v-for="item in contactList"
                                            :key="item.value">
                                        <v-list-tile-action>
                                            <v-icon class="red--text text--darken-1">{{ item.icon }}</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>{{ item.value }}</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>
        </v-content>
    </v-app>
</template>
<script>
    export default {
        data: () => ({
            title   : 'Your Logo',
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
    .definition {
        font-size: 1.2em;
    }
</style>