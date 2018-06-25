<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="container" style="max-width: 100%;">
        <div class="row">
            <div class="col-md-12">
                <card>
                    <h1 slot="header" class="card-title" style="font-family: 'Do Hyeon', sans-serif;">산행 일정 작성</h1>
                    <form>
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom: 0px; padding-top: 0px;">
                                <label><h3 style="margin: 0; font-family: 'Do Hyeon', sans-serif;">제목</h3></label>
                                <fg-input type="text"
                                          v-model="title">
                                </fg-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom: 0px; padding-top: 0px;">
                                <div class="form-group">
                                    <label><h3 style="margin: 0; font-family: 'Do Hyeon', sans-serif;">모집 내용</h3></label>
                                    <textarea rows="5" class="form-control border-input"
                                              v-model="content">
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="height: 75px;">
                            <div class="col-md-4" style="padding-bottom: 0px; padding-top: 0px;">
                                <div class="form-group">
                                    <label><h3 style="margin: 0; font-family: 'Do Hyeon', sans-serif;">등산경로</h3></label>
                                    <img height="20px" src="http://hikonnect.ga/images/map.png" alt="">
                                    <autocomplete></autocomplete>
                                </div>
                            </div>
                            <div class="col-md-4" style="padding-bottom: 0px; padding-top: 0px;">
                                <div class="form-group">
                                    <label><h3 style="margin: 0; font-family: 'Do Hyeon', sans-serif;">산행일자</h3></label>
                                    <img height="20px" src="http://hikonnect.ga/images/plan.png" alt="">
                                    <div style="    height: 50px;
    width: 200px; border: solid 1px #e3e3e3; border-radius: 5px; font-size: 20px;">
                                        <datetime
                                                style="margin: 5px;"
                                                v-model="date"
                                                placeholder="산행일자">
                                        </datetime>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="padding-bottom: 0px; padding-top: 0px;">
                                <div class="form-group">
                                    <label><h3 style="margin: 0; font-family: 'Do Hyeon', sans-serif;">산행시간</h3></label>
                                    <img height="20px" src="http://hikonnect.ga/images/time.png" alt="">
                                    <br>
                                    <vue-timepicker
                                            style="height: 50px; font-size: 20px;"
                                            :format="yourFormat"
                                            v-model="yourData">
                                    </vue-timepicker>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button></button>
                            <button type="submit" class="btn btn-warning btn-fill float-right" style="padding: 5px; height: 50px;"
                                    @click="backCalender">
                                <p style="font-size: 30px; font-family: 'Do Hyeon', sans-serif;">나가기</p>
                            </button>
                            <button style="padding: 5px; height: 50px;" type="submit" class="btn btn-info btn-fill float-right"
                                    @click="sendData">
                                <p style="font-size: 30px; font-family: 'Do Hyeon', sans-serif;">제출</p>
                            </button>
                        </div>
                    </form>
                </card>
            </div>
        </div>
    </div>
</template>
<script>
    import VueTimepicker from 'vue2-timepicker'
    import autocomplete from './autocomplete'
    import Card from '../../Cards/Card.vue'

    export default {
        components: {
            VueTimepicker,
            autocomplete,
            Card
        },
        name: "group_make_main",
        data() {
            return {
                yourFormat: 'HH:mm',
                title: '',
                content: '',
                date: '',
                mountain_path: [],
                mountain_num: '',
                yourData: {
                    HH: '',
                    mm: '',
                    ss: '00'
                },
            }
        },
        created() {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            this.$EventBus.$on('mountain_path', (path, num) => {
                this.mountain_path = path;
                this.mountain_num = num;
            });
        },
        methods: {
            backCalender()  {
                this.$EventBus.$emit('backCalender', 'true');
            },
            sendData() {
                axios.post(this.$HttpAddr + '/schedule', {
                    uuid: this.$route.params.groupid,
                    leader: sessionStorage.getItem('userid')
                    /*
                        @todo localStorage.getItem('userUuid')
                    */,
                    mnt_id: this.mountain_num,
                    tt: this.title,
                    ct: this.content,
                    stDate: this.date.substring(0, 4) + "-" + this.date.substring(5, 7) + "-" + this.date.substring(8, 10) +
                    " " + this.yourData['HH'] + ":" + this.yourData['mm'] + ":" + this.yourData['ss'],
                    mountP: this.mountain_path
                })
                    .then(response => {
                        console.log(response.data);
                        if (response.data == 'true') {
                            const notification = {
                                template: "<span><b>성공적으로 저장 되었습니다.</b></span>"
                            };
                            this.$notifications.notify(
                                {
                                    component: notification,
                                    icon: 'nc-icon nc-app',
                                    horizontalAlign: 'center',
                                    verticalAlign: 'top',
                                    type: 'success'
                                });
                            this.$EventBus.$emit('makeEventOK', true);

                        } else {
                            const notification = {
                                template: "<span><b>저장을 실패하였습니다.</b></span>"
                            };
                            this.$notifications.notify(
                                {
                                    component: notification,
                                    icon: 'nc-icon nc-app',
                                    horizontalAlign: 'center',
                                    verticalAlign: 'top',
                                    type: 'warning'
                                });
                        }
                    })
            }
        }
    }
</script>
<style>
    .time-picker input.display-time {
        border: 1px solid #e3e3e3;
        border-radius: 6px;
    }
    .form-control {
        height: 50px;
        font-size: 20px;
    }
    .autocomplete__box {
        min-width: 250px;
        min-height: 50px;
        font-size: 20px;
    }
</style>