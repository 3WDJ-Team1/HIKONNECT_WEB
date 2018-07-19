<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <card>
                    <h4 slot="header" class="card-title">ハイキングスケジュール作成</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <fg-input type="text"
                                          label="題名"
                                          v-model="title">
                                </fg-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>募集内容</label>
                                    <textarea rows="5" class="form-control border-input"
                                              @keyup.enter.native="enterEvent"
                                              v-model="content">
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ハイキング経路</label>
                                    <autocomplete :updateItem="updateItem"></autocomplete>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ハイキング一字</label>
                                    <div style="height: 30px; width: 150px; border: solid 1px #e3e3e3; border-radius: 5px;">
                                        <datetime
                                                style="margin: 5px;"
                                                v-model="date"
                                                placeholder="ハイキング一字">
                                        </datetime>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ハイキング時間</label>
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
                                取り消し
                            </button>
                            <button type="submit" class="btn btn-info btn-fill float-right"
                                    @click="updateDate">
                                登録
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
                    HH: '',
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


            enterEvent()    {
                this.content += "<br>";
            },
            backCalender()  {
                this.$EventBus.$emit('backCalender', 'true');
            },
            updateDate() {

                axios.put(this.$HttpAddr + '/schedule/' + this.updateItem.no, {
                    /*
                        @todo localStorage.getItem('userUuid')
                    */
                    title: this.title,
                    content: this.content,
                    route: this.mountain_path,
                    stDate: this.date.substring(0, 4) + "-" + this.date.substring(5, 7) + "-" + this.date.substring(8, 10) +
                        " " + this.yourData['HH'] + ":" + this.yourData['mm'] + ":" + this.yourData['ss'],
                    mnt_id: this.mountain_num

                })
                    .then(response => {
                        if (response.data == 'true') {
                            const notification = {
                                template: "<span><b>成功的に作成しました。</b></span>"
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
                                template: "<span><b>作成に失敗しました。</b></span>"
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