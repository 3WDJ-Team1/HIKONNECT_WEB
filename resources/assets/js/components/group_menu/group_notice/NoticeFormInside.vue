<!-- 
    @file   NoticeFormInside.vue
    @brief  A component that is inner of 'write or edit' modal
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   error test
 -->
<template>
    <!-- @div   A container of this component -->
    <div>
        <!-- @v-form    form script of vuetify -->
        <v-form v-model="valid" ref="form">
            <v-subheader style="font-size: 20px;">title</v-subheader>
            <!-- @v-text-field#notice_input_title       text of title will be input -->
            <v-text-field
                    name="notice_title"
                    v-model="title"
                    :rules="titleRules"
                    required
            ></v-text-field>
            <br>
            <v-subheader style="font-size: 20px;">text</v-subheader>
            <!-- @v-text-field#notice_input_textarea    text of content will be input -->
            <v-text-field
                    name="notice_text"
                    v-model="text"
                    :rules="textRules"
                    textarea
                    rows="12"
                    required
            ></v-text-field>
            <!-- v-btn      button for submit -->
            <v-btn
                    @click="submit"
                    style="height: 100%; color: white;"
                    color="cyan"
            >
                submit
            </v-btn>
        </v-form>
    </div>
</template>

<script>
    export default {
        data: () => ({
            /**
             * title        (String)    the title of a notice which was selected.
             *                          if mode is 'edit', it will get value from event bus.
             * text         (String)    the content of a notice which was selected.
             *                          if mode is 'edit', it will get value from event bus.
             * noticeUuid   (String)    the uuid of a notice which was selected.
             *                          if mode is 'edit', it will get value from event bus.
             * valid        (Boolean)   the status of validation of this form
             * titleRules   (Array)     array of functions about rules of title. (not null)
             * textRules    (Array)     array of functions about rules of content. (not null)
             * mode         (String)    the mode of modal (edit or write)
             */
            title: '',
            text: '',
            noticeUuid: '',
            valid: false,
            titleRules: [
                title => !!title || 'Title is required.'
            ],
            textRules: [
                text => !!text || 'Text is required.'
            ],
            mode: '',
        }),
        methods: {
            /**
             * @function    submit
             * @brief       if submit button is clicked, send http request.
             */
            submit() {
                axios.post(this.$HttpAddr + '/api/notice', {
                    // nickname: this.nickname,
                    writer: sessionStorage.getItem('userid'), // user's uuid,
                    uuid: this.$route.params.groupid,
                    title: this.title,
                    content: this.text
                }).then(response => {
                    console.log(response.data);
                });
                this.$parent.close();
                this.$EventBus.$emit('newNoticeWrited', true);
            },
        },
        /**
         * @function    created
         * @brief       When this component is created, this function is invoked.
         *              init this.title, this.text, this.noticeUuid, this.mode with data in event bus
         */
        created() {
            this.$EventBus.$on('noticeData', (data) => {
                this.title = data.title;
                this.text = data.content;
                this.noticeUuid = data.uuid;
            });
            this.$EventBus.$on('modalMode', (modalMode) => {
                this.mode = modalMode;
            });
        }

    }
</script>

<style>
    /* #notice_input_title {
        border-bottom: 1px solid gray;
    } */

    #notice_input_textarea {
        /* border: 1px solid gray; */
    }

    #notice_input_textarea:focus {
        /* border: 2px solid darkslategrey; */
    }
</style>
