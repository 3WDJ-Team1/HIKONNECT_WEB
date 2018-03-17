<!-- 
    @file   GroupPlanCalendar.vue
    @brief  A component of calendar
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   write plz
 -->
<template>
    <v-card flat>
        <vue-event-calendar
            :events="hikingEvents"
            style="width: 90%; margin: 0 auto;">
        </vue-event-calendar>
    </v-card>
</template>

<script>
    export default {
        data: () => ({
            hikingEvents: [
                {
                    date: '2018/04/01',
                    title: 'Hike today',
                    desc: 'blahblah',
                }
            ]
        }),
        created() {
            // axios will be added.
        }
    }
</script>

<style>

</style>