<template>
    <div>
        <vue-event-calendar @day-changed="handleDayChanged"
                            @month-changed="handleMonthChanged" :events="hikingEvents">
            <Card v-for="(event, index) in hikingEvents" :key="i" class="event-item">
                <div class="headline" style="display: inline; font-size: 20px !important">{{ event.title }}</div>
                <span class="grey--text" style="display: inline; float: right; margin-top: 10px;">작성자:&nbsp;&nbsp;{{ event.writer }}</span>
                <table class="table" style="text-align:center;">
                    <tbody class="tbbody">
                    <tr>
                        <td style="border-right: solid; color: rgb(244, 244, 244);">
                            <h6 style="font-size: 12px; color: #9A9A9A; margin: 0px; vertical-align: middle;">
                                목적지
                            </h6>
                        </td>
                        <td>
                            <h5 style="font-size: 14px; margin: 0px; text-align:left; margin-left: 10px;">
                                {{ event.destination }}
                            </h5>
                        </td>
                    </tr>
                    <tr style="border-bottom: solid; color: rgb(244, 244, 244);">
                        <td style="border-right: solid; color: rgb(244, 244, 244);">
                            <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">산행일자</h6>
                        </td>
                        <td>
                            <h5 style="font-size: 14px; margin: 0px; color: black; text-align:left; margin-left: 10px;">
                                {{ event.date }}&nbsp;&nbsp;{{ event.time }}
                            </h5>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button class="BButton" style="float: right;" @click="joinPlan(event.no)">
                    <i class="nc-icon nc-simple-add"></i>
                    JOIN
                </button>
                <button class="BButton" style="float: right; margin-right: 10px;" @click="leaveEvent(event)">
                    <i class="nc-icon
nc-simple-delete"></i>
                    LEAVE
                </button>
                <button class="BButton" style="float: right; margin-right: 10px;" @click="uapdateEvent(event.desc, event.mnt_id, event.route)">
                    <i class="nc-icon nc-refresh-02"></i>
                    UADATE
                </button>
                <button class="BButton" style="float: right; margin-right: 10px;" @click="deleteEvent(event)">
                    <i class="nc-icon nc-simple-remove"></i>
                    DELETE
                </button>
                <button class="BButton" style="float: right; margin-right: 10px;" @click="openShowModal(event.desc, event.mnt_id, event.route)">
                    <i class="nc-icon nc-square-pin"></i>
                    SHOW PATH
                </button>
            </Card>
        </vue-event-calendar>
        <sweet-modal ref="show" blocking>
            <eventModal></eventModal>
        </sweet-modal>
    </div>
</template>

<script>
    import eventModal from './eventModal'
    import Card from '../../Cards/Card'

    export default {
        components: {
            eventModal,
            Card
        },
        data: () => ({
            show: false,
            hikingEvents: []
        }),
        methods: {
            leaveEvent(item)    {
                this.axios.post(this.$HttpAddr + '/out_schedule', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.$route.params.groupid,
                    schedule_no: item.no
                }).then((response) => {
                    if (response.data == "true") {
                        const notification = {
                            template: "<span><b>참가신청이 해지 되었습니다.</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                    }
                });
            },
            uapdateEvent()  {
                this.axios.post(this.$HttpAddr + '/enter_schedule', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.$route.params.groupid,
                    schedule_no: no
                }).then((response) => {
                    if (response.data == "true") {
                        const notification = {
                            template: "<span><b>수정되었습니다.</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                        this.calendarList();
                    }
                });
            },
            deleteEvent(item)   {
                this.axios.delete(this.$HttpAddr + '/schedule/' + item.no)
                    .then((response) => {
                    if (response.data == "true") {
                        const notification = {
                            template: "<span><b>일정이 삭제 되었습니다.</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                        this.calendarList();
                    }
                });
            },
            joinPlan(no) {
                this.axios.post(this.$HttpAddr + '/enter_schedule', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.$route.params.groupid,
                    schedule_no: no
                }).then((response) => {
                    if (response.data == "true") {
                        const notification = {
                            template: "<span><b>일정에 참가신청 되었습니다.</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                    }
                });
            },
            openShowModal: function (content, code, route) {
                this.$refs.show.open();
                this.$EventBus.$emit('sendContent', content);
                this.$EventBus.$emit('eventShowMap', code, route);
            },
            calendarList()  {
                this.axios.get(this.$HttpAddr + '/schedule/' + this.$route.params.groupid)
                    .then((response) => {
                        for (let i = 0; i < response.data.length; i++) {
                            this.hikingEvents.push({
                                destination: response.data[i].mnt_name,
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
                        }
                    });
            }
        },
        created() {
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

</style>