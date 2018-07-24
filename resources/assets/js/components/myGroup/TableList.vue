
<template>
    <div class="content">
        <sweet-modal blocking="true" id="scheduleModal" style="min-width: 1000px;" ref="write">
            <Modal></Modal>
        </sweet-modal>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <card>
                        <template slot="header">
                            <h1 class="card-title" style="font-family: 'Gothic A1', sans-serif;">登山計画</h1>
                        </template>
                        <div class="table-hover">
                            <table class="table" style="text-align:center;">
                                <thead style="padding-top: 0;">
                                <slot name="columns">
                                    <th v-for="column in tableS.columns">
                                        <h4 style="margin: 0; color: #9e9e9e; font-family: 'Gothic A1', sans-serif;">{{column}}</h4></th>
                                </slot>
                                </thead>
                                <tbody>
                                <tr v-for="item in tableS.data" @click="openModal(item)">
                                    <slot :row="item">
                                        <td><h3 style="font-family: 'Gothic A1', sans-serif;">{{ item.group_title }}</h3></td>
                                        <td><h3 style="font-family: 'Gothic A1', sans-serif;">{{ item.title }}</h3></td>
                                        <td style="width: 17%;">
                                            <button style="padding: 0; height: 40px;" type="submit" class="btn btn-info btn-fill float-right" @click="move(item.uuid)">
                                                <h4 style="font-family: 'Gothic A1', sans-serif; margin: 0; padding: 5px;"> ショートカット</h4>
                                            </button>
                                        </td>
                                    </slot>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </card>
                </div>
                <div class="col-6">
                    <card>
                        <template slot="header">
                            <h1 class="card-title" style="font-family: 'Gothic A1', sans-serif;">My Group</h1>
                        </template>
                        <div class="table-hover">
                            <table class="table" style="text-align:center;">
                                <thead style="padding-top: 0;">
                                <slot name="columns">
                                    <th style="font-weight: bold" v-for="column in tableG.columns">
                                        <h4 style="margin: 0; color: #9e9e9e; font-family: 'Gothic A1', sans-serif;">{{column}}</h4></th>
                                </slot>
                                </thead>
                                <tbody>
                                <tr v-for="item in tableG.data">
                                    <slot :row="item">
                                        <td><h3 style="font-family: 'Gothic A1', sans-serif;">{{ item.title }}</h3></td>
                                        <td><h3 style="font-family: 'Gothic A1', sans-serif;">{{ item.leader }}</h3></td>

                                        <td>
                                            <button style="padding: 0; height: 40px;" type="submit" class="btn btn-info btn-fill float-right" @click="move(item.uuid)">
                                                <h4 style="font-family: 'Gothic A1', sans-serif; margin: 0; padding: 5px;"> ショートカット</h4>
                                            </button>
                                        </td>
                                    </slot>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Card from '../Cards/Card.vue'
    import Modal from './schedule_modal'
    export default {
        props: {
            columns: Array,
            data: Array
        },
        components: {
            Card,
            Modal
        },
        data() {
            return {
                tableG: {
                    columns: ['グルーブ名', '作成者', ''],
                    data: []
                },
                tableS: {
                    columns: ['グルーブ名', 'スケジュール名',  ''],
                    data: []
                }
            }
        },
        created() {
            this.mygroup();
            this.myschedule();
        },
        methods: {
            move(uuid)    {
                this.$router.push('/group/' + uuid);
            },
            openModal(item) {
                this.$EventBus.$emit('schedule_modal', item);
                this.$refs.write.open();
            },
            mygroup() {
                this.axios.post(this.$HttpAddr + '/mygroup', {
                    userid: sessionStorage.getItem('userid')
                }).then(response => {
                    if(response.data != 'false')   {
                        this.tableG.data = this.tableG.data.concat(response.data);
                    }
                });
            },
            myschedule()    {
                this.axios.post(this.$HttpAddr + '/myschedule', {
                    userid: sessionStorage.getItem('userid')
                }).then(response => {
                    if(response.data != false)    {
                        this.tableS.data = this.tableS.data.concat(response.data);
                    }
                })
            }
        }
    }
</script>
<style>
    #scheduleModal.is-visible .sweet-buttons, #scheduleModal.is-visible .sweet-content {
        padding-bottom: 0px;
    }
</style>
