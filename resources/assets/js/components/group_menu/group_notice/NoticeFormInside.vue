<!--
    @file   NoticeFormInside.vue
    @brief  A component that is inner of 'write or edit' modal
    @author Sungeun Kang <kasueu0814@gmail.com> Jiyoon Lee <jiyoon3421@gmail.com
    @todo   error test
 -->
<template>
    <!-- @div   A container of this component -->
    <v-app>
        <!-- @v-form    form script of vuetify -->
        <v-form v-model="valid" ref="form">
            <v-subheader style="font-size: 20px;">제목</v-subheader>
            <!-- @v-text-field#notice_input_title       text of title will be input -->
            <v-text-field
                    name="notice_title"
                    v-model="title"
                    :rules="titleRules"
                    required
            ></v-text-field>
            <v-subheader style="font-size: 20px;">내용</v-subheader>
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
            valid: false,
            fileText: '파일선택',
            picture: 'false',
            titleRules: [
                title => !!title || 'Title is required.'
            ],
            textRules: [
                text => !!text || 'Text is required.'
            ],
        }),
        methods: {
            // 파일 이름을 input 박스에 넣기 위한 메서드
            handleFilesUpload() {
                this.fileText = this.$refs.file.files[0].name;
            },
            // 사진 파일을 서버에 저장
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
                this.axios.post('http://hikonnect.ga:3000/image/announce',
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
                // fileText에 사진에 저장 되어 있을 겨우 true
                if(this.fileText != '파일선택') {
                    this.picture = 'true';
                }
                // 서버로 공지사항 정보 보내기
                axios.post(this.$HttpAddr + '/notice', {
                    // nickname: this.nickname,
                    writer: sessionStorage.getItem('userid'), // user's uuid,
                    uuid: this.$route.params.groupid,
                    title: this.title,
                    content: this.text,
                    picture: this.picture
                }).then(response => {
                    // 정상적으로 저장 되었을 시 true
                    if(response.data == 'true') {
                        // 업로드 된 사진 정보가 있을경우
                        if(this.picture == 'true')  {
                            // 사진을 서버로 보내는 메서드 호출
                            this.submitFile();
                            this.fileText = '파일선택'
                        }
                        // 공지사항을 저장했으니 form-input 지우기
                        this.$refs.form.reset();
                        // 공지사항이 쓰여 졌으면 공지사항 리스트를 다시 재배열해야하므로 event보내기
                        this.$EventBus.$emit('newNoticeWrited', true);
                    }
                });
                // 공지사항 쓰기 모달 닫기
                this.$parent.close();
            },
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
