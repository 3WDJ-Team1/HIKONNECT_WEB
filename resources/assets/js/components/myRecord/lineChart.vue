<template>
    <div id='cc' class='chart'>
        <select v-model="item.year" @change="graph" id="year">
            <option>2018</option>
            <option>2017</option>
            <option>2016</option>
            <option>2015</option>
        </select>
        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <chart-axis :data='chartData' id="a"></chart-axis>
    </div>
</template>
<script>
    import { svgArea, svgLine, svgScatter } from 'd2b'
    import { ChartAxis } from 'vue-d2b'
    export default {
        created()   {
            this.graph();
        },
        data() {
            return {
                item: {
                    year : sessionStorage.getItem('year')
                },
                chartData: {
                    sets: [
                        {
                            generators: [svgArea(), svgLine(), svgScatter()],
                            graphs: [
                                {
                                    values: [
                                        {x: 1, y: sessionStorage.getItem('1')*10/10},
                                        {x: 2, y: sessionStorage.getItem('2')*10/10},
                                        {x: 3, y: sessionStorage.getItem('3')*10/10},
                                        {x: 4, y: sessionStorage.getItem('4')*10/10},
                                        {x: 5, y: sessionStorage.getItem('5')*10/10},
                                        {x: 6, y: sessionStorage.getItem('6')*10/10},
                                        {x: 7, y: sessionStorage.getItem('7')*10/10},
                                        {x: 8, y: sessionStorage.getItem('8')*10/10},
                                        {x: 9, y: sessionStorage.getItem('9')*10/10},
                                        {x: 10, y: sessionStorage.getItem('10')*10/10},
                                        {x: 11, y: sessionStorage.getItem('11')*10/10},
                                        {x: 12, y: sessionStorage.getItem('12')*10/10}
                                    ]
                                }
                            ]
                        }
                    ]
                }
            }
        },
        components: {
            ChartAxis
        },
        methods:  {
            graph() {
                this.axios.post(this.$HttpAddr + '/graph', {
                    userid: sessionStorage.getItem('userid'),
                    year: '2018'
                }).then(response => {
                    this.chartData.series.push(response.data);
                });
                // let uri = 'http://localhost:8000/graph/' + sessionStorage.getItem('uuid');
                // this.axios.post(uri,this.item).then((response) => {
                //     var datavalue = Object.values(response.data);
                //     console.log(response.data);
                //     sessionStorage.setItem('year',$('#year').val());
                //     sessionStorage.setItem('1',datavalue[0]);
                //     sessionStorage.setItem('2',datavalue[1]);
                //     sessionStorage.setItem('3',datavalue[2]);
                //     sessionStorage.setItem('4',datavalue[3]);
                //     sessionStorage.setItem('5',datavalue[4]);
                //     sessionStorage.setItem('6',datavalue[5]);
                //     sessionStorage.setItem('7',datavalue[6]);
                //     sessionStorage.setItem('8',datavalue[7]);
                //     sessionStorage.setItem('9',datavalue[8]);
                //     sessionStorage.setItem('10',datavalue[9]);
                //     sessionStorage.setItem('11',datavalue[10]);
                //     sessionStorage.setItem('12',datavalue[11]);
                //     this.$router.push({name : 'update'})
                // });
            }
        }
    }
</script>
<style scoped>
    .chart{
        width: 100%;
        height: 500px;
    }
</style>