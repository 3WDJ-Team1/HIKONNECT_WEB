<template>
    <div class="container" style="margin-left: 130px" >

        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 80px">
                <div class="panel-heading">정보 수정</div>
                <span> <img :src="item.imageSrc" class="image" style="width: 400px; height: 400px">
                    <input  @change="uploadImage" type="file" name="photo" accept="image/*"></span>
                <span class="panel-body">
                        <input type="text"     style="margin-top: 10px" v-model="item.idv" class="form-control" placeholder="Enter id" id="id"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwv" class="form-control" placeholder="Enter password" id="pw"/>
                        <input type="password" style="margin-top: 10px" v-model="item.pwvc" class="form-control" placeholder="Enter password again" id="pwvc"/>
                        <input type="text" style="margin-top: 10px" v-model="item.nn" class="form-control" placeholder="Enter nickname" id="nn"/>
                        <input type="text" style="margin-top: 10px" v-model="item.phone" class="form-control" placeholder="Enter phone" id="phone"/>
                        <label>번호 공개 여부</label><input type="checkbox" style="margin-top: 10px" v-model="item.phonesc"  id="phonesc"/><br>
                        <label>성별 선택</label>
                        <select id="gender" v-model="item.gender">
                            <option> 남자 </option>
                            <option> 여자 </option>
                        </select>
                        <label>성별 공개 여부</label><input type="checkbox" style="margin-top: 10px" v-model="item.gendersc"  id="gendersc"/><br>
                        <label>연령대 선택</label>
                        <select id="age" v-model="item.age">
                            <option> 10대 </option>
                            <option> 20대 </option>
                            <option> 30대 </option>
                            <option> 40대 </option>
                            <option> 50대 </option>
                            <option> 60대 이상 </option>
                        </select>
                        <label>연령 공개 여부</label><input type="checkbox" style="margin-top: 10px" v-model="item.agesc"   id="agesc"/><br>
                        <label>전체 공개</label><input type="radio" value="all" name="sc" style="margin-top: 10px" v-model="item.scv" />
                        <label>그룹 공개</label><input type="radio" value="group" name="sc" style="margin-top: 10px" v-model="item.scv" />
                        <br>
                        <input type='button'  class="btn btn-primary" @click="update" value="확인">
                        <router-link style='margin-left: 270px' :to="{ name: 'mypage' }" v-model="item.pwv" class = "btn btn-primary"> 취소</router-link>
                    </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted: function () {
            let uri = 'http://localhost:8000/api/user/' + sessionStorage.getItem('uuid');
            this.axios.get(uri, this.item).then((response) => {
                this.item.imageSrc =  response.data;
            })
        },
        data(){
            var a = 0;
            var b = 0;
            var c = 0;
            if (sessionStorage.getItem('phonesc') == 'true') {
                a = true;
            }
            else
                a = false;
            if (sessionStorage.getItem('gendersc') == 'true') {
                b = true;
            }
            else
                b = false;
            if (sessionStorage.getItem('agesc') == 'true') {
                c = true;
            }
            else
                c = false;
            return {
                item: {
                    imageSrc: sessionStorage.getItem('image_path'),
                    idv: sessionStorage.getItem('userid'),
                    gender: sessionStorage.getItem('gender'),
                    age: sessionStorage.getItem('age'),
                    nn: sessionStorage.getItem('nickname'),
                    phone: sessionStorage.getItem('phone'),
                    pwv: sessionStorage.getItem('password'),
                    pwvc: sessionStorage.getItem('password'),
                    scv: sessionStorage.getItem('scv'),
                    path: sessionStorage.getItem('image_path'),
                    phonesc: a,
                    gendersc: b,
                    agesc: c,
                }
            }
        },
        methods: {
            uploadImage: function (e) {
                var files = e.target.files;
                if (!files[0]) {
                    return;
                }
                var data = new FormData();
                data.append('media', files[0]);
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.item.imageSrc = e.target.result;
                };
                reader.readAsDataURL(files[0]);
            },
            update: function() {
                let uri = 'http://localhost:8000/api/user/' + sessionStorage.getItem('uuid');
                if(this.item.idv == "" || this.item.pwv == ""
                    || this.item.pwvc == "" || this.item.nn == "") {
                    alert('값이 비어있습니다');
                }
                else if(this.item.pwv != this.item.pwvc) {
                    alert('비밀 번호와 비밀번호 확인이 다릅니다')
                }
                else {
                    this.axios.put(uri, this.item).then((response) => {
                        console.log(response.data);
                        if (response.data == 'true') {
                            alert('수정 완료');
                            this.$router.push({name: 'main'});
                        }
                        else if (response.data == 'false')
                            alert('이미 존재하는 아이디 입니다.');
                        this.$router.push({name: 'main'});
                    })
                }
            }
        }
    }
</script>
