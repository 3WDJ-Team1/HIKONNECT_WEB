<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <v-app>
        <v-form v-model="valid" ref="form">
            <v-subheader style="font-size: 18px;">그룹 이름</v-subheader>
            <v-text-field
                    name="notice_title"
                    v-model="title"
                    :rules="titleRules"
                    required
            ></v-text-field>
            <v-subheader style="font-size: 18px;">모집 내용</v-subheader>
            <v-text-field
                    name="notice_text"
                    v-model="text"
                    :rules="textRules"
                    textarea
                    rows="7"
                    required
            ></v-text-field>
            <div style="display: flex;">
                <div style="margin: 5px; flex-grow: 1;">
                    <v-subheader style="font-size: 15px;">최소 모집 인원</v-subheader>
                    <v-text-field
                            name="minimum"
                            v-model="min"
                            :rules="minRules"
                            required
                    ></v-text-field>
                </div>

                <div style="margin: 5px; flex-grow: 1;">
                    <v-subheader style="font-size: 15px;">최대 모집 인원</v-subheader>
                    <v-text-field
                            name="maximum"
                            v-model="max"
                            :rules="maxRules"
                            required
                    ></v-text-field>
                </div>
            </div>
            <v-btn
                    @click="submit('top', 'center')"
                    style="height: 100%; color: white;"
                    color="cyan"
            >
                SUBMIT
            </v-btn>
        </v-form>
    </v-app>
</template>

<script>
    export default {
        data: () => ({
            valid: true,
            item: [],
            title: '',
            text: '',
            max: '',
            min: '',
            titleRules: [
                title => !!title || 'Title is required.'
            ],
            textRules: [
                text => !!text || 'Text is required.'
            ],
            minRules: [
                min => !!min || 'number is required.'
            ],
            maxRules: [
                max => !!max || 'number is required.'
            ]
        }),
        methods: {
            submit(verticalAlign, horizontalAlign) {
                axios.post(this.$HttpAddr + '/hikingGroup', {
                    // nickname: this.nickname,
                    writer: sessionStorage.getItem('userid'), // user's uuid,
                    title: this.title,
                    content: this.text,
                    min: this.min,
                    max: this.max
                }).then((response) => {
                    if (response.data == 'true') {
                        const notification = {
                            template: "<span><b>그룹이 생성 되었습니다.</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: horizontalAlign,
                                verticalAlign: verticalAlign,
                                type: 'success'
                            });
                        this.$EventBus.$emit('group_make_sign', 'true');

                    }
                });
                this.$refs.form.reset();
                this.$parent.close();
            }
        }
    }
</script>
<style>
    .application.theme--light {
        background: white;
    }
</style>
