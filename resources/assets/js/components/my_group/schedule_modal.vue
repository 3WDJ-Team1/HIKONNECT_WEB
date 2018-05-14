<template>
    <div>
        <table class="table">
            <tbody>
            <tr>
                <td><span style="font-size: 12px; color: #9A9A9A;">일정 이름</span>&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;">{{ item.title }}</span></td>
                <td><span style="font-size: 12px; color: #9A9A9A;">일정 작성자</span>&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;">{{ item.schedule_leader }}</span></td>
            </tr>
            <tr>
                <td><span style="font-size: 12px; color: #9A9A9A;">목적지</span>&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;">{{ item.mnt_name }}</span></td>
                <td><span style="font-size: 12px; color: #9A9A9A;">산행 일자</span>&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;">{{ item.start_date }}</span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span style="font-size: 12px; color: #9A9A9A;">모집 내용</span>&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;">{{ item.content }}</span></td>
            </tr>
            <tr>
                <td colspan="2">
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
            }
        },
        created() {
            this.$EventBus.$on('schedule_modal', (item) => {
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