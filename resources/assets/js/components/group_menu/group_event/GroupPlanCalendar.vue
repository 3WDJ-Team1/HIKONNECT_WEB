<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <vue-event-calendar :events="hikingEvents">
            <template slot-scope="props">
                <div v-for="(event, index) in props.showEvents" class="event-item" style="padding: 0;">
                    <!-- In here do whatever you want, make you owner event template -->
                    <div style="border-bottom: 2px solid #d2d2d2;">
                        <div style="width: 99%; margin: auto;" class="row">
                            <div class="col-9" style="padding: 15px; font-size: 2.5rem; font-family: 'Gothic A1', sans-serif;">{{ event.title }}</div>
                        <div class="col-3" style="text-align: right; line-height: 80px; font-family: 'Gothic A1', sans-serif; font-size: 20px;">{{ event.writer }}</div>
                        </div>
                     </div>
                    <div style="border-bottom: 2px solid #d2d2d2;">
                        <div class="row" style="width: 99%; margin: auto; margin-top: 20px; margin-bottom: 20px;">
                            <div class="col-4">
                                <h6 style="font-family: 'Gothic A1', sans-serif; font-size: 20px; color: #9A9A9A; margin: 0px; vertical-align: middle;">
                                    目的地
                                </h6>
                            </div>
                            <div class="col-8">
                                <h5 style="font-family: 'Gothic A1', sans-serif; font-size: 20px; margin: 0px; text-align:left; margin-left: 10px;">
                                    {{ event.destination }}
                                </h5>
                            </div>
                        </div>
                        <div class="row" style="width: 99%; margin: auto; margin-bottom: 20px;">
                            <div class="col-4">
                                <h6 style="font-family: 'Gothic A1', sans-serif; font-size: 20px; margin: 0px; color: #9A9A9A;">ハイキング日程</h6>
                            </div>
                            <div class="col-8">
                                <h5 style="font-family: 'Gothic A1', sans-serif; font-size: 20px; margin: 0px; color: black; text-align:left; margin-left: 10px;">
                                    {{ event.date }}&nbsp;&nbsp;{{ event.time }}
                                </h5>
                                </div>
                                </div>
                    </div>
                    <div style="padding: 20px;">
                        <button class="BButton" style="font-size: 20px; font-family: 'Gothic A1', sans-serif; margin-right: 26px; float: right;" v-if="event.position == 'guest' && position=='enter'" @click="joinPlan(event.no)">
                        <i class="nc-icon nc-simple-add"  style="margin-right: 15px;"></i>
                        JOIN
                    </button>
                    <button class="BButton" style="font-size: 20px; font-family: 'Gothic A1', sans-serif; float: right; margin-right: 26px;" v-if="position=='enter' && event.position != 'owner'" @click="leaveEvent(event)">
                        <i class="nc-icon
nc-simple-delete"  style="margin-right: 15px;"></i>
                        CANCEL
                    </button>&nbsp;&nbsp;
                    <button class="BButton" style="font-size: 20px; font-family: 'Gothic A1', sans-serif; float: right; margin-right: 26px;" v-if="event.position == 'owner'" @click="uapdateEvent(event)">
                        <i class="nc-icon nc-refresh-02"  style="margin-right: 15px;"></i>
                        UPDATE
                    </button>&nbsp;&nbsp;
                    <button class="BButton" style="font-size: 20px; font-family: 'Gothic A1', sans-serif; float: right; margin-right: 26px;" v-if="event.position == 'owner'" @click="deleteEvent(event)">
                        <i class="nc-icon nc-simple-remove"  style="margin-right: 15px;"></i>
                        DELETE
                    </button>&nbsp;&nbsp;&nbsp;
                    <button class="BButton" style="font-size: 20px; font-family: 'Gothic A1', sans-serif; float: right; margin-right: 26px;" @click="openShowModal(event)">
                        <i class="nc-icon nc-square-pin" style="margin-right: 15px;"></i>
                        SHOW PATH
                    </button>
                    </div>
                </div>
            </template>
        </vue-event-calendar>
        <sweet-modal ref="show" blocking>
            <eventModal></eventModal>
        </sweet-modal>
    </div>
