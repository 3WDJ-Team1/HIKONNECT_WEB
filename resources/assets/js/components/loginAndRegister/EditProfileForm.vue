<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <card>
        <h1 slot="header" style="font-family: 'Do Hyeon', sans-serif;" class="card-title">新規取得</h1>
        <form>
            <div class="row">
                <div class="col-md-12">
                    <fg-input type="text"
                              :disabled="disabledID"
                              placeholder="ID"
                              v-model="inputId">
                    </fg-input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <fg-input type="text"
                              :disabled="disabledTag"
                              placeholder="ニックネーム"
                              v-model="inputNickname">
                    </fg-input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <fg-input type="password"
                              :disabled="disabledTag"
                              placeholder="パスワード"
                              v-model="inputPw">
                    </fg-input>
                </div>
                <b-tooltip
                        target="inputPwCk"
                        v-if="isTooltipShown"
                        triggers="focus hover">
                    Check your password!
                </b-tooltip>
                <div class="col-md-6">
                    <fg-input type="password"
                              :disabled="disabledTag"
                              placeholder="パスワード確認"
                              v-model="inputPwCk">
                    </fg-input>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <fg-input type="text"
                              :disabled="disabledTag"
                              placeholder="電話番号"
                              v-model="inputPhoneNo">
                    </fg-input>
                </div>
                <div class="col-md-6" id="phoneCheckPadding">
                    <b-form-checkbox
                            id="checkBoxP"
                            :disabled="disabledTag"
                            v-model="isPhoneNoShown"
                            value="true"
                            unchecked-value="false">
                        <h5 style="font-family: 'Do Hyeon', sans-serif;">{{ phoneM }}</h5>
                    </b-form-checkbox>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <b-form-select v-model="selectedGender" :disabled="disabledTag" class="mb-3">
                        <template slot="first">
                            <!-- this slot appears above the options from 'options' prop -->
                            <option :value="null" disabled>-- 性別 --</option>
                        </template>
                        <!-- these options will appear after the ones from 'options' prop -->
                        <option value="남자">男性</option>
                        <option value="여자">女性</option>
                    </b-form-select>
                </div>
                <div class="col-md-9">
                    <b-form-checkbox
                            :disabled="disabledTag"
                            v-model="isGenderShown"
                            value="true"
                            unchecked-value="false">
                        <h5 style="font-family: 'Do Hyeon', sans-serif;">{{ genderM }}</h5>
                    </b-form-checkbox>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <b-form-select :disabled="disabledTag" v-model="selectedAgeGroup" class="mb-3">
                        <template slot="first">
                            <!-- this slot appears above the options from 'options' prop -->
                            <option :value="null" disabled>-- 年齢 --</option>
                        </template>
                        <!-- these options will appear after the ones from 'options' prop -->
                        <option value="10대">10代</option>
                        <option value="20대">20代</option>
                        <option value="30대">30代</option>
                        <option value="40대">40代</option>
                        <option value="50대">50代</option>
                        <option value="60대 이상">60代以上</option>
                    </b-form-select>
                </div>
                <div class="col-md-9">
                    <b-form-checkbox
                            :disabled="disabledTag"
                            v-model="isAgeGroupShown"
                            value="true"
                            unchecked-value="false">
                        <h5 style="font-family: 'Do Hyeon', sans-serif;">{{ ageM }}</h5>
                    </b-form-checkbox>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <b-form-select :disabled="disabledTag" v-model="openRange" class="mb-3">
                        <template slot="first">
                            <!-- this slot appears above the options from 'options' prop -->
                            <option :value="null" disabled>-- 公開範囲 --</option>
                        </template>
                        <!-- these options will appear after the ones from 'options' prop -->
                        <option value="all">ALL</option>
                        <option value="group">GROUP</option>
                    </b-form-select>
                </div>
            </div>
            <div class="text-center">
                <button style="padding: 0;" type="submit" v-if="submitButton" class="btn btn-info btn-fill float-right"
                        @click="regist">
                    <span style="font-family: 'Do Hyeon', sans-serif; font-size: 30px; padding: 10px;">登録</span>
                </button>
                <button type="submit" v-if="!submitButton" class="btn btn-outline-warning btn-fill float-right"
                        @click="update">
                    UPDATE
                </button>
            </div>
        </form>
    </card>
