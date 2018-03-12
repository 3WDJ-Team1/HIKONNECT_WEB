<template>
    <div class="container">
        <table class="table">
            <tbody>
            <tr>
                <th>제목</th>
                <td>Doe</td>
            </tr>
            <tr>
                <th>모집 내용</th>
                <td>Moe</td>
            </tr>
            <tr>
                <th>등산 경로</th>
                <td>Dooley</td>
            </tr>
            <tr>
                <th>등산 일정</th>
                <td>Dooley</td>
            </tr>
            <tr>
                <th>모집 인원</th>
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