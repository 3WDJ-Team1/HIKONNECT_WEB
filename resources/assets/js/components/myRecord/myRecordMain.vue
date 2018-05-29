<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="content">
        <sweet-modal ref="level" blocking>
            <levelModal></levelModal>
        </sweet-modal>
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
                            <p class="card-category">
                                나의 등급
                                <button style="padding: 0px; height: 20px; width: 70px; display:inline-block;" @click="levelModalOpen">
                                    <h6><i class="nc-icon nc-tap-01"></i>등급 설명</h6>
                                </button>
                            </p>
                            <h4 class="card-title">{{rank}}</h4>
                        </div>
                    </stats-card>
                </div>
                <div class="col-md-4">
                    <stats-card>
                        <div slot="header" class="icon-success">
                            <i class="nc-icon nc-watch-time text-success"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category">총 등산 시간</p>
                            <h4 class="card-title">{{total_hiking_t}}</h4>
                        </div>
                    </stats-card>
                </div>

                <div class="col-md-4">
                    <stats-card>
                        <div slot="header" class="icon-danger">
                            <i class="nc-icon nc-ruler-pencil text-danger"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category">총 등산 거리</p>
                            <h4 class="card-title">{{totalD}}km</h4>
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
                            <h4 class="card-title" style="display: inline-block;">내가 등산한 횟수</h4>
                            <b-form-select style="display: inline-block; padding-bottom: 0px;
    padding-top: 0px; float:right; width: 100px" v-model="nowYear" :options="options" class="mb-3" size="sm" />
                        </template>
                    </chart-card>
                </div>

                <div class="col-md-4">
                    <card>
                        <template slot="header">
                            <h4 class="card-title">나의 산행 기록</h4>
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
    import Chartist from 'chartist'
    import Card from '../Cards/Card.vue'
    import ChartCard from '../Cards/ChartCard.vue'
    import StatsCard from '../Cards/StatsCard.vue'
    import levelModal from './levelModal'
    import recordModal from './recordModal'

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
                        series: []
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
                }
            }
        },
        created() {
            this.axios.post(this.$HttpAddr + '/graph', {
                userid: sessionStorage.getItem('userid'),
                year: '2018'
            }).then(response => {
                this.lineChart.data.series.push(response.data);
                console.log(this.lineChart.data.series)
            });
            this.positionPull();
            this.lastRecordPull();
            this.yearSearch();
        },
        methods: {
            yearSearch()  {
                // 가입한 날짜
                for(this.nowYear; Number(sessionStorage.getItem('createdY').substring(0,4)) <= this.nowYear; this.nowYear--)   {
                    this.options.concat({value: this.nowYear, text: this.nowYear});
                }
            },
            levelModalOpen() {
                this.$refs.level.open();
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
                    this.lineChart.data.series.push(response.data);
                    console.log(sessionStorage.getItem('createdY').substring(0,4))
                });
            }
        },
        components: {
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
