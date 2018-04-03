<template>
    <div class="container">
        <table class="table">
            <tbody>
            <tr>
                <td>제목</td>
                <td><input type="text" place class="form-control" id="usr" v-model="title"></td>
            </tr>
            <tr>
                <td>모집 내용</td>
                <td><textarea class="form-control" rows="5" v-model="content" id="comment"></textarea></td>
            </tr>
            <tr>
                <td>등산 경로</td>
                <td>
                    <router-view name="make"></router-view>
                </td>
            </tr>
            <tr>
                <td>등산 일정</td>
                <td><datetime v-model="date" placeholder="산행일자"></datetime></td>
            </tr>
            <tr>
                <td>모집 인원</td>
                <td><input type="text" place class="모집 인원 수" v-model="member_num"></td>
            </tr>
            </tbody>
        </table>
        <button v-on:click="make_group">제출</button>
    </div>

</template>

<script>
    import { EventBus } from './event_bus'
    export default {
        name: "group_make_main",
        created: function ()
        {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            EventBus.$on('mountain_name', function (para) {

            });
        },
        data()  {
            return {
                title: '',
                content: '',
                date: '',
                member_num: ''
            }
        },
        methods: {
            make_group()  {

            }
        }
    }
</script>

<style scoped>

</style>