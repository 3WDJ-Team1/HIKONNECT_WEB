<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com
 -->
<template>
    <div>
        <!-- 캘린더 나오게 -->
        <eventList v-if="listEventB"></eventList>
        <!-- 일정 만들기 -->
        <eventMake v-if="makeEventB"></eventMake>
        <!-- 일정 수정하기 -->
        <eventUpdate :updateItem="updateItem" v-if="updateEventB"></eventUpdate>
        
    </div>
</template>

<script>
    import eventMake from '../make_event/event_make_main'
    import eventList from './GroupPlanCalendar'
    import eventUpdate from '../make_event/event_update_main'

    export default {
        components: {
            eventMake,
            eventList,
            eventUpdate
        },
        name: "plan_main",
        data() {
            return {
                /**
                 * position     (Boolean)   현재 사용자의 위치
                 * listEventB   (Boolean)   캘린더를 보여줄지 안보여줄지
                 * makeEventB   (Boolean)   일정만들기를 보여줄지 안보여줄지
                 * updateEventB (Boolean)   업데이트 페이지를 보여줄지 안보여줄지
                 */
                position: "",
                listEventB: true,
                makeEventB: false,
                updateEventB: false,
                updateItem : {},

            }
        },
        created() {
            // 기본 페이지 인 캘린더페이지로 돌아오기
            this.$EventBus.$on('backCalender', () => {
                this.listEventB = true;
                this.makeEventB = false;
                this.updateEventB = false;
                this.$EventBus.$emit('eventOK', 'true');
            });
            // 업데이트 사인을 받아와 업데이트 페이지를 보여준다.
            this.$EventBus.$on('updateEventSign', (event) => {
                this.updateItem = event;
                this.listEventB = false;
                this.makeEventB = false;
                this.updateEventB = true;
            });
            // 현재사용자가 작성자인지 맴버인지 맴버도 아닌지 정보를 받아온다.
            this.$EventBus.$on('positionGet', (position) => {
                this.position = position
            });
            // 그룹 만들기를 한 후 페이지를 바꿔줘야하므로
            this.$EventBus.$on('makeEventOK', (sign) => {
                if (sign == true) {
                    this.listEventB = true;
                    this.makeEventB = false;
                    this.updateEventB = false;
                }
                this.$EventBus.$emit('eventOK', 'true');
            });
            this.$EventBus.$on('eventOOk', (sign) => {
                this.makeEventB = true;
                this.listEventB = false;
                this.updateEventB = false;
            });
        }
    }
</script>

<style>

</style>