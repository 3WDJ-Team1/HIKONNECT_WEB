<!-- 
    @file   NoticeFormInside.vue
    @brief  A component that is inner of 'write or edit' modal
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   error test
 -->
<template>
    <!-- @div   A container of this component -->
    <v-app>
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
            <div class="filebox bs3-primary">
                <input class="upload-name" style="width: 400px;" :value="fileText" disabled="disabled">
                <label for="file">업로드</label>
                <input type="file" id="file" ref="file" class="upload-hidden" multiple
                       v-on:change="handleFilesUpload()"/>
            </div>
            <!-- v-btn      button for submit -->
            <v-btn
                    @click="submit"
                    style="height: 100%; color: white; margin-top: 20px;"
                    color="cyan"
            >
                submit
            </v-btn>
        </v-form>
    </v-app>
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
            fileText: '파일선택',
            picture: 'false',
            titleRules: [
                title => !!title || 'Title is required.'
            ],
            textRules: [
                text => !!text || 'Text is required.'
            ],
            mode: '',
        }),
        methods: {
            handleFilesUpload() {
                this.fileText = this.$refs.file.files[0].name;
            },
            submitFile()    {
                let file = this.$refs.file.files[0];
                /*
                  Initialize the form data
                */
                let formData = new FormData();
                /*
                  Iteate over any file sent over appending the files
                  to the form data.
                */
                formData.append('announce', file, this.fileText);
                /*
                  Make the request to the POST /select-files URL
                */
                axios.post('http://172.26.2.88:3000/image/announce',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function () {
                    console.log('SUCCESS!!');
                }).catch(function () {
                    console.log('FAILURE!!');
                });
            },
            /**
             * @function    submit
             * @brief       if submit button is clicked, send http request.
             */
            submit() {
                if(this.fileText != '파일선택') {
                    this.picture = 'true';
                }
                axios.post(this.$HttpAddr + '/notice', {
                    // nickname: this.nickname,
                    writer: sessionStorage.getItem('userid'), // user's uuid,
                    uuid: this.$route.params.groupid,
                    title: this.title,
                    content: this.text,
                    picture: this.picture
                }).then(response => {
                    if(response.data == 'true') {
                        if(this.picture == 'true')  {
                            this.submitFile();
                        }
                        this.$refs.form.reset();
                        this.$EventBus.$emit('newNoticeWrited', true);
                    }
                });
                this.$parent.close();
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
    .where {
        display: block;
        margin: 25px 15px;
        font-size: 11px;
        color: #000;
        text-decoration: none;
        font-family: verdana;
        font-style: italic;
    }

    .filebox input[type="file"] {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .filebox label {
        display: inline-block;
        padding: .5em .75em;
        color: #999;
        font-size: inherit;
        line-height: normal;
        vertical-align: middle;
        background-color: #fdfdfd;
        cursor: pointer;
        border: 1px solid #ebebeb;
        border-bottom-color: #e2e2e2;
        border-radius: .25em;
    }

    /* named upload */
    .filebox .upload-name {
        display: inline-block;
        padding: .5em .75em;
        font-size: inherit;
        font-family: inherit;
        line-height: normal;
        vertical-align: middle;
        background-color: #f5f5f5;
        border: 1px solid #ebebeb;
        border-bottom-color: #e2e2e2;
        border-radius: .25em;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .filebox.bs3-primary label {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }
</style>
