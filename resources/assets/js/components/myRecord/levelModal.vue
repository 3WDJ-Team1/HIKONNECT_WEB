<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="row">
        <div class="col-12">
            <h4><i class="nc-icon nc-bulb-63"></i>&nbsp;&nbsp;등급 설명</h4>
            <div class="table-hover">
                <table class="table" style="text-align:center;">
                    <thead>
                    <th>등급 명칭</th>
                    <th>등급 기준</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="font-size: 12px;">백두산</td>
                        <td style="text-align:left; font-size: 11px;">26회 이상</td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">한라산</td>
                        <td style="text-align:left; font-size: 12px;">21~25회</td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">지리산</td>
                        <td style="text-align:left;">16~20회</td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">태백산</td>
                        <td style="text-align:left; font-size: 12px;">11~15회</td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">소백산</td>
                        <td style="text-align:left; font-size: 12px;">6~10회</td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">동네 뒷산</td>
                        <td style="font-size: 12px; text-align:left;">5회 미만</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h6><i class="nc-icon nc-refresh-02"></i>&nbsp;총<b style="color:#ff5722;">{{ count }}</b>회 등산하셨습니다.</h6>
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