<!--
    @author Sungeun Kang <kasueu0814@gmail.com> Jiyoon Lee <jiyoon3421@gmail.com
 -->
<template>
    <!-- @div   A container of this component -->
    <v-app>
        <!-- @v-form    form script of vuetify -->
        <v-form ref="form">
            <v-subheader style="font-size: 20px;">題名</v-subheader>
            <!-- @v-text-field#notice_input_title       text of title will be input -->
            <v-text-field
                    name="notice_title"
                    v-model="title"
                    :rules="titleRules"
                    required
            ></v-text-field>
            <v-subheader style="font-size: 20px;">内容</v-subheader>
            <!-- @v-text-field#notice_input_textarea    text of content will be input -->
            <v-text-field
                    name="notice_text"
                    v-model="text"
                    :rules="textRules"
                    textarea
                    rows="12"
                    required
            ></v-text-field>
            <div class="row">
                <div class="filebox bs3-primary col-9">
                    <input class="upload-name" style="width: 300px;" :value="fileText" disabled="disabled">
                    <label for="file" v-if="check == 'accepted'">アップロード</label>
                    <input type="file" id="file" ref="file" class="upload-hidden" multiple
                           v-on:change="handleFilesUpload()"/>

                    <label for="fake" v-if="check != 'accepted'">アップロード</label>
                    <input type="file" id="fake" disabled class="upload-hidden" multiple/>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12">
                            <b-form-checkbox
                                            id="putImage"
                                             v-model="check"
                                             style="padding-top: 15px;"
                                             value="accepted"
                                             unchecked-value="not_accepted"
                            >
                                {{ checkBoxLabel }}
                            </b-form-checkbox>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <b-form-checkbox
                                            v-if="updateItem.picture == 'true'"
                                            id="removeImage"
                                             v-model="removeImage"
                                             style="padding-top: 15px;"
                                             value="accepted"
                                             unchecked-value="not_accepted"
                            >
                                写真削除
                            </b-form-checkbox>
                        </div>
                    </div>
                </div>
            </div>
            <!-- v-btn      button for submit -->
            <v-btn
                    @click="submit"
                    style="height: 100%; color: white; margin-top: 20px;"
                    color="cyan"
            >
                登録
            </v-btn>
        </v-form>
    </v-app>
</template>

<script>
    export default {
        props:  {
            updateItem: {
                type: Object
            }
        },
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
            fileText: '파일선택',
            picture: 'false',
            checkBoxLabel: '사진바꾸기',
            removeImage: '',
            titleRules: [
                title => !!title || 'Title is required.'
            ],
            textRules: [
                text => !!text || 'Text is required.'
            ],
            check: ""
        }),
        watch:  {
            removeImage: function () {
                if(this.removeImage == 'accepted')  {
                    this.picture = 'false';
                    $('#putImage').attr("disabled", "disabled");
                } else  {
                    this.picture = 'true';
                    $('#putImage').removeAttr("disabled");
                }
            },
            check: function () {
                if(this.checkBoxLabel == '사진 추가하기') {
                    if(this.check == 'accepted')  {
                        this.picture = 'true';
                        $('#removeImage').attr("disabled", "disabled");
                    } else  {
                        this.picture = 'false';
                        $('#removeImage').removeAttr("disabled");
                    }
                } else {
                    if(this.check == 'accepted')  {
                        this.picture = 'true';
                    } else  {
                        this.picture = 'false';
                    }
                }
            }
        },
        created()   {
            this.picture = this.updateItem.picture;
            if(this.picture == 'false')   {
                this.checkBoxLabel = '사진 추가하기'
            }
            this.title = this.updateItem.title;
            this.text = this.updateItem.content;
        },
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
                formData.append('announce', file, this.updateItem.no + '.jpg');
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
                // 서버로 공지사항 정보 보내기
                this.axios.put(this.$HttpAddr + '/notice/' + this.updateItem.no, {
                    // nickname: this.nickname,
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
                    }
                });
                // 공지사항 쓰기 모달 닫기
                this.$parent.close();
                location.reload();
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
        margin: 0px;
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }
    .card label {
        padding-top: 2px;
    }
</style>
