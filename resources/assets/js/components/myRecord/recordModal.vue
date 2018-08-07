<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="row">
        <div class="col-md-6">
            <card class="ccard" style="margin: 0px;">
                <template slot="header">
                    <h1 class="card-title" style="font-family: 'Gothic A1', sans-serif;">ハイキング記録</h1>
                </template>
                <table class="table" style="width: 100%; text-align:center; margin-top: 4%; margin-left: 20px;">
                    <tbody>
                    <tr>
                        <td style="border-right: solid; border-top: 0px; color: rgb(244, 244, 244);">
                            <h5 style="margin: 0px; color: #9A9A9A;">グループ名</h5>
                        </td>
                        <td style="border-top: 0px; border-right: solid; color: rgb(244, 244, 244);">
                            <h3 style="color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ item.group_title}}</h3>
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
                            <h3 style="color: black; margin: 0px; text-align:left; margin-left: 10px;">
                                {{ item.title }}</h3>
                        </td>
                        <td style="border-top: solid; border-right: solid; color: rgb(244, 244, 244);">
                            <h5 style="margin: 0px; color: #9A9A9A;">管理者</h5>
                        </td>
                        <td style="border-top: solid; color: rgb(244, 244, 244);">
                            <h3 style="margin: 0px; text-align:left; margin-left: 10px; color: black;">
                                {{ item.schedule_leader }}</h3>
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
                            <h5 style="margin: 0px; color: #9A9A9A;">ハイキング一字</h5>
                        </td>
                        <td style="border-right: solid; color: rgb(244, 244, 244);">
                            <h3 style="color: black; margin: 0px; text-align:left; margin-left: 10px;">{{ date }}</h3>
                        </td>
                        <td style="border-right: solid; color: rgb(244, 244, 244);">
                            <h5 style="margin: 0px; color: #9A9A9A;">ハイキング時間</h5>
                        </td>
                        <td>
                            <h3 style="margin: 0px; text-align:left; margin-left: 10px;">{{ time }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="border-right: solid; color: rgb(244, 244, 244);" rowspan="5">
                            <h5 style="margin: 0px; color: #9A9A9A;">募集内容</h5>
                        </td>
                        <td colspan="3" rowspan="5">
                            <h3 style="margin: 0px; text-align:left; margin-left: 10px;">{{
                                item.content
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
                    </tbody>
                </table>
                <button style="float: right; padding: 0; height: 10%;" type="submit" @click="move(item.uuid)" class="btn btn-info btn-fill float-right">
                    <h3 style="font-family: 'Gothic A1', sans-serif; margin: 0; padding: 10px;">グループページへ</h3>
                </button>
            </card>
        </div>
        <div class="col-md-6">
            <card class="ccard" style="margin: 0px;">
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
        data() {
            return {
                item: [],
                date: '',
                time: ''
            }
        },
        created() {
            // this.$EventBus.$emit('eventShowMap', item.mnt_id, item.route);
            this.$EventBus.$on('recordItem', (item) => {
                this.item = item;
                this.date = item.start_date.substring(0, 10);
                this.time = item.start_date.substring(11, 19);
                this.$EventBus.$emit('eventShowMap', item);
            });
        },
        methods: {
            move(uuid)    {
                this.$router.push('/group/' + uuid);
            },
        }
    }
</script>

<style>
    .sweet-modal.is-visible {
        max-width: 100%;
        min-height: 75%;
        border-radius: 15px;
    }

    table.table thead td:not(:nth-child(1)), table.table tbody td:not(:nth-child(1)), table.table thead th:not(:nth-child(1)), table.table tbody th:not(:nth-child(1)), table.table thead td:first-child, table.table tbody td:first-child, table.table thead th:first-child, table.table tbody th:first-child {
        padding: 0 0px;
    }

    .ccard > *:last-child:not(.btn) {
        padding: 0px;
    }
</style>