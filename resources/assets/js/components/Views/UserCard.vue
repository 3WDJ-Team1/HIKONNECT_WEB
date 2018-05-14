<template>
    <card class="card-user">
        <h5 style="color: #9A9A9A;">PROFILE IMAGE</h5>
        <div class="author">
            <img class="avatar border-gray" v-if="!image" src="http://localhost:8000/images/unnamed.jpg"/>
            <img class="avatar border-gray" v-else :src="image" />
        </div>
        <div slot="footer" v-if="uploadButtonVis" class="text-center">
            <div class="filebox bs3-primary">
                <input class="upload-name" :value="fileText" disabled="disabled">
                <label for="file">업로드</label>
                <input type="file" id="file" ref="file" class="upload-hidden" multiple
                       v-on:change="handleFilesUpload()"/>
            </div>
            <br>
        </div>
    </card>
</template>
<script>
    import Card from '../Cards/Card.vue'

    export default {
        components: {
            Card
        },
        created() {
            this.$EventBus.$on('upadateSign', ()=>{
                this.uploadButtonVis = true;
            })
            this.$EventBus.$on('sendInputID', (inputID) => {
                this.userId = inputID;
            });
            if(sessionStorage.getItem('userid') != undefined)   {
                this.uploadButtonVis = false;
                this.image = 'http://172.26.2.88:3000/images/UserProfile/' + sessionStorage.getItem('userid') + '.jpg'
            }
        },
        /*
          Defines the data used by the component
        */
        data() {
            return {
                uploadButtonVis: true,
                fileText: '파일선택',
                file: '',
                image: '',
                userid: ''
            }
        },
        methods: {
            // 파일보내기
            sendImageFile() {
                this.$EventBus.$emit('sendImageFile', this.file);
            },
            /*
              Handles the uploading of files
            */
            handleFilesUpload() {
                this.file = this.$refs.file.files[0];
                this.fileText = this.file.name;
                this.createImage(this.file);
            },
            createImage(file) {
                var reader = new FileReader();

                reader.onload = (e) => {
                    console.log(e);
                    this.image = e.target.result;
                };
                reader.readAsDataURL(file);
                this.sendImageFile();
            }
        }
    }

</script>
<style>
    .card-user .card-body {
        min-height: 0px;
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

    .card-user .author {
        margin-top: 30PX;
    }
</style>
