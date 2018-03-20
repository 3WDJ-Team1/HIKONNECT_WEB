<template>
    <v-container
        align-center
        align-content-center
        justify-center>
        <h1 style="font-weight: bold; text-align:center;">
            SIGN UP
        </h1>
        <v-form
            v-model ="valid"
            ref     ="form"
            lazy-validation>
            <v-text-field
                label       ="Enter ID"
                v-model     ="inputId"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="person">                
            </v-text-field>
            <v-text-field
                label       ="Enter password"
                v-model     ="inputPw"
                type        ="password"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="lock_outline">
            </v-text-field>
            <v-text-field
                id          ="inputPwCk"
                label       ="Enter password again"
                v-model     ="inputPwCk"
                type        ="password"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="lock">
            </v-text-field>
            <b-tooltip
                target="inputPwCk"
                v-if="isTooltipShown"
                triggers="focus hover">
                Check your password!
            </b-tooltip>
            <v-text-field
                label       ="Enter nickname"
                v-model     ="inputNickname"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="mood">
            </v-text-field>
            <v-text-field
                label       ="Enter phone number"
                v-model     ="inputPhoneNo"
                prepend-icon="phone"
                single-line>
            </v-text-field>
            <v-switch
                :label          ="isPhoneNoShown ? 'show number public' : 'private'"
                v-model         ="isPhoneNoShown"
                :prepend-icon   ="isPhoneNoShown ? 'lock_open' : 'lock_outline'"
                hide-details>
            </v-switch>
            <v-select
                :items      ="options.genderOpt"
                v-model     ="selectedGender"
                label       ="GENDER"
                single-line
                auto
                prepend-icon="wc">
            </v-select>
            <v-switch
                :label      ="isGenderShown ? 'show number public' : 'private'"
                v-model     ="isGenderShown"
                :prepend-icon="isGenderShown ? 'lock_open' : 'lock_outline'"
                hide-details>
            </v-switch>
            <v-select
                :items      ="options.ageGroupOpt"
                v-model     ="selectedAgeGroup"
                label       ="AGE"
                single-line
                auto
                prepend-icon="face">
            </v-select>
            <v-switch
                :label          ="isAgeGroupShown ? 'open' : 'private'"
                v-model         ="isAgeGroupShown"
                hide-details
                :prepend-icon   ="isAgeGroupShown ? 'lock_open' : 'lock_outline'">
            </v-switch>
            <v-select
                :items      ="options.ageOpenOpt"
                v-model     ="ageOpenRange"
                label       ="RANGE"
                single-line
                auto
                prepend-icon="block"
                v-if        ="isAgeGroupShown">
            </v-select>
            <v-btn
                @click      ="regist"
                :disabled   ="!valid">
                SUBMIT
            </v-btn>
            <v-btn
                @click      ="clear">
                CLEAR
            </v-btn>
        </v-form>
        <sweet-modal
            icon="error"
            title="ERROR"
            blocking
            ref="modal">
            Password is wrong!
        </sweet-modal>
     </v-container>
     
</template>

<script>
    export default {
        data: () => ({
            valid: true,

            inputId         : "",
            inputPw         : "",
            inputPwCk       : "",
            inputNickname   : "",
            inputPhoneNo    : "",
            isPhoneNoShown  : "",
            selectedGender  : "",
            isGenderShown   : "",
            selectedAgeGroup: "",
            isAgeGroupShown : "",
            ageOpenRange    : "",
            
            rules: {
                isBlanked: [
                    v => !!v || 'This is required',
                ],
            },
            options: {
                genderOpt: ['female','male'],
                ageGroupOpt: ['10대', '20대', '30대', '40대', '50대', '60대 이상'],
                ageOpenOpt: ['all', 'group']
            },
            httpAddr: Laravel.host,
            isTooltipShown: false
        }),
        methods: {
            regist () {
                if (this.isTooltipShown) {
                    console.log(this);
                    console.log(this.$parent);
                    return;
                }
                // if (this.$refs.form.validate()) {
                //     axios.post(this.httpAddr + '/user', {
                //         name: this.name,
                //         email: this.email,
                //         select: this.select,
                //         checkbox: this.checkbox
                //     })
                // }
                console.log('registered')
            },
            clear () {
                        this.$refs.form.reset()
            }
                // let uri= 'http://localhost:8000/user';
                // 
                // else if($('#pw').val() != $('#pwvc').val()) {
                //     alert('비밀 번호와 비밀번호 확인이 다릅니다')
                // }
                // else {
                //     this.axios.post(uri, this.item).then((response) => {
                //         if(response.data == 'true') {
                //             alert('회원가입 완료');
                //             this.$router.push({ name: 'main'});
                //         }
                //         else if(response.data == 'false')
                //             alert('이미 존재하는 아이디 입니다.');
                //             this.$router.push({ name: 'main'});

                //     })
                // }

        },
        watch: {
            inputPwCk(newValue) {
                if (newValue == this.inputPw) {
                    this.isTooltipShown = false;
                }
                if (newValue != this.inputPw){
                    this.isTooltipShown = true;
                }
            }
        }
    }
</script>