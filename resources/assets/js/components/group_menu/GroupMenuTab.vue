<!-- 
    @file   GroupMenuTab.vue
    @brief  A component of group menu tab
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   update children components
 -->
<template>
    <!-- @div       wrapper of this component -->
    <div>
        <!-- 일정 만들기 -->
        <v-btn
                style="width: 110px; height: 110px; font-size: 30px; margin-right: 1%; font-weight: bold; color: #ffffff;"
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                v-if="position == 'enter' && listEventB"
                @click="makeEvent"
        >
            生成
        </v-btn>
        <noticeButton v-if="position == 'enter' && noticeP"></noticeButton>

        <joinButton v-if="login != 'undefined'"></joinButton>
        <!-- @v-tabs    there is information of tabs here -->
        <v-tabs
            icons-and-text
            centered color  ="grey lighten-4"
            style           ="width: 95%; margin: auto; margin-top: 20px;"
            grow>
            <!-- @v-tab-slider      the slider of tabs on top -->
            <v-tabs-slider
                color="green accent-4"
                style="height: 5px;">
            </v-tabs-slider>
            <!-- @v-tab             the tabs in slider -->
            <v-tab
                href="#tab-1" @click="changeN">
            <span style="font-size: 20px; font-family: 'Gothic A1', sans-serif;">公知事項</span>
                <v-icon style="font-size: 4em;">announcement</v-icon>
            </v-tab>
            <v-tab href="#tab-2" @click="changeE">
            <span style="font-size: 20px; font-family: 'Gothic A1', sans-serif;">スケジュール</span>
                <v-icon style="font-size: 4em;">event</v-icon>
            </v-tab>
            <v-tab href="#tab-3" @click="changeM">
            <span style="font-size: 20px; font-family: 'Gothic A1', sans-serif;">メンバー</span>
                <v-icon style="font-size: 4em;">group</v-icon>
            </v-tab>
            <!-- @v-tab-item        the items of each tab.
                                    they are linked by 'id' -->
            <v-tab-item
                :key    ="1"
                :id     ="'tab-' + 1">
                <!-- @v-card            inner items of each tab are here. -->
                <v-card flat style="box-shadow: 5px 5px 10px 1px #cecece;">
                    <!-- @router-vue(notice)          routing component whose name is notice.
                         @use                         app.js -->
                    <router-view name="notice" style="box-shadow: 5px 5px 10px 1px #cecece;"></router-view>
                </v-card>
            </v-tab-item>
            <v-tab-item
                :key    ="2"
                :id     ="'tab-' + 2">
                <v-card flat style="height: 700px; box-shadow: 10px 5px 10px 1px #cecece; background-color: white; border: 1px soild whitesmoke;">
                    <router-view name="plan"></router-view>
                </v-card>
            </v-tab-item>
            <v-tab-item
                :key    ="3"
                :id     ="'tab-' + 3">
                <v-card flat style="box-shadow: 10px 5px 10px 1px #cecece; background-color: white; border: 1px soild whitesmoke;" class="tab_full">
                    <router-view name="member_list"></router-view>
                </v-card>
            </v-tab-item>
        </v-tabs>



    </div>
</template>

<script>
    import noticeButton from './group_notice/NoticeWriteBtn'
    import joinButton from './joinButton'
    export default {
        components: {
            joinButton,
            noticeButton
        },
        data()  {
            return  {
                noticeP: true,
                listEventB: false,
                positionN: 0,
                wattingN: 0,
                position: '',
                login: sessionStorage.getItem('userid')
            }
        },
        created()   {
            this.$EventBus.$on('eventOK', (sign) => {
                this.listEventB = true;
                this.noticeP = false;
            });
            this.positionGet();
            this.ownerGet();
        },
        methods:    {
            changeM()   {
                this.listEventB = false;
                this.noticeP = false;
            },
            changeN()   {
                this.listEventB = false;
                this.noticeP = true;
            },
            changeE()   {
                this.listEventB = true;
                this.noticeP = false;
            },
            makeEvent() {
                            this.listEventB = false;
                            this.$EventBus.$emit('eventOOk', 'true');
                        },
            positionGet() {
                // 멤버 정보 서버에서 가지고 오기
                    this.axios.get(this.$HttpAddr + "/list_member/" + this.$route.params.groupid)
                        .then( response => {
                            for(let i = 0; i < response.data[0].enter.length; i++)  {
                                if(response.data[0].enter[i].userid == sessionStorage.getItem('userid')) {
                                    this.positionN++;
                                }
                            };
                            for(let i = 0; i < response.data[0].not_enter.length; i++)  {
                                if(response.data[0].not_enter[i].userid == sessionStorage.getItem('userid')) {
                                    this.wattingN++;
                                }
                            };
                            if(this.wattingN > 0) {
                                this.position = 'not_enter';
                            }
                            // 그룹원이다.
                            else if(this.positionN > 0) {
                                this.position = 'enter';
                            }
                            else    {
                                this.position = 'false';
                            }
                            this.$EventBus.$emit('positionGet', this.position);
                            this.$EventBus.$emit('memberList', response.data[0].enter, response.data[0].not_enter);
                        });
            },
            ownerGet() {
                if (sessionStorage.getItem('userid') != undefined) {
                    this.axios.post(Laravel.host + '/api/checkMember', {
                        uuid: this.$route.params.groupid,
                        userid: sessionStorage.getItem('userid'),
                    }).then(response => {
                        this.$EventBus.$emit('ownerGet', response.data);
                    });
                }
            }
        }
    }
</script>

<style>
.tab_full {
    display: inline-block;
    width: 100%;
}
.tabs__container--icons-and-text .tabs__item .icon {
    margin-bottom: 0px;
}
.tabs__container--icons-and-text {
    background-color: white;
    height: 100%;
}
.grey.lighten-4 {
    margin-bottom: 20px;
}
.tabs__wrapper {
    box-shadow: 5px 5px 10px 1px #cecece;
}
.tabs__slider-wrapper {
    width: 30%;
}
</style>