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
                        <td>백두산</td>
                        <td style="text-align:left;">총 등산 횟수 26회 이상</td>
                    </tr>
                    <tr>
                        <td>한라산</td>
                        <td style="text-align:left;">총 등산 횟수 21~25회</td>
                    </tr>
                    <tr>
                        <td>지리산</td>
                        <td style="text-align:left;">총 등산횟수 16~20회</td>
                    </tr>
                    <tr>
                        <td>태백산</td>
                        <td style="text-align:left;">총 등산횟수 11~15회</td>
                    </tr>
                    <tr>
                        <td>소백산</td>
                        <td style="text-align:left;">총 등산횟수 6~10회</td>
                    </tr>
                    <tr>
                        <td>동네 뒷산</td>
                        <td style="text-align:left;">총 등산횟수 5회 미만</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <h5><i class="nc-icon nc-refresh-02"></i>&nbsp;&nbsp;{{userID}}님은 <b style="color:#ff5722;">{{ count }}</b>회 등산하셨습니다.</h5>
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