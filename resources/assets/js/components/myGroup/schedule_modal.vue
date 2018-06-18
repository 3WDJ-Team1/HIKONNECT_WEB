
<template>
    <div>
        <table class="table" style="text-align:center;">
            <tbody>
            <tr>
                <td colspan="1" style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; color: #9A9A9A; margin: 0px; vertical-align: middle;">일정 이름</h6>
                </td>
                <td colspan="3">
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">{{ item.title }}</h3>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">목적지</h6>
                </td>
                <td colspan="3">
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">{{ item.mnt_name }}</h3>
                </td>
            </tr>
            <tr>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">산행 일자</h6>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h3 style="font-size: 17px; color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ date }}</h3>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">산행 시간</h6>
                </td>
                <td>
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">{{ time }}</h3>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">모집 내용</h6>
                </td>
                <td colspan="3">
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">{{ item.content }}</h3>
                </td>
            </tr>
            <tr>
            <tr>
                <td colspan="4">
                    <showMap></showMap>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import showMap from '../group_menu/group_event/showMap'

    export default {
        components: {
            showMap
        },
        name: "schedule_modal",
        data() {
            return {
                item: [],
                date: '',
                time: ''
            }
        },
        created() {
            this.$EventBus.$on('schedule_modal', (item) => {
                this.item = item;
                this.$EventBus.$emit('eventShowMap', item);
                this.date = item.start_date.substring(0, 10);
                this.time = item.start_date.substring(11, 19);
            });
        }
    }
</script>

<style scoped>
    table.table thead td:not(:nth-child(1)), table.table tbody td:not(:nth-child(1)), table.table thead th:not(:nth-child(1)), table.table tbody th:not(:nth-child(1)), table.table thead td:first-child, table.table tbody td:first-child, table.table thead th:first-child, table.table tbody th:first-child {
         padding: 0 0px;
    }
</style>