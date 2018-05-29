<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <card>
                    <h4 slot="header" class="card-title">산행 일정 작성</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <fg-input type="text"
                                          label="제목"
                                          v-model="title">
                                </fg-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>모집 내용</label>
                                    <textarea rows="5" class="form-control border-input"
                                              v-model="content">
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>등산 경로</label>
                                    <autocomplete :updateItem="updateItem"></autocomplete>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>산행일자</label>
                                    <div style="height: 30px; width: 150px; border: solid 1px #e3e3e3; border-radius: 5px;">
                                        <datetime
                                                style="margin: 5px;"
                                                v-model="date"
                                                placeholder="산행일자">
                                        </datetime>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>산행시간</label>
                                    <br>
                                    <vue-timepicker
                                            :format="yourFormat"
                                            v-model="yourData">
                                    </vue-timepicker>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning btn-fill float-right"
                                    @click="backCalender">
                                나가기
                            </button>
                            <button type="submit" class="btn btn-info btn-fill float-right"
                                    @click="sendData">
                                제출
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
    import autocomplete from './update_autocomplete'
    import Card from '../../Cards/Card.vue'

    export default {
        props:  {
            updateItem: {
                type: Object
            }
        },
        components: {
            VueTimepicker,
            autocomplete,
            Card
        },
        data() {
            return {
                yourFormat: 'HH:mm',
                title: '',
                content: '',
                date: '',
                destination: '',
                mountain_path: [],
                mountain_num: '',
                yourData: {
                    hh: '',
                    mm: '',
                    ss: '00'
                },
            }
        },
        created() {
            // 받아온 updateItem을 input박스에 채우기
            this.title = this.updateItem.title;
            this.content = this.updateItem.desc;
            this.date = this.updateItem.date.substring(0, 4) + '-' + this.updateItem.date.substring(5, 7) + '-'
                + this.updateItem.date.substring(8, 10) + 'T00:00:00.000Z';
            this.yourData['HH'] = this.updateItem.time.substring(0, 2);
            this.yourData['mm'] = this.updateItem.time.substring(3, 5);
            this.mountain_path = this.updateItem.route;
            this.mountain_num = this.updateItem.mnt_id;
            this.destination = this.updateItem.destination;
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
                    " " + this.yourData['hh'] + ":" + this.yourData['mm'] + ":" + this.yourData['ss'],
                    mountP: this.mountain_path
                })
                    .then(response => {
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
</style>