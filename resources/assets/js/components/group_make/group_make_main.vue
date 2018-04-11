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
                <td>최대 모집 인원</td>
                <td><input type="text" place v-model="max_num"></td>
            </tr>
            <tr>
                <td>최소 모집 인원</td>
                <td><input type="text" place v-model="min_num"></td>
            </tr>
            </tbody>
        </table>
        <button v-on:click="send_data">제출</button>
    </div>

</template>

<script>
    import VueTimepicker from 'vue2-timepicker'
    import { EventBus } from './event_bus'
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
                max_num: '',
                // mountain_path: [],
                mountain_num: '281100601',
                min_num: ''

            }
        },
        created: function ()
        {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            EventBus.$on('mountain_path', function (path, num) {
                this.mountain_path = path;
                this.mountain_num = num;
            });
        },
        methods:    {
            send_data() {
                console.log(this.title);
                console.log(this.content);
                console.log(this.date);
                console.log(this.date.substring(0, 4));
                console.log(this.date.substring(5, 7));
                console.log(this.date.substring(8, 10));
                console.log(this.mountain_num);
                console.log(this.min_num);
                console.log(this.max_num);
            },
            infiniteHandler() {
                axios.post('http://localhost:8000/group/0/10',{
                    tt: this.title,
                    ct: this.content,
                    min: parseInt(this.min_num),
                    max: parseInt(this.max_num),
                    stDate: this.date.substring(0, 4)+"-"+this.date.substring(5, 7)+"-"+this.date.substring(8, 10)+" "
                })
                .then(response => {
                    if(response.data == true)    {
                        alert('성공적으로 저장 되었습니다.');
                    } else {
                        alert('저장을 실패하였습니다.');
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>