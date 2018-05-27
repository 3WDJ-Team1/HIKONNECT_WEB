<!-- 
    @file   GroupPlan.vue
    @brief  A component to show latest plan in group
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   write plz
 -->
<template>
    <div class="text-center">
        <router-view name="navigater" id="navigater"></router-view>
        <div class="plan_title">
            <h1 class="h1_highlight" id="summary">SUMMARY</h1>
            <br>

            <p class="p_summary">Destination : {{ summary.destination }}</p>
            <p class="p_summary">Date : {{ summary.schedule.date }}</p>
        </div>
        <div class="plan_title">
            <h1 class="h1_highlight" id="hiking_path">HIKING PATH</h1>
        </div>
        <router-view name="map"></router-view>
        <div v-b-toggle.calendar class="plan_title">
            <h1
                class="h1_highlight"
                style="width:90%; display: inline-block; vertical-align: middle;"
                 id="schedule">SCHEDULE</h1>
            <v-icon large color="lightgray" style="height: 100%;">keyboard_arrow_down</v-icon>
        </div>
        <b-collapse id="calendar" class="mt-2">
            <router-view name="calendar"></router-view>
        </b-collapse>
    </div>
</template>

<script>
    export default {
        data: () => ({
            summary: {
                destination: "소백산",
                schedule: {
                    date: "2018/04/01",
                    start_time: "07:00",
                    finish_time: "15:00"    
                }
            },
            hikingPathExplain: {
                // add
            },
            hikingPathInfo: [
                // add
            ],
            mountainInfo: {
                // add
            },
        }),
        methods: {
            getHikingPath() {
                // axios.get('http://hikonnect.ga:3000/mountain/',
                // (response) => {
                //     console.log(response);
                // });
            }
        },
        created() {
            this.getHikingPath();
        }
    }
</script>

<style>
.plan_title {
    padding: 1%;
    border-bottom: 1px solid whitesmoke;
    margin-bottom: 0.5%;
}
.h1_highlight {
    font-weight: bold;
}
.p_summary {
    font-size: 24px;
}
#navigater {
    display: inline-block;
    position: fixed;
    margin: 0 auto;
}
</style>
