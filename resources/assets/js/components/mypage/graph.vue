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
        mounted: function () {
            let uri = 'http://localhost:8000/graph/' + sessionStorage.getItem('uuid');
            this.axios.post(uri, this.item).then((response) => {
                console.log(response.data);
            })
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
                                        {x: 1, y: 3},
                                        {x: 2, y: 1},
                                        {x: 3, y: 0},
                                        {x: 4, y: 2},
                                        {x: 5, y: 1},
                                        {x: 6, y: 0},
                                        {x: 7, y: 0},
                                        {x: 8, y: 3},
                                        {x: 9, y: 2},
                                        {x: 10, y: 1},
                                        {x: 11, y: 1},
                                        {x: 12, y: 0}

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