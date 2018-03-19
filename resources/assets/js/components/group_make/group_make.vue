<template>
    <div class="container">
        <table class="table">
            <tbody>
            <tr>
                <td>제목</td>
                <td><input type="text" place class="form-control" id="usr"></td>
            </tr>
            <tr>
                <td>모집 내용</td>
                <td><textarea class="form-control" rows="5" id="comment"></textarea></td>
            </tr>
            <tr>
                <td>등산 경로</td>
                <td>Dooley</td>
            </tr>
            <tr>
                <td>등산 일정</td>
                <td>Dooley</td>
            </tr>
            <tr>
                <td>모집 인원</td>
                <td>Dooley</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>
    th  {
        width: 80px;
        text-align: center;
    }
    td  {
        width: 450px;
    }
    .content    {
        display: table;
        margin-left: auto;
        margin-right: auto;
    }
</style>