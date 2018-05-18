<!--
    @file   NoticeFormInside.vue
    @brief  A component that is inner of 'write or edit' modal
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   error test
 -->
<template>
    <h2>제목</h2>

</template>

<script>
    export default {
        data: () => ({
            title: '',
            text: '',
        }),
        methods: {

        },
        /**
         * @function    created
         * @brief       When this component is created, this function is invoked.
         *              init this.title, this.text, this.noticeUuid, this.mode with data in event bus
         */
        created() {
            this.$EventBus.$emit('sendNoticeModal', notice);
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
