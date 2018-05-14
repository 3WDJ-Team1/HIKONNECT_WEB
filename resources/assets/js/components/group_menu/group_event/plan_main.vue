<template>
    <div>
        <router-view v-if="listEventB" name="item"></router-view>
        <router-view v-if="makeEventB" name="make"></router-view>
        <v-btn
                style="margin-bottom: 5%; margin-right: 1%"
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                @click="makeEvent"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "plan_main",
        data() {
            return {
                position: '',
                listEventB: true,
                makeEventB: false,
            }
        },
        created() {
            // 그룹 만들기를 한 후
            this.$EventBus.$on('makeEventOK', (sign) => {
                if (sign == true) {
                    this.listEventB = true;
                    this.makeEventB = false;
                }
            });
            // 가입 후 그룹 만들기 가능
            this.$EventBus.$on('position', (position) => {
                this.position =  position;
            })
        },
        methods: {
            makeEvent() {
                if (position == 'guest') {
                    // alert창 띄워주기
                    const notification = {
                        template: "<span><b>그룹 가입 후 사용가능 합니다.</b></span>"
                    };
                    this.$notifications.notify(
                        {
                            component: notification,
                            icon: 'nc-icon nc-app',
                            horizontalAlign: horizontalAlign,
                            verticalAlign: verticalAlign,
                            type: 'warning'
                        })
                } else {
                    this.makeEventB = true;
                    this.listEventB = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>