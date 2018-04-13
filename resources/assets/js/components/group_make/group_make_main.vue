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
                        <vue-timepicker :format="yourFormat" v-model="yourData"></vue-timepicker>
                        <!--<span> to </span>-->
                        <!--<vue-timepicker format="HH:mm:ss"></vue-timepicker>-->
                    </p>
                </td>
            </tr>
            <tr>
                <td>최소 모집 인원</td>
                <td><input type="text" place v-model="max_num"></td>
            </tr>
            <tr>
                <td>최대 모집 인원</td>
                <td><input type="text" place v-model="min_num"></td>
            </tr>
            </tbody>
        </table>
        <button v-on:click="sendData">제출</button>
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
                yourFormat: 'hh:mm:ss',
                title: '',
                content: '',
                date: '',
                max_num: '',
                mountain_path: [],
                mountain_num: '',
                min_num: '',
                yourData: {
                    hh: '',
                    mm: '',
                    ss: ''
                }

            }
        },
        created: function ()
        {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            EventBus.$on('mountain_path', (path, num) => {
                this.mountain_path = path;
                this.mountain_num = num;
            });
        },
        methods:    {
            sendData() {
                console.log(this.mountain_path);
                axios.post('http://localhost:8000/group/',{
                    owner: 'f6487325-828b-3b10-9479-71847c1e06ef'
                    /*
                        @todo localStorage.getItem('userUuid')
                    */,
                    tt: this.title,
                    ct: this.content,
                    min: parseInt(this.min_num),
                    max: parseInt(this.max_num),
                    stDate: this.date.substring(0, 4)+"-"+this.date.substring(5, 7)+"-"+this.date.substring(8, 10)+
                        " "+this.yourData['hh']+":"+this.yourData['mm']+":"+this.yourData['ss'],
                    mountain_num: this.mountain_num,
                    mountain_path: this.mountain_path
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
