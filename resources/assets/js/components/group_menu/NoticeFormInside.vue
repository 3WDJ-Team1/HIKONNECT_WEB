<!-- NoticeFormInside.vue -->
<template>
    <div>
        <v-form v-model="valid" ref="form">
            <v-subheader style="font-size: 20px;">title</v-subheader>
            <v-text-field
                name="notice_title"
                v-model="title"
                id="notice_input_title"
                v-bind:rules="titleRules"
                required
            ></v-text-field>
            <br>
            
            <v-subheader style="font-size: 20px;">text</v-subheader>
            <v-text-field
                name="notice_text"
                v-model="text"
                v-bind:rules="textRules"
                textarea
                rows="12"
                id="notice_input_textarea"
                required
            ></v-text-field>
            <v-btn
                v-on:click="submit"
                style="height: 100%; color: white;"
                color="cyan"
            >
                submit
            </v-btn>
        </v-form>
    </div>
</template>

<script>
sessionStorage.setItem('nickname', '닉넴');
    export default {
        data : function () {
            return {
                title: '',
                text: '',
                valid: false,
                titleRules: [
                    title => !!title || 'Title is required.'
                ],
                textRules: [
                    text => !!text || 'Text is required.'
                ],
            }
        },
        methods: {
            submit: function() {
                if(this.$refs.form.validate()) {
                    axios.post('http://localhost:8000/notice', {
                        writer: sessionStorage.getItem('nickname'),
                        title: this.title,
                        text: this.text
                    })
                }
            },
        },
        created() {
            this.$EventBus.$on('noticeData', (data) => {
                this.title = data.title;
                this.text = data.content;
            })
        }
    }
</script>

<style>
    #notice_input_title {
        border-bottom: 1px solid gray;
    }

    #notice_input_textarea {
        border: 1px solid gray;
    }
    #notice_input_textarea:focus {
        border: 2px solid darkslategrey;
    }
</style>
