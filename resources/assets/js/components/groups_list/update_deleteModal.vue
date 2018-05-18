<template>
    <v-app>
        <v-form v-model="valid" ref="form">
            <v-subheader style="font-size: 18px;">Type the group name</v-subheader>
            <v-text-field
                    name="notice_title"
                    v-model="title"
                    :rules="titleRules"
                    required
            ></v-text-field>
            <v-subheader style="font-size: 18px;">Fill the recruit notice</v-subheader>
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
                    <v-subheader style="font-size: 15px;">Fill minimun number of member</v-subheader>
                    <v-text-field
                            name="minimum"
                            v-model="min"
                            :rules="minRules"
                            required
                    ></v-text-field>
                </div>
                <div style="margin: 5px; flex-grow: 1;">
                    <v-subheader style="font-size: 15px;">Fill minimun number of member</v-subheader>
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
                    style="height: 100%; color: white;"
                    color="cyan"
            >
                UPDATE
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
                            template: "<span><b>그룹정보가 수정되었습니다.</b></span>"
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
