<template>
    <div>
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
                @click="submit"
                style="height: 100%; color: white;"
                color="cyan"
        >
            submit
        </v-btn>
    </div>
</template>

<script>
    export default {
        data: () => ({
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
            submit() {
                axios.post(this.$HttpAddr + '/notice', {
                    // nickname: this.nickname,
                    writer: sessionStorage.getItem('userid'), // user's uuid,
                    title: this.title,
                    content: this.text,
                    min: this.min,
                    max: this.max
                });
                this.$parent.close();
            }
        }
    }
</script>
<style>
</style>
