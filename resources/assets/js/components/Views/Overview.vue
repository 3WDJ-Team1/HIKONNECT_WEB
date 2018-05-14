<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <stats-card>
            <div slot="header" class="icon-warning">
              <i class="nc-icon nc-chart text-warning"></i>
            </div>
            <div slot="content">
              <p class="card-category">나의 등급</p>
              <h4 class="card-title">{{rank}}</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-refresh"></i>Updated now
            </div>
          </stats-card>
        </div>

        <div class="col-md-4">
          <stats-card>
            <div slot="header" class="icon-success">
              <i class="nc-icon nc-light-3 text-success"></i>
            </div>
            <div slot="content">
              <p class="card-category">총 등산 시간</p>
              <h4 class="card-title">{{total_hiking_t}}</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-calendar-o"></i>Last day
            </div>
          </stats-card>
        </div>

        <div class="col-md-4">
          <stats-card>
            <div slot="header" class="icon-danger">
              <i class="nc-icon nc-vector text-danger"></i>
            </div>
            <div slot="content">
              <p class="card-category">총 등산 거리</p>
              <h4 class="card-title">{{totalD}}</h4>
            </div>
            <div slot="footer">
              <i class="fa fa-clock-o"></i>Last day
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
              <h4 class="card-title">내가 등산한 횟수</h4>
              <p class="card-category">24 Hours performance</p>
            </template>
          </chart-card>
        </div>

        <div class="col-md-4">
          <card>
            <template slot="header">
              <h4 class="card-title">내가 소속된 그룹</h4>
            </template>
            <div class="table-responsive">
              <l-table class="table-hover"
                       :columns="table1.columns"
                       :data="table1.data">
              </l-table>
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
    import LTable from '../Table.vue'
    const tableColumns = ['그룹 이름', '작성자'];
    const tableData = [{
        '그룹 이름': 1,
        '작성자': '뀨'
    }];
    export default {
        created() {
            this.positionPull();
            this.graphPull();
        },
        methods: {
            positionPull()  {
                this.axios.get('http://172.26.2.88:8000/user/' + sessionStorage.getItem('userid'))
                    .then(response => {
                        this.rank = response.data[0].grade;
                        this.totalD = response.data.total_distance;
                        this.total_hiking_t = response.data.total_hiking_time.hour + "H"
                                              + response.data.total_hiking_time.minute + "M"
                                              + response.data.total_hiking_time.second + "S"
                });
            },
            graphPull()  {
                this.axios.post(this.$HttpAddr + '/graph', {
                    userid: sessionStorage.getItem('userid'),
                    year: '2018'
                }).then(response => {
                    this.lineChart.data.series = this.lineChart.data.series.concat(response.data);
                    });
            }
        },
        components: {
            LTable,
            ChartCard,
            StatsCard,
            Card
        },
        data () {
            return {
                rank: '',
                totalD: '',
                total_hiking_t: '',
                table1: {
                    columns: [...tableColumns],
                    data: [...tableData]
                },
                pieChart: {
                    data: {
                        labels: ['40%', '20%', '40%'],
                        series: [40, 20, 40]
                    }
                },
                lineChart: {
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        series: []
                    },
                    options: {
                        low: 0,
                        high: 80,
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
        }
    }
</script>
<style>

</style>
