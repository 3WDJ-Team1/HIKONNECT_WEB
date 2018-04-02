<!-- 
    @file   register.vue
    @brief  A component of sign up module
    @author Jungyu Choi <wnsrb0147@naver.com>, Sungeun Kang <kasueu0814@gmail.com>
    @todo   change design
 -->
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
            <!-- @v-text-field  input user id (required) -->
            <v-text-field
                label       ="Enter ID"
                v-model     ="inputId"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="person">                
            </v-text-field>
            <!-- @v-text-field  input user passowrd (required) -->
            <v-text-field
                label       ="Enter password"
                v-model     ="inputPw"
                type        ="password"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="lock_outline">
            </v-text-field>
            <!-- @v-text-field  input user password again (required) -->
            <v-text-field
                id          ="inputPwCk"
                label       ="Enter password again"
                v-model     ="inputPwCk"
                type        ="password"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="lock">
            </v-text-field>
            <!-- @b-tooltip     a tooltip to show users alert -->
            <b-tooltip
                target  ="inputPwCk"
                v-if    ="isTooltipShown"
                triggers="focus hover">
                Check your password!
            </b-tooltip>
            <!-- @v-text-field  input user nickname (required) -->
            <v-text-field
                label       ="Enter nickname"
                v-model     ="inputNickname"
                :rules      ="rules.isBlanked"
                required
                prepend-icon="mood">
            </v-text-field>
            <!-- @v-text-field  input user phone number (option) -->
            <v-text-field
                label       ="Enter phone number"
                v-model     ="inputPhoneNo"
                prepend-icon="phone"
                single-line>
            </v-text-field>
            <!-- @v-switch      boolean value open user's phone num (option) -->
            <v-switch
                :label          ="isPhoneNoShown ? 'show number public' : 'private'"
                v-model         ="isPhoneNoShown"
                :prepend-icon   ="isPhoneNoShown ? 'lock_open' : 'lock_outline'"
                hide-details>
            </v-switch>
            <!-- @v-select      select user's gender (option) -->
            <v-select
                :items      ="options.genderOpt"
                v-model     ="selectedGender"
                label       ="GENDER"
                single-line
                auto
                prepend-icon="wc">
            </v-select>
            <!-- @v-switch      boolean value open user's gender (option) -->
            <v-switch
                :label          ="isGenderShown ? 'show gender public' : 'private'"
                v-model         ="isGenderShown"
                :prepend-icon   ="isGenderShown ? 'lock_open' : 'lock_outline'"
                hide-details>
            </v-switch>
            <!-- @v-select      select user's age group (option) -->
            <v-select
                :items      ="options.ageGroupOpt"
                v-model     ="selectedAgeGroup"
                label       ="AGE"
                single-line
                auto
                prepend-icon="face">
            </v-select>
            <v-switch
                :label          ="isAgeGroupShown ? 'show age public' : 'private'"
                v-model         ="isAgeGroupShown"
                :prepend-icon   ="isAgeGroupShown ? 'lock_open' : 'lock_outline'"
                hide-details>
            </v-switch>
            <!-- @v-select      select open range -->
            <v-select
                :items      ="options.openOpt"
                v-model     ="openRange"
                label       ="RANGE"
                single-line
                auto
                prepend-icon="block"
                :v-if="isPhoneNoShown || isGenderShown || isAgeGroupShown">
            </v-select>
            <!-- @v-btn         button for submit -->
            <v-btn
                @click      ="regist"
                :disabled   ="!valid"
                style       ="padding: 0;">
                SUBMIT
            </v-btn>
            <!-- @v-btn         button for clear -->
            <v-btn
                @click      ="clear">
                CLEAR
            </v-btn>
        </v-form>
     </v-container>
</template>

<script>
    export default {
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
             * httpAddr         (String)        The address of server
             * isTooltipShown   (Boolean)       Is tooltip to show user alert now floating
             */
            valid           : true,
            inputId         : "",
            inputPw         : "",
            inputPwCk       : "",
            inputNickname   : "",
            inputPhoneNo    : "",
            isPhoneNoShown  : false,
            selectedGender  : "",
            isGenderShown   : false,
            selectedAgeGroup: "",
            isAgeGroupShown : false,
            openRange       : "",
            rules   : {
                isBlanked   : [
                    v => !!v || 'This is required',
                ],
            },
            options : {
                genderOpt   : ['female','male'],
                ageGroupOpt : ['10대', '20대', '30대', '40대', '50대', '60대 이상'],
                openOpt     : ['all', 'group']
            },
            httpAddr        : Laravel.host,
            isTooltipShown  : false
        }),
        methods: {
            /**
             * @function    regist
             * @brief       Try to regist user.
             *              Check is form valid. Then send request to server.
             */
            regist () {
                if (this.isTooltipShown) {
                    this.$EventBus.$emit('errorModalOpen', 'Check your password!');
                    return;
                }
                if (this.$refs.form.validate()) {
                    axios.post(this.httpAddr + '/user', {
                        name    : this.name,
                        email   : this.email,
                        select  : this.select,
                        checkbox: this.checkbox
                    }).then(response => {
                        if (response.data == 'true')
                        {
                            $this.$EventBus.$emit('complitedModalOpen', 'true');
                        }
                        else
                        {
                            this.$EventBus.$emit('errorModalOpen', 'The user ID already exists!');
                        }
                    })
                }
            },
            /**
             * @function    clear
             * @brief       Clear the form...
             */
            clear () {
                this.$refs.form.reset()
            }
        },
        watch: {
            /**
             * @watch       inputPwCk
             * @brief       It checks the value of inputPwCk, then change status of isTooltipShown.
             */
            inputPwCk(newValue) {
                if (newValue == this.inputPw) {
                    this.isTooltipShown = false;
                }
                if (newValue != this.inputPw){
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
                if (newValue != this.inputPwCk){
                    this.isTooltipShown = true;
                }
            }
        }
    }
</script>