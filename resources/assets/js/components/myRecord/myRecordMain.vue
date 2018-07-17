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
                            <i class="nc-icon nc-badge text-warning" style="font-size: 2em; line-height: normal;"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category" id="levelExplain" style="font-weight: 500; font-size: 30px; font-family: 'Gothic A1', sans-serif; cursor:pointer">
                                <i class="nc-icon nc-tap-01" style="font-size: inherit;"></i>
                                （登山）実績
                            </p>
                            <h2 class="card-title" style="font-weight: 500; font-family: 'Gothic A1', sans-serif;">{{rank}}</h2>
                        </div>
                    </stats-card>
                </div>
                <b-tooltip target="levelExplain" style="max-width: 1000px;" placement="right">
                    <levelModal></levelModal>
                </b-tooltip>
                <div class="col-md-4">
                    <stats-card>
                        <div slot="header" class="icon-success">
                            <i class="nc-icon nc-watch-time text-success" style="font-size: 2em; line-height: normal;"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category" style="font-size: 30px; font-weight: 500; font-family: 'Gothic A1', sans-serif;">総登山時間</p>
                            <h2 class="card-title" style=" font-weight: 500; font-family: 'Gothic A1', sans-serif;">{{total_hiking_t}}</h2>
                        </div>
                    </stats-card>
                </div>
                <div class="col-md-4">
                    <stats-card>
                        <div slot="header" class="icon-danger">
                            <i class="nc-icon nc-ruler-pencil text-danger" style="font-size: 2em; line-height: normal;"></i>
                        </div>
                        <div slot="content">
                            <p class="card-category" style=" font-weight: 500; font-size: 30px; font-family: 'Gothic A1', sans-serif;">総登山距離</p>
                            <h2 class="card-title" style=" font-weight: 500; font-family: 'Gothic A1', sans-serif;">{{totalD}}km</h2>
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
                            <h1 class="card-title" style="font-weight: 500; font-family: 'Gothic A1', sans-serif; display: inline-block;">登山した回数</h1>
                            <!--<b-form-select style="display: inline-block; padding-bottom: 0px;-->
                            <!--padding-top: 0px; float:right; width: 100px" v-model="nowYear" :options="options" class="mb-3" size="sm" />-->
                        </template>
                    </chart-card>
                </div>
                <div class="col-md-4">
                    <card>
                        <template slot="header">
                            <h1 class="card-title" style="font-weight: 500; font-family: 'Gothic A1', sans-serif;">ハイキング記録</h1>
                        </template>
                        <div class="table-hover">
                            <table class="table" style="text-align:center;">
                                <thead style="padding-top: 0;">
                                <slot name="columns">
                                    <th><h4 style="font-weight: 500; margin: 0; color: #9e9e9e; font-family: 'Gothic A1', sans-serif;">スケジュール名</h4></th>
                                    <th><h4 style="font-weight: 500; margin: 0; color: #9e9e9e; font-family: 'Gothic A1', sans-serif;">ハイキング一字</h4></th>
                                </slot>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in lastRecord" @click="recordModalOpen(item)">
                                    <slot :row="item">
                                        <td><h3 style="font-weight: 500; font-family: 'Gothic A1', sans-serif;">{{ item.title }}</h3></td>
                                        <td><h3 style="font-weight: 500; font-family: 'Gothic A1', sans-serif;">{{ startDate[index] }}</h3></td>
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
            this.axios.get(this.$HttpAddr + '/hiking_count/' + sessionStorage.getItem('userid'))
                .then((response) => {
                    if(response.data < 5)   {
                        this.rank = '裏山';
                    }
                    else if(response.data > 5 && response.data < 11)   {
                        this.rank = '金剛山';
                    }
                    else if(response.data > 10 && response.data < 16)   {
                        this.rank = '手塩岳';
                    }
                    else if(response.data > 15 && response.data < 21)   {
                        this.rank = '穂高岳';
                    }
                    else if(response.data > 20 && response.data < 26)   {
                        this.rank = '北岳';
                    }
                    else if(response.data > 25)   {
                        this.rank = '富士山';
                    }
                })
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
                        if(response.data != false)  {
                            this.lastRecord = this.lastRecord.concat(response.data);
                            for (let i = 0; i < this.lastRecord.length; i++) {
                                this.startDate[i] = this.lastRecord[i].start_date.substring(0, 4) + "-" + this.lastRecord[i].start_date.substring(5, 7) + "-" + this.lastRecord[i].start_date.substring(8, 10);
                            }
                        }
                    });
            },
            positionPull() {
                this.axios.get('http://hikonnect.ga/user/' + sessionStorage.getItem('userid'))
                    .then(response => {
                        this.totalD = response.data.total_distance;
                        this.total_hiking_t = response.data.total_hiking_time.hour + "H "
                            + response.data.total_hiking_time.minute + "M "
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
            ChartCard,
            StatsCard,
            Card,
            levelModal,
            recordModal
        },
    }
</script>
<style>
    .ct-series-a .ct-point, .ct-series-a .ct-line, .ct-series-a .ct-bar, .ct-series-a .ct-slice-donut {
        stroke: #FF9800;
    }
</style>
