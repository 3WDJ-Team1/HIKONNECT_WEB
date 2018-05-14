<template>
    <div class="content">
        <sweet-modal ref="write" blocking>
            <Modal></Modal>
        </sweet-modal>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <card>
                        <template slot="header">
                            <h4 class="card-title">내가 소속된 등산 계획</h4>
                        </template>
                        <div class="table-hover">
                            <table class="table">
                                <thead>
                                <slot name="columns">
                                    <th v-for="column in tableS.columns">{{column}}</th>
                                </slot>
                                </thead>
                                <tbody>
                                <tr v-for="item in tableS.data" @click="openModal(item)">
                                    <slot :row="item">
                                        <td>{{ item.group_title }}</td>
                                        <td>{{ item.group_leader }}</td>
                                        <td>{{ item.title }}</td>
                                        <td>{{ item.start_date }}</td>
                                        <td></td>
                                    </slot>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </card>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <card>
                        <template slot="header">
                            <h4 class="card-title">내가 소속된 그룹</h4>
                        </template>
                        <div class="table-hover">
                            <table class="table">
                                <thead>
                                <slot name="columns">
                                    <th v-for="column in tableG.columns">{{column}}</th>
                                </slot>
                                </thead>
                                <tbody>
                                <tr v-for="item in tableG.data" @click="move(item.uuid)">
                                    <slot :row="item">
                                        <td>{{ item.title }}</td>
                                        <td></td>
                                        <td>{{ item.nickname }}</td>
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
                    columns: ['그룹 이름', '', '작성자'],
                    data: []
                },
                tableS: {
                    columns: ['그룹 이름', '그룹 관리자', '일정 이름', '산행날짜'],
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
                this.axios.post('http://172.26.2.88:8000/api/mygroup', {
                    userid: sessionStorage.getItem('userid')
                }).then(response => {
                    this.tableG.data = this.tableG.data.concat(response.data);
                });
            },
            myschedule()    {
                this.axios.post('http://172.26.2.88:8000/api/myschedule', {
                    userid: sessionStorage.getItem('userid')
                }).then(response => {
                    console.log(response.data)
                    this.tableS.data = this.tableS.data.concat(response.data);
                })
            }
        }
    }
</script>
<style>
</style>
