<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <card>
        <template slot="header">
            <h3 class="card-title" style="font-family: 'Gothic A1', sans-serif;">グループ生成</h3>
        </template>
        <v-app>
            <v-form v-model="valid" ref="form">
                <v-subheader style="font-family: 'Gothic A1', sans-serif; font-size: 16px;">グループ名</v-subheader>
                <v-text-field
                        style="padding-top: 0px;"
                        name="notice_title"
                        v-model="title"
                        :rules="titleRules"
                        required
                ></v-text-field>
                <v-subheader style="font-family: 'Gothic A1', sans-serif; font-size: 16px;">募集内容</v-subheader>
                <v-text-field
                        style="padding-top: 0px;"
                        name="notice_text"
                        v-model="text"
                        :rules="textRules"
                        textarea
                        rows="3"
                        required
                ></v-text-field>
                <div style="display: flex;">
                    <div style="margin: 5px; flex-grow: 1;">
                        <v-subheader style="font-family: 'Gothic A1', sans-serif; font-size: 16px;">最小募集人員</v-subheader>
                        <v-text-field
                                name="minimum"
                                v-model="min"
                                :rules="minRules"
                                required
                        ></v-text-field>
                    </div>
                    <div style="margin: 5px; flex-grow: 1;">
                        <v-subheader style="font-family: 'Gothic A1', sans-serif; font-size: 16px;">最大募集人員</v-subheader>
                        <v-text-field
                                name="maximum"
                                v-model="max"
                                :rules="maxRules"
                                required
                        ></v-text-field>
                    </div>
                </div>
                <v-btn
                        @click="updated()"
                        style="height: 100%; color: white; float: right;"
                        color="cyan"
                >
                    UPDATE
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
        created() {
            this.updateInfo();
        },
        methods: {
            updateInfo()    {
                this.axios.post(this.$HttpAddr + '/groupinfo',  {
                    uuid: this.$route.params.groupid
                }).then((response)=>{
                    this.title = response.data[0].title;
                    this.text = response.data[0].content;
                    this.max = response.data[0].max_member;
                    this.min = response.data[0].min_member;
                })
            },
            updated() {
                axios.put(this.$HttpAddr + '/hikingGroup/' + this.$route.params.groupid, {
                    title: this.title,
                    content: this.text,
                    min: this.min,
                    max: this.max
                }).then((response) => {
                    if (response.data == 'true') {
                        const notification = {
                            template: "<span><b>修正を完了しました。</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                        this.$EventBus.$emit('group_make_sign', 'true');
                    }
                });
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
