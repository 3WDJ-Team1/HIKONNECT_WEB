<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <table class="table" style="text-align:center;">
            <tbody>
            <tr>

                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; color: #9A9A9A; margin: 0px; vertical-align: middle;">그룹 이름</h6>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h3 style="font-size: 17px; color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ item.group_title}}</h3>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; color: #9A9A9A; margin: 0px; vertical-align: middle;">관리자</h6>
                </td>
                <td>
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">{{ item.group_leader }}</h3>
                </td>
            </tr>
            <tr>
                <td colspan="1" style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; color: #9A9A9A; margin: 0px; vertical-align: middle;">일정 이름</h6>
                </td>
                <td colspan="3">
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">{{ item.title }}</h3>
                </td>
            </tr>
            <tr>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">일정 관리자</h6>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h3 style="font-size: 17px; color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ item.schedule_leader }}</h3>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">목적지</h6>
                </td>
                <td>
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">{{ item.mnt_id }}</h3>
                </td>
            </tr>
            <tr>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">평균속도</h6>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h3 style="font-size: 17px; color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ item.avg_speed }}km/h</h3>
                </td>
                <td style="border-right: solid; color: rgb(244, 244, 244);">
                    <h6 style="font-size: 12px; margin: 0px; color: #9A9A9A;">등수</h6>
                </td>
                <td>
                    <h3 style="font-size: 17px; margin: 0px; text-align:left; margin-left: 10px;">1등</h3>
                </td>
            </tr>
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
        data() {
            return {
                item: [],
            }
        },
        created() {
            // this.$EventBus.$emit('eventShowMap', item.mnt_id, item.route);
            this.$EventBus.$on('recordItem', (item) => {
                this.item = item;
                this.$EventBus.$emit('eventShowMap', this.item.mnt_id, this.item.route);
            });
        }
    }
</script>

<style scoped>
    table.table thead td:not(:nth-child(1)), table.table tbody td:not(:nth-child(1)), table.table thead th:not(:nth-child(1)), table.table tbody th:not(:nth-child(1)), table.table thead td:first-child, table.table tbody td:first-child, table.table thead th:first-child, table.table tbody th:first-child {
        padding: 0 0px;
    }
</style>