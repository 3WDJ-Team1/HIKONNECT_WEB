<template>
    <div class="row">
        <div class="col-md-6">
            <card class="ccard">
                <template slot="header">
                    <h1 class="card-title" style="font-family: 'Gothic A1', sans-serif;">詳しいスケジュール</h1>
                </template>
            <table class="table" style="width: 100%; text-align:center; margin-top: 5%; margin-bottom: 5%; margin-left: 20px;">
                <tbody>
                <tr>
                    <td style="border-right: solid; border-top: 0px; color: rgb(244, 244, 244);">
                        <h5 style="margin: 0px; color: #9A9A9A;">グループ名</h5>
                    </td>
                    <td style="border-top: 0px; border-right: solid; color: rgb(244, 244, 244);">
                        <h3 style="color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ item.group_title }}</h3>
                    </td>
                    <td style="border-top: 0px; border-right: solid; color: rgb(244, 244, 244);">
                        <h5 style="margin: 0px; color: #9A9A9A;">管理者</h5>
                    </td>
                    <td style="border-top: 0px;">
                        <h3 style="margin: 0px; text-align:left; margin-left: 10px;">{{ item.group_leader }}</h3>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: solid;  color: rgb(244, 244, 244);">
                        <h5 style="color: #9A9A9A; margin: 0px; vertical-align: middle;">スケジュール名</h5>
                    </td>
                    <td style="border-right: solid; color: rgb(244, 244, 244);">
                        <h3 style="color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ item.title }}</h3>
                    </td>
                    <td style="border-top: solid; border-right: solid; color: rgb(244, 244, 244);">
                        <h5 style="margin: 0px; color: #9A9A9A;">管理者</h5>
                    </td>
                    <td style="border-top: solid; color: rgb(244, 244, 244);">
                        <h3 style="margin: 0px; text-align:left; margin-left: 10px; color: black;">{{ item.schedule_leader }}</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="border-right: solid; color: rgb(244, 244, 244);">
                        <h5 style="margin: 0px; color: #9A9A9A;">目的地</h5>
                    </td>
                    <td colspan="3">
                        <h3 style="margin: 0px; text-align:left; margin-left: 10px;">{{ item.mnt_name }}</h3>
                    </td>
                </tr>
                <tr>
                    <td style="border-right: solid; color: rgb(244, 244, 244);">
                        <h5 style="margin: 0px; color: #9A9A9A;">ハイキング日程</h5>
                    </td>
                    <td style="border-right: solid; color: rgb(244, 244, 244);">
                        <h3 style="color: black; margin: 0px; text-align:left; margin-left: 10px;">{{
                            date }}</h3>
                    </td>
                    <td style="border-right: solid; color: rgb(244, 244, 244);">
                        <h5 style="margin: 0px; color: #9A9A9A;">ハイキング時間</h5>
                    </td>
                    <td>
                        <h3 style="margin: 0px; text-align:left; margin-left: 10px;">{{ time }}</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="border-right: solid; color: rgb(244, 244, 244);" rowspan="6">
                        <h5 style="margin: 0px; color: #9A9A9A;">募集内容</h5>
                    </td>
                    <td colspan="3" rowspan="6">
                        <h3 style="margin: 0px; text-align:left; margin-left: 10px;">{{ item.content
                            }}</h3>
                    </td>
                </tr>
                <tr>
                    <td style="border: 0;">
                    </td>
                    <td style="border: 0;">
                    </td>
                </tr>
                <tr>
                    <td style="border: 0;">
                    </td>
                    <td style="border: 0;">
                    </td>
                </tr>
                <tr>
                    <td style="border: 0;">
                    </td>
                    <td style="border: 0;">
                    </td>
                </tr>
                <tr>
                    <td style="border: 0;">
                    </td>
                    <td style="border: 0;">
                    </td>
                </tr>
                <tr>
                    <td style="border: 0;">
                    </td>
                    <td style="border: 0;">
                    </td>
                </tr>
                </tbody>
            </table>
                <button style="margin: 20px; margin-top: 0; float: right; padding: 0; height: 10%;" type="submit" @click="move(item.uuid)" class="btn btn-info btn-fill float-right">
                    <h3 style="font-family: 'Gothic A1', sans-serif; margin: 0; padding: 10px;">グループページへ</h3>
                </button>
        </card>
        </div>
        <div class="col-md-6">
            <card class="ccard">
                <showMap></showMap>
            </card>
        </div>
    </div>
</template>

<script>
    import showMap from '../group_menu/group_event/showMap'
    import Card from '.././Cards/Card'
    export default {
        components: {
            showMap,
            Card
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

<style>
    .sweet-modal.is-visible {
        max-width: 100%;
        min-height: 73%;
    }
    .ccard > *:last-child:not(.btn) {
        padding: 0px;
    }
</style>