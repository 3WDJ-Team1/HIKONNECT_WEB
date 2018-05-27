<template>
    <div>
        <eventList v-if="listEventB"></eventList>
        <eventMake v-if="makeEventB"></eventMake>
        <v-btn
                style="margin-bottom: 5%; margin-right: 1%"
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                v-if="vis"
                @click="makeEvent"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    import eventMake from '../make_event/event_make_main'
    import eventList from './GroupPlanCalendar'
    export default {
        components: {
            eventMake,
            eventList
        },
        name: "plan_main",
        data() {
            return {
                position: false,
                listEventB: true,
                makeEventB: false,
                vis: true,
            }
        },
        created() {
            // 그룹 만들기를 한 후
            this.$EventBus.$on('makeEventOK', (sign) => {
                if (sign == true) {
                    this.listEventB = true;
                    this.makeEventB = false;
                    this.vis = true;
                }
            });
            if(sessionStorage.getItem('userid') != undefined)   {
                this.$EventBus.$on('sendPositionInfo', (position) => {
                    console.log(position)
                    if(position != 'guest') {
                        this.position = true;
                    }
                });
            }
        },

        methods: {
            makeEvent() {
                if (this.position == 'false') {
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
                    this.vis = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>