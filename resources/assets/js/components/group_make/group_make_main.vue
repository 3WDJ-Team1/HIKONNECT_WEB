<template>
    <div class="container">
        <table class="table">
            <tbody>
            <tr>
                <td colspan='1'>제목</td>
                <td colspan='3'>
                    <input
                            type="text"
                            place
                            class="form-control"
                            id="usr"
                            v-model="title">
                </td>
            </tr>
            <tr>
                <td colspan='1'>모집 내용</td>
                <td colspan='3'>
                    <textarea
                            class="form-control"
                            rows="5"
                            v-model="content"
                            id="comment"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan='1'>등산 경로</td>
                <td colspan='3'>
                    <router-view name="make"></router-view>
                </td>
            </tr>
            <tr>
                <td colspan='1'>등산 일정</td>
                <td colspan='1.5'>
                    <datetime
                            v-model="date"
                            placeholder="산행일자">
                    </datetime>
                </td>
                <td colspan='1.5'>
                    <vue-timepicker
                            :format="yourFormat"
                            v-model="yourData">
                    </vue-timepicker>
                    <!--<span> to </span>-->
                    <!--<vue-timepicker format="HH:mm:ss"></vue-timepicker>-->
                </td>
            </tr>
            <tr>
                <td colspan='1'>최소 모집 인원</td>
                <td colspan='1'>
                    <input
                            style="width: 100px;"
                            type="text"
                            place
                            class="form-control"
                            v-model="max_num">
                </td>
                <td colspan='1'>최대 모집 인원</td>
                <td colspan='1'>
                    <input
                            style="width: 100px;"
                            type="text"
                            place
                            class="form-control"
                            v-model="min_num">
                </td>
            </tr>
            </tbody>
        </table>
        <button @click="sendData">제출</button>
    </div>

</template>
<script>
    import VueTimepicker from 'vue2-timepicker'
    import {EventBus} from './event-bus.js'

    export default {
        components: {
            VueTimepicker
        },
        name: "group_make_main",
        data() {
            return {
                yourFormat: 'HH:mm:ss',
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
                },
                httpAddr: Laravel.host
            }
        },
        created() {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            this.$EventBus.$on('mountain_path', (path, num) => {
                this.mountain_path = path;
                this.mountain_num = num;
            });
        },
        methods: {
            sendData() {
                console.log(this.mountain_path);

                axios.post(Laravel.host + '/group/store', {
                    owner: sessionStorage.getItem('uuid')
                    /*
                        @todo localStorage.getItem('userUuid')
                    */,
                    tt: this.title,
                    ct: this.content,
                    min: parseInt(this.min_num),
                    max: parseInt(this.max_num),
                    stDate: this.date.substring(0, 4) + "-" + this.date.substring(5, 7) + "-" + this.date.substring(8, 10) +
                    " " + this.yourData['hh'] + ":" + this.yourData['mm'] + ":" + this.yourData['ss'],
                    mountP: JSON.stringify(this.mountain_path)
                })
                    .then(response => {
                        if (response.data == true) {
                            alert('성공적으로 저장 되었습니다.');
                            this.$router.push('/list');
                        } else {
                            alert('저장을 실패하였습니다.');
                        }
                    })
            }
        }
    }
</script>