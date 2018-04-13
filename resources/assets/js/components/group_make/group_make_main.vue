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
                <td>
                    <p>
                        <datetime v-model="date" placeholder="산행일자"></datetime>
                        <vue-timepicker></vue-timepicker>
                        <span> to </span>
                        <vue-timepicker></vue-timepicker>
                    </p>
                </td>
            </tr>
            <tr>
                <td>모집 인원</td>
                <td><input type="text" place class="모집 인원 수" v-model="member_num"></td>
            </tr>
            </tbody>
        </table>
        <button v-on:click="send_data">제출</button>
    </div>

</template>

<script>
    import VueTimepicker from 'vue2-timepicker'
    export default {
        components: {
            VueTimepicker
        },
        name: "group_make_main",
        data()  {
            return {
                title: '',
                content: '',
                date: '',
                member_num: '',
                mountain_path: [],
                mountain_num: ''
            }
        },
        created: function ()
        {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            this.$EventBus.$on('mountain_path', function (path, num) {
                this.mountain_path = path;
                this.mountain_num = num;
            });
        },
        methods:    {
            send_data() {
                console.log(this.title);
                console.log(this.content);
                console.log(this.date);
                console.log(this.member_num);
                console.log(this.mountain_path);
                console.log(this.mountain_num);
            }
        }
    }
</script>

<style scoped>

</style>