</template>

<script>
    import eventModal from './eventModal'
    export default {
        components: {
            eventModal,
        },
        data () {
            return {
                hikingEvents: [],
                position: '',
            }
        },
        methods: {
            // 일정 참가 해지
            leaveEvent(item)    {
                this.axios.post(this.$HttpAddr + '/out_schedule', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.$route.params.groupid,
                    schedule_no: item.no
                }).then((response) => {
                    if (response.data == "true") {
                        // alert창 띄우기
                        const notification = {
                            template: "<span><b>参加申請キャンセル完了</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                        // 참가신청 하고나서 다시 리스트 초기화
                        this.hikingEvents = [];
                        this.calendarList();
                    }
                });
            },
            // 수정하기 클릭 시 수정페이지로 가기위해 event보내기
            uapdateEvent(event)  {
                this.$EventBus.$emit('updateEventSign', event)
            },
            // 일정 삭제
            deleteEvent(item)   {
                this.axios.delete(this.$HttpAddr + '/schedule/' + item.no)
                    .then((response) => {
                        if (response.data == "true") {
                            const notification = {
                                template: "<span><b>削除完了</b></span>"
                            };
                            this.$notifications.notify(
                                {
                                    component: notification,
                                    icon: 'nc-icon nc-app',
                                    horizontalAlign: 'center',
                                    verticalAlign: 'top',
                                    type: 'success'
                                });
                            this.hikingEvents = [];
                            this.calendarList();
                        }
                    });
            },
            // 일정 참가 신청
            joinPlan(no) {
                this.axios.post(this.$HttpAddr + '/enter_schedule', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.$route.params.groupid,
                    schedule_no: no
                }).then((response) => {
                    if (response.data == "true") {
                        const notification = {
                            template: "<span><b>参加申請完了</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                        this.hikingEvents = [];
                        this.calendarList();
                    }
                });
            },
            // show path 클릭 시 일정 상세정보 모달을 보여준다.
            openShowModal: function (event) {
                this.$refs.show.open();
                // 상세정보를 보낸다.
                this.$EventBus.$emit('sendContent', event);
                // 상제 정보에 보여 줄 지도에 코드번호와 경로 번호를 보낸다.
                this.$EventBus.$emit('eventShowMap', event);
            },
            // 캘린더 리스트 불러오기
            calendarList()  {
                this.axios.get(this.$HttpAddr + '/schedule/' + this.$route.params.groupid)
                    .then((response) => {
                        for (let i = 0; i < response.data.length; i++) {
                            this.axios.get(this.$HttpAddr + '/checkScheduleMember/' + sessionStorage.getItem('userid') + '/' + response.data[i].no)
                                .then(position=>    {
                                    this.hikingEvents.push({
                                        destination: response.data[i].mnt_name,
                                        position: position.data,
                                        date:
                                        response.data[i].start_date.substring(0, 4) + "/" +
                                        response.data[i].start_date.substring(5, 7) + "/" +
                                        response.data[i].start_date.substring(8, 10),
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
                                            response.data[i].start_date.substring(11, 19)
                                    })
                                });
                        }
                    });
            }
        },
        // 캘린더 리스트 불러오기
        created() {
            this.$EventBus.$on('positionGet', (position) => {
                this.position = position
            });
            this.calendarList();
        }
    }
</script>
<style>
    table.table .tbbody td {
        height: 30px;
    }
    .BButton:hover    {
        color: #df21ffa3;
    }
    .__vev_calendar-wrapper .cal-wrapper {
        border-right: 3px #22b573 dashed;
        width: 64%;
        min-height: 700px;
    }
    .__vev_calendar-wrapper {
        position: inherit;
        margin: 0;
    }
    .__vev_calendar-wrapper .events-wrapper .event-item:first-child {
        padding-bottom: 40px;
    }
    .__vev_calendar-wrapper .events-wrapper .cal-events .event-item {
            margin-bottom: 20px;
    }
</style>