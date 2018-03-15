<template>
    <div class='chart'>
        <h1>월별 등산기록</h1>
        <select v-model="item.year">
            <option>2018</option>
        </select>
        <button class="btn btn-primary" @click="graph"> 확인</button>
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
        graph() {
            let uri = 'http://localhost:8000/graph/' + sessionStorage.getItem('uuid');
            this.axios.post(uri,this.item).then((response) => {
                var datavalue = Object.values(response.data);
                console.log(response.data);
                this.yvalue = datavalue[0];
                alert(this.yvalue);
            })
        }

        },
        data () {
            return {
                item : {

                },
                yvalue : 0,
                chartData: {
                    sets: [
                        {
                            generators: [svgArea(), svgLine(), svgScatter()],
                            graphs: [
                                {
                                    values: [
                                        {x: 1, y: 0},
                                        {x: 2, y: 1},
                                        {x: 3, y: 2},
                                        {x: 4, y: 0},
                                        {x: 5, y: 0},
                                        {x: 6, y: 1},
                                        {x: 7, y: 4},
                                        {x: 8, y: 7},
                                        {x: 9, y: 4},
                                        {x: 10, y: 5},
                                        {x: 11, y: 2},
                                        {x: 12, y: 1}

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