</template>
<script>
    import Card from '../Cards/Card.vue'
    export default {
        components: {
            Card,
        },
        data: () => ({
            /**
             * valid            (Boolean)       Is the form valid
             * <-- user's input
             * inputId          (String)        User's input id
             * inputPw          (String)        User's input password
             * inputPwCk        (String)        User's input password check
             * inputNickname    (String)        User's input nickname
             * inputPhoneNo     (String)        User's input phone number
             * isPhoneNoShown   (Boolean)       Is user's input phone number opened
             * selectedGender   (String)        Selected value of user's gender
             * isGenderShown    (Boolean)       Is user's gender opened
             * selectedAgeGroup (String)        Selected value of user's age group
             * isAgeGroupShown  (Boolean)       Is user's age group opened
             * openRange        (String)        Is opened information in groups or all
             * -->
             * rules            (Object)        The rules of text-fields.
             *                                  The rules have to be 'Array of function'
             *      - isBlanked     (function)  The rule for checking that the text-field is blanked
             * options          (Object)        The options for select tag
             *      - genderOpt     (Array)     The options for selecting gender
             *      - ageGroupOpt   (Array)     The options for selecting age group
             *      - openOpt       (Array)     The options for selecting open range
             * isTooltipShown   (Boolean)       Is tooltip to show user alert now floating
             */
            disabledTag: false,
            disabledID: false,
            eventB: this.$EventBus,
            submitButton: true,
            inputId: "",
            inputPw: "",
            inputPwCk: "",
            inputNickname: "",
            inputPhoneNo: "",
            isPhoneNoShown: false,
            phoneM: '非公開',
            selectedGender: null,
            isGenderShown: false,
            genderM: '非公開',
            selectedAgeGroup: null,
            isAgeGroupShown: false,
            ageM: '非公開',
            openRange: null,
            isTooltipShown: false,
            file: ''
        }),
        methods: {
            update(e)    {
                e.preventDefault();
                // form undisabled해 놓은거 풀기
                this.disabledTag = false;
                // ID는 수정 할 수 없으므로
                this.disabledID = true;
                // 제출버튼 활성화 시키기
                this.submitButton = true;
                // 이미지 컴포넌트에 업로드 input 활서화 시키기
                this.$EventBus.$emit('upadateSign')
            },
            /**
             * @function    submitFile
             * @brief       send to database a profile image.
             */
            submitFile() {
                let formData = new FormData();
                formData.append('userfile', this.file, this.inputId + '.jpg');
                axios.post('http://hikonnect.ga:3000/image/profile', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(() => {
                    this.$EventBus.$emit('complitedModalOpen', 'true');
                    }).catch(function (err) {
                        console.log(err);
                        console.log('FAILURE!!');
                    });
            },
            /**
             * @function    regist
             * @brief       Try to regist user.
             *              Check is form valid. Then send request to server.
             */
            regist(e) {
                e.preventDefault();
                if (this.isTooltipShown) {
                    this.$EventBus.$emit('errorModalOpen', 'Check your password!');
                    return;
                }
                // 회원가입
                if(sessionStorage.getItem('userid') == undefined)   {
                    this.axios.post(this.$HttpAddr + '/user', {
                        idv: this.inputId,
                        nn: this.inputNickname,
                        pwv: this.inputPw,
                        phone: this.inputPhoneNo,
                        gender: this.selectedGender,
                        age: this.selectedAgeGroup,
                        phonesc: this.isPhoneNoShown,
                        gendersc: this.isGenderShown,
                        agesc: this.isAgeGroupShown,
                        groupsc: this.openRange
                    }).then(response => {
                        if (response.data == 'true') {
                            this.$EventBus.$emit('complitedModalOpen', 'true');
                        }
                        else {
                            console.log(response.data);
                        }
                    })
                }
                // 수정하기
                else {
                    this.axios.put(this.$HttpAddr + '/user/' + sessionStorage.getItem('userid'), {
                        idv: this.inputId,
                        nn: this.inputNickname,
                        pwv: this.inputPw,
                        phone: this.inputPhoneNo,
                        gender: this.selectedGender,
                        age: this.selectedAgeGroup,
                        phonesc: this.isPhoneNoShown,
                        gendersc: this.isGenderShown,
                        agesc: this.isAgeGroupShown,
                        groupsc: this.openRange
                    }).then(response => {
                        if (response.data == 'true') {
                            sessionStorage.setItem('userid',this.inputId);
                            sessionStorage.setItem('phone',this.inputPhoneNo);
                            sessionStorage.setItem('password',this.inputPw);
                            sessionStorage.setItem('nickname',this.inputNickname);
                            sessionStorage.setItem('phonesc',this.isPhoneNoShown);
                            sessionStorage.setItem('gendersc',this.isGenderShown);
                            sessionStorage.setItem('agesc',this.isAgeGroupShown);
                            sessionStorage.setItem('scv',this.openRange);
                            sessionStorage.setItem('gender',this.selectedGender);
                            sessionStorage.setItem('age',this.selectedAgeGroup);
                            if(this.file == "") {
                                this.$EventBus.$emit('complitedModalOpen', 'true');
                            } else {
                                this.submitFile();
                            }
                        }
                        else {
                            console.log(response.data);
                        }
                    })
                }
            },
        },
        watch: {
            /**
             * @watch       inputPwCk
             * @brief       It checks the value of inputPwCk, then change status of isTooltipShown.
             */
            inputId() {
                this.$EventBus.$emit('sendInputID', this.inputId)
            },
            isPhoneNoShown() {
                if (this.isPhoneNoShown == 'true') {
                    this.phoneM = "公開"
                } else
                    this.phoneM = "非公開"
            },
            isGenderShown() {
                if (this.isGenderShown == 'true') {
                    this.genderM = "公開"
                } else
                    this.genderM = "非公開"
            },
            isAgeGroupShown() {
                if (this.isAgeGroupShown == 'true') {
                    this.ageM = "公開"
                } else
                    this.ageM = "非公開"
            },
            inputPwCk(newValue) {
                if (newValue == this.inputPw) {
                    this.isTooltipShown = false;
                }
                if (newValue != this.inputPw) {
                    this.isTooltipShown = true;
                }
            },
            /**
             * @watch       inputPw
             * @brief       It checks the value of inputPw, then change status of isTooltipShown.
             */
            inputPw(newValue) {
                if (newValue == this.inputPwCk) {
                    this.isTooltipShown = false;
                }
                if (newValue != this.inputPwCk) {
                    this.isTooltipShown = true;
                }
            }
        },
        // 로그인 되어 있을 시 세션값의 정보를 빼 input에 저장
        created() {
            this.$EventBus.$on('sendImageFile', (file) => {
                this.file = file;
            });
            if (sessionStorage.getItem('userid') != undefined) {
                this.disabledTag = true;
                this.disabledID = true;
                this.submitButton = false;
                this.inputId = sessionStorage.getItem('userid');
                this.inputPw = sessionStorage.getItem('password');
                this.inputPwCk = sessionStorage.getItem('password');
                this.inputNickname = sessionStorage.getItem('nickname');
                this.inputPhoneNo = sessionStorage.getItem('phone');
                this.isPhoneNoShown = sessionStorage.getItem('phonesc');
                this.selectedGender = sessionStorage.getItem('gender');
                this.isGenderShown = sessionStorage.getItem('gendersc');
                this.selectedAgeGroup = sessionStorage.getItem('age');
                this.isAgeGroupShown = sessionStorage.getItem('agesc');
                this.openRange = sessionStorage.getItem('scv');
                this.isTooltipShown = sessionStorage.getItem('phonesc');
                if (this.isPhoneNoShown == 'true') {
                    this.phoneM = "公開"
                } else {
                    this.phoneM = '非公開';
                }
                if (this.isPhoneNoShown == 'true') {
                    this.phoneM = "公開"
                } else
                    this.phoneM = "非公開"
                if (this.isAgeGroupShown == 'true') {
                    this.ageM = "公開"
                } else
                    this.ageM = "非公開"
            }
        }
    }

</script>
<style>
    #phoneCheckPadding {
        padding-top: 35px;
    }

    .custom-control-inline {
        margin-top: 7px;
    }
</style>
