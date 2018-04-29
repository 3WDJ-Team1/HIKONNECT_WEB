<template>
    <div class="container">
        <v-tabs
                color="cyan"
                dark
                slider-color="yellow"
        >
            <v-tab
                    v-for="item in items"
                    :key="item.title"
                    ripple
            >
                {{ item.title }}
            </v-tab>
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <b-input-group>
                            <b-form-input
                                    v-model="mountain_name"
                                    placeholder="산이름"></b-form-input>
                            <b-input-group-append>
                                <b-btn variant="outline-success" @click="send_name()">
                                        <span
                                                class="glyphicon glyphicon-search"
                                                aria-hidden="true">
                                        </span>
                                </b-btn>
                            </b-input-group-append>
                        </b-input-group>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <b-input-group>
                            <b-form-input
                                    v-model="writer"
                                    placeholder="작성자"></b-form-input>
                            <b-input-group-append>
                                <b-btn variant="outline-success" @click="send_writer()">
                                        <span
                                                class="glyphicon glyphicon-search"
                                                aria-hidden="true">
                                        </span>
                                </b-btn>
                            </b-input-group-append>
                        </b-input-group>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <div style="border: 3px solid #777777; width: 15%;">
                            <datetime style="margin: 5px" v-model="date" placeholder="산행일자"></datetime>
                        </div>
                        <button
                                type="button"
                                class="btn btn-secondary btn-lg"
                                @click="send_date()">
                                <span
                                        class="glyphicon glyphicon-search"
                                        aria-hidden="true">
                                </span>
                        </button>
                    </v-card-text>
                </v-card>
            </v-tab-item>
        </v-tabs>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                mountain_name: "",
                writer: "",
                date: "",
                httpAddr: Laravel.host,
                items: [
                    {title: 'DESTINATION'},
                    {title: 'WRITER'},
                    {title: 'DATE'}
                ]
            }
        },
        methods: {
            make_group_button() {
                if (sessionStorage.userid == undefined) {
                    alert('로그인 이후 이용가능합니다.')
                } else {
                    this.$router.push('make');
                }
            },
            send_name() {
                this.$EventBus.$emit('input_name', "name", this.mountain_name);
            },
            send_writer() {
                this.$EventBus.$emit('input_writer', "writer", this.writer);
            },
            send_date() {
                this.$EventBus.$emit('input_date', "date", this.date);
            }
        }
    }
</script>
<style>
</style>

