<!-- 
    @file   GroupPlanCalendar.vue
    @brief  A component of calendar
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   write plz
 -->
<template>
    <div>
    <vue-event-calendar :events="hikingEvents">
        <v-card v-for="(event, i) in hikingEvents" :key="i">
            <v-card-title primary-title>
                <div>
                    <div class="headline">{{ event.title }}</div>
                    <span class="grey--text">{{ event.writer }}</span>

                </div>
            </v-card-title>
            <v-card-actions>
                <v-btn flat>JOIN</v-btn>
                <v-btn flat color="purple" @click="openShowModal(event.mnt_id, event.route)">SHOW PATH</v-btn>
                <v-spacer></v-spacer>
                <v-btn icon @click.native="show = !show">
                    <v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                </v-btn>
            </v-card-actions>
            <v-slide-y-transition>
                <v-card-text v-show="show">
                    <div class="member-count-wrapper">
                        <div class="min_members inlineBlocks">산행 일자: {{ event.date }}</div>
                        <div class="max_members inlineBlocks">시작 시간: {{ event.time }}</div>
                    </div>
                    {{ event.desc }}
                </v-card-text>
            </v-slide-y-transition>
        </v-card>
    </vue-event-calendar>
    <sweet-modal ref="show" blocking>
        <group-plan-map></group-plan-map>
    </sweet-modal>
    </div>
</template>

<script>
    import GroupPlanMap from '../group_plan/GroupPlanMap'
    export default {
        components: {
            GroupPlanMap
        },
        data: () => ({
            show: false,
            hikingEvents: []
        }),
        methods:    {
            openShowModal : function(code, route) {
                this.$refs.show.open();
                this.$EventBus.$emit('eventShowMap', code, route);
            },
        },
        created() {
            axios.get(this.$HttpAddr + '/schedule', {
                uuid: this.$route.params.groupid
            }).then((response) => {
                console.log(response.data);
                for(let i = 0; i < response.data.length; i++)   {
                    this.hikingEvents.push({
                        date:
                            response.data[i].start_date.substring(0,4) + "/" +
                            response.data[i].start_date.substring(5,7) + "/" +
                            response.data[i].start_date.substring(8,10),
                        title:
                            response.data[i].title,
                        desc:
                            response.data[i].content,
                        writer:
                            response.data[i].leader,
                        no:
                            response.data[i].no,
                        route:
                            response.data[i].route,
                        mnt_id:
                            response.data[i].mnt_id,
                        time:
                            response.data[i].start_date.substring(11,19)
                    })
                }
            });
        }
    }
</script>

<style>
    .inlineBlocks {
        display: inline-block;
    }

    .max_members {
        align-self: flex-end;
        margin-left: 3%;
    }

    .member-count-wrapper {
        text-align: end;
    }
</style>