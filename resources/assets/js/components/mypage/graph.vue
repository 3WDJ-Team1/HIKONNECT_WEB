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

        data () {
            return {
                chartData: {
                    sets: [
                        {
                            generators: [svgArea(), svgLine(), svgScatter()],
                            graphs: [
                                {
                                    values: [
                                        {x: 1, y: 25},
                                        {x: 2, y: 38},
                                        {x: 3, y: 24},
                                        {x: 4, y: 60},
                                        {x: 5, y: 22},
                                        {x: 6, y: 25},
                                        {x: 7, y: 38},
                                        {x: 8, y: 24},
                                        {x: 9, y: 60},
                                        {x: 10, y: 22},
                                        {x: 11, y: 25},
                                        {x: 12, y: 38}

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