<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="content">
        <sweet-modal ref="record" blocking>
            <recordModal></recordModal>
        </sweet-modal>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <stats-card>
                        <div slot="header" class="icon-warning">
                            <i class="nc-icon nc-badge text-warning"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category" id="levelExplain" style="font-size: 18px; font-family: 'Do Hyeon', sans-serif; cursor:pointer">
                                <i class="nc-icon nc-tap-01" style="width: 15px;"></i>
                                나의 등급
                            </p>
                            <h4 class="card-title" style="font-family: 'Do Hyeon', sans-serif;">{{rank}}</h4>
                        </div>
                    </stats-card>
                </div>
                <b-tooltip target="levelExplain" style="max-width: 1000px;" placement="right">
                    <levelModal></levelModal>
                </b-tooltip>
                <div class="col-md-4">
                    <stats-card>
                        <div slot="header" class="icon-success">
                            <i class="nc-icon nc-watch-time text-success"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category" style="font-size: 18px; font-family: 'Do Hyeon', sans-serif;">총 등산 시간</p>
                            <h4 class="card-title" style="font-family: 'Do Hyeon', sans-serif;">{{total_hiking_t}}</h4>
                        </div>
                    </stats-card>
                </div>
                <div class="col-md-4">
                    <stats-card>
                        <div slot="header" class="icon-danger">
                            <i class="nc-icon nc-ruler-pencil text-danger"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category" style="font-size: 18px; font-family: 'Do Hyeon', sans-serif;">총 등산 거리</p>
                            <h4 class="card-title" style="font-family: 'Do Hyeon', sans-serif;">{{totalD}}km</h4>
                        </div>
                    </stats-card>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <chart-card :chart-data="lineChart.data"
                                :chart-options="lineChart.options"
                                :responsive-options="lineChart.responsiveOptions">
                        <template slot="header">
                            <h3 class="card-title" style="font-family: 'Do Hyeon', sans-serif; display: inline-block;">등산한 횟수</h3>
                            <!--<b-form-select style="display: inline-block; padding-bottom: 0px;-->
                            <!--padding-top: 0px; float:right; width: 100px" v-model="nowYear" :options="options" class="mb-3" size="sm" />-->
                        </template>
                    </chart-card>
                </div>
                <div class="col-md-4">
                    <card>
                        <template slot="header">
                            <h3 class="card-title" style="font-family: 'Do Hyeon', sans-serif;">산행 기록</h3>
                        </template>
                        <div class="table-hover">
                            <table class="table" style="text-align:center;">
                                <thead>
                                <slot name="columns">
                                    <th>일정 이름</th>
                                    <th>산행 일자</th>
                                </slot>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in lastRecord" @click="recordModalOpen(item)">
                                    <slot :row="item">
                                        <td>{{ item.title }}</td>
                                        <td>{{ startDate[index] }}</td>
                                    </slot>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Card from '../Cards/Card.vue'
    import ChartCard from '../Cards/ChartCard.vue'
    import StatsCard from '../Cards/StatsCard.vue'
    import levelModal from './levelModal'
    import recordModal from './recordModal'
    import LineChart from "./lineChart";

    export default {
        data() {
            return {
                nowYear: new Date().getFullYear(),
                options: [
                    {value: 2018, text: 2018}
                ],
                rank: '',
                totalD: '',
                total_hiking_t: '',
                lastRecord: [],
                startDate: [],
                lineChart: {
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        series: [
                            [
                                sessionStorage.getItem('1'),
                                sessionStorage.getItem('2'),
                                sessionStorage.getItem('3'),
                                sessionStorage.getItem('4'),
                                sessionStorage.getItem('5'),
                                sessionStorage.getItem('6'),
                                sessionStorage.getItem('7'),
                                sessionStorage.getItem('8'),
                                sessionStorage.getItem('9'),
                                sessionStorage.getItem('10'),
                                sessionStorage.getItem('11'),
                                sessionStorage.getItem('12')
                            ]
                        ]
                    },
                    options: {
                        low: 0,
                        high: 35,
                        showArea: false,
                        height: '245px',
                        axisX: {
                            showGrid: false
                        },
                        lineSmooth: true,
                        showLine: true,
                        showPoint: true,
                        fullWidth: true,
                        chartPadding: {
                            right: 50
                        }
                    },
                    responsiveOptions: [
                        ['screen and (max-width: 640px)', {
                            axisX: {
                                labelInterpolationFnc(value) {
                                    return value[0]
                                }
                            }
                        }]
                    ]
                },
            }
        },
        created() {
            // this.graphPull();
            this.positionPull();
            this.lastRecordPull();
            this.yearSearch();
        },
        methods: {
            yearSearch() {
                // 가입한 날짜
                for (this.nowYear; Number(sessionStorage.getItem('createdY').substring(0, 4)) <= this.nowYear; this.nowYear--) {
                    this.options.concat({value: this.nowYear, text: this.nowYear});
                }
            },
            recordModalOpen(item) {
                this.$refs.record.open();
                this.$EventBus.$emit('recordItem', item)
            },
            lastRecordPull() {
                this.axios.get(this.$HttpAddr + '/hiking_history/' + sessionStorage.getItem('userid'))
                    .then(response => {
                        this.lastRecord = this.lastRecord.concat(response.data);
                        for (let i = 0; i < this.lastRecord.length; i++) {
                            this.startDate[i] = this.lastRecord[i].start_date.substring(0, 4) + "-" + this.lastRecord[i].start_date.substring(5, 7) + "-" + this.lastRecord[i].start_date.substring(8, 10);
                        }
                    });
            },
            positionPull() {
                this.axios.get(this.$HttpAddr + '/user/' + sessionStorage.getItem('userid'))
                    .then(response => {
                        this.rank = response.data[0].grade;
                        this.totalD = response.data.total_distance;
                        this.total_hiking_t = response.data.total_hiking_time.hour + "H"
                            + response.data.total_hiking_time.minute + "M"
                            + response.data.total_hiking_time.second + "S"
                    });
            },
            graphPull() {
                this.axios.post(this.$HttpAddr + '/graph', {
                    userid: sessionStorage.getItem('userid'),
                    year: '2018'
                }).then(response => {

                    sessionStorage.setItem('1', response.data[0]);
                    sessionStorage.setItem('2', response.data[1]);
                    sessionStorage.setItem('3', response.data[2]);
                    sessionStorage.setItem('4', response.data[3]);
                    sessionStorage.setItem('5', response.data[4]);
                    sessionStorage.setItem('6', response.data[5]);
                    sessionStorage.setItem('7', response.data[6]);
                    sessionStorage.setItem('8', response.data[7]);
                    sessionStorage.setItem('9', response.data[8]);
                    sessionStorage.setItem('10', response.data[9]);
                    sessionStorage.setItem('11', response.data[10]);
                    sessionStorage.setItem('12', response.data[11]);
                    console.log(sessionStorage.getItem('createdY').substring(0, 4))
                });
            }
        },
        components: {
            LineChart,
            ChartCard,
            StatsCard,
            Card,
            levelModal,
            recordModal
        },
    }
</script>
<style>

</style>
