<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <card>
        <template slot="header">
            <h1 class="card-title" style="font-family: 'Black Han Sans', sans-serif;">グルーブ生成</h1>
        </template>
    <v-app>
        <v-form v-model="valid" ref="form">
            <v-subheader style="font-family: 'Do Hyeon', sans-serif; font-size: 16px;"><h3 style="font-family: 'Do Hyeon', sans-serif;">グループ名</h3></v-subheader>
            <v-text-field
                    style="padding-top: 0px;"
                    name="notice_title"
                    v-model="title"
                    :rules="titleRules"
                    required
            ></v-text-field>
            <v-subheader style="font-family: 'Do Hyeon', sans-serif; font-size: 16px;"><h3 style="font-family: 'Do Hyeon', sans-serif;">募集内容</h3></v-subheader>
            <v-text-field
                    style="padding-top: 0px;"
                    name="notice_text"
                    v-model="text"
                    :rules="textRules"
                    textarea
                    rows="5"
                    required
            ></v-text-field>
            <div style="display: flex;">
                <div style="margin: 5px; flex-grow: 1;">
                    <v-subheader style="font-family: 'Do Hyeon', sans-serif; font-size: 16px;"><h3 style="font-family: 'Do Hyeon', sans-serif;">最小募集人員</h3></v-subheader>
                    <v-text-field
                            name="minimum"
                            v-model="min"
                            :rules="minRules"
                            required
                    ></v-text-field>
                </div>

                <div style="margin: 5px; flex-grow: 1;">
                    <v-subheader style="font-family: 'Do Hyeon', sans-serif; font-size: 16px;"><h3 style="font-family: 'Do Hyeon', sans-serif;">最大募集人員</h3></v-subheader>
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
                    style="height: 100%; color: white;     float: right;"
                    color="cyan"
            >
                <h4 style="margin: 5px; font-family: 'Do Hyeon', sans-serif;">登録</h4>
            </v-btn>
        </v-form>
    </v-app>
    </card>
</template>

<script>
    import Card from '.././Cards/Card'
    export default {
        components: {
            Card,
        },
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
                    writer: sessionStorage.getItem('userid'), // user's uuid,
                    title: this.title,
                    content: this.text,
                    min: this.min,
                    max: this.max
                }).then((response) => {
                    if (response.data == 'true') {
                        const notification = {
                            template: "<span><b>グルーブ生成完了</b></span>"
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
    .theme--light .input-group.input-group--textarea:not(.input-group--full-width) .input-group__input, .application .theme--light.input-group.input-group--textarea:not(.input-group--full-width) .input-group__input {
        padding: 5px;
    }
    .application--wrap {
        min-height: 0px;
    }
</style>
