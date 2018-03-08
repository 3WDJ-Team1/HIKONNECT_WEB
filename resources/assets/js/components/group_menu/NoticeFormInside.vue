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
    export default {
        data : function () {
            return {
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
                mode: ''
            }
        },
        methods: {
            submit: function() {
                switch(this.mode) {
                    case "edit":
                        if(this.$refs.form.validate()) {
                            axios.patch('http://localhost:8000/notice/' + this.noticeUuid, {
                                // nickname: this.nickname,
                                writer:'', // user's uuid,
                                title: this.title,
                                content: this.text
                            })
                        }
                    break;
                    case "write":
                        if(this.$refs.form.validate()) {
                            axios.post('http://localhost:8000/notice', {
                                // nickname: this.nickname,
                                writer:'', // user's uuid,
                                title: this.title,
                                content: this.text
                            })
                        }
                    break;
                }
            },
        },
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
