<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="row">
        <div class="col-12">
            <h2 style="font-family: 'Do Hyeon', sans-serif;"><i class="nc-icon nc-bulb-63"></i>&nbsp;&nbsp;等級説明</h2>
            <div class="table-hover">
                <table class="table" style="text-align:center;">
                    <thead>
                    <th><h4 style="margin: 0; color: #9e9e9e; font-family: 'Do Hyeon', sans-serif;">等級名称</h4></th>
                    <th><h4 style="margin: 0; color: #9e9e9e; font-family: 'Do Hyeon', sans-serif;">等級基準</h4></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">富士山</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">26会以上</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">北岳</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">21~25회</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">穂高岳</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">16~20会</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">手塩岳</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">11~15会</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">金剛山</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">6~10会</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">裏山</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">5会未満</h3></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 style="font-family: 'Do Hyeon', sans-serif;"><i class="nc-icon nc-refresh-02"></i>&nbsp;これまで<b style="color:#ff5722;">&nbsp;{{ count }}</b>会登山しました。</h3>
            <br>
        </div>
    </div>
</template>

<script>
    import Card from '../Cards/Card'

    export default {
        name: "level-modal",
        components: {
            Card
        },
        created()   {
            this.axios.get(this.$HttpAddr + '/hiking_count/' + sessionStorage.getItem('userid'))
                .then((response) => {
                    this.count = response.data;
                })
        },
        data()  {
            return {
                userID : sessionStorage.getItem('userid'),
                count: ''
            }
        }
    }
</script>

<style scoped>

</style>