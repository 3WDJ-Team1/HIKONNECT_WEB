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
            style="width: 70%; margin: 0 auto;">
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
            axios.post(this.$HttpAddr + '/hikingGroup', {
                uuid: this.$route.params.groupid
            }).then((response)=> {
                if(response.data == 'true')   {
                    alert('성공적으로 저장되었습니다.');
                    this.$EventBus.$emit('group_make_sign','true');

                }
            });
        }
    }
</script>

<style>

</style>