<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="row">
        <div class="col-12">
            <h2 style="font-family: 'Do Hyeon', sans-serif;"><i class="nc-icon nc-bulb-63"></i>&nbsp;&nbsp;등급 설명</h2>
            <div class="table-hover">
                <table class="table" style="text-align:center;">
                    <thead>
                    <th><h4 style="margin: 0; color: #9e9e9e; font-family: 'Do Hyeon', sans-serif;">등급 명칭</h4></th>
                    <th><h4 style="margin: 0; color: #9e9e9e; font-family: 'Do Hyeon', sans-serif;">등급 기준</h4></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">백두산</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">26회 이상</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">한라산</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">21~25회</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">지리산</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">16~20회</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">태백산</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">11~15회</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">소백산</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">6~10회</h3></td>
                    </tr>
                    <tr>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">동네 뒷산</h3></td>
                        <td><h3 style="font-family: 'Do Hyeon', sans-serif;">5회 미만</h3></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 style="font-family: 'Do Hyeon', sans-serif;"><i class="nc-icon nc-refresh-02"></i>&nbsp;총<b style="color:#ff5722;">&nbsp;{{ count }}</b>회 등산하셨습니다.</h3>
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