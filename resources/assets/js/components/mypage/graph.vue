<template>
    <div class='chart'>
        <h1>월별 등산기록</h1>
        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <chart-axis :data='chartData'></chart-axis>
        <history></history>
        <router-link  :to="{ name: 'mypage' }" class = "btn btn-primary"> 뒤로</router-link>
    </div>
</template>
<script>
    import history from './history.vue';
    import { svgArea, svgLine, svgScatter } from 'd2b'
    import { ChartAxis } from 'vue-d2b'

    export default {
        methods:  {
      /*  graph() {
            let uri = 'http://localhost:8000/mypage/' + sessionStorage.getItem('uuid');
            this.axios.get(uri).then((response) => {
                var datavalue = Object.values(response.data);
                console.log(response.data);
                $('#userid').val(datavalue[0]);
            })
        }*/

        },
        data () {
            return {

                chartData: {
                    sets: [
                        {
                            generators: [svgArea(), svgLine(), svgScatter()],
                            graphs: [
                                {
                                    values: [
                                        {x: 1, y: a[0]},
                                        {x: 2, y: a[1]},
                                        {x: 3, y: a[2]},
                                        {x: 4, y: a[3]},
                                        {x: 5, y: a[4]},
                                        {x: 6, y: a[5]},
                                        {x: 7, y: a[6]},
                                        {x: 8, y: a[7]},
                                        {x: 9, y: a[8]},
                                        {x: 10, y: a[9]},
                                        {x: 11, y: a[10]},
                                        {x: 12, y: a[11]}

                                    ]
                                }
                            ]
                        }
                    ]
                }
            }
        },

        components: {
                ChartAxis,
                'history' : history
        }
    }
</script>
<style scoped>
    .chart{
        width: 100%;
        height: 500px;
    }
</style>