<template>
    <div class="container">
        <div class="box">
            <div class="item">
                <v-select
                        :items="items"
                        label="목적지"
                        item-value="text"
                        single-line
                        v-model="sel"
                        @input="search()"
                ></v-select>
            </div>
            <div class="item">
                <v-text-field
                        v-if="DestinationVis"
                        label="산이름(목적지)를 입력하시오."
                        v-model="mountain_name"
                        required>
                </v-text-field>
                <v-text-field
                        v-if="WriterVis"
                        label="작성자를 입력하시오."
                        v-model="writer"
                        required
                ></v-text-field>
                <div v-if="DateVis">
                    <div id="calBox">
                        <datetime v-model='date' placeholder='산행일자를 선택하시오.*'></datetime>
                    </div>
                </div>
            </div>
            <div class="item">
                <div>
                    <v-btn depressed @click="inputSearch" color="primary">SEARCH</v-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [
                    {text: '목적지'},
                    {text: '작성자'},
                    {text: '산행일자'}
                ],
                sel: '',
                DestinationVis: true,
                WriterVis: false,
                DateVis: false,
                mountain_name: "",
                writer: "",
                date: "",
                httpAddr: Laravel.host,
            }
        },
        methods: {
            inputSearch()   {
                if (this.sel == '목적지') {
                    this.send_name();
                } else if (this.sel == '작성자') {
                    this.send_writer();
                } else if (this.sel == '산행일자') {
                    this.send_date();
                }
            },
            search() {
                if (this.sel == '목적지') {
                    this.DestinationVis = true;
                    this.WriterVis = false;
                    this.DateVis = false
                } else if (this.sel == '작성자') {
                    this.DestinationVis = false;
                    this.WriterVis = true;
                    this.DateVis = false
                } else if (this.sel == '산행일자') {
                    this.DestinationVis = false;
                    this.WriterVis = false;
                    this.DateVis = true
                }
            },
            cal() {
                alert('dfdf');
            },
            make_group_button() {
                if (sessionStorage.userid == undefined) {
                    alert('로그인 이후 이용가능합니다.')
                } else {
                    this.$router.push('make');
                }
            },
            send_name() {
                this.$EventBus.$emit('input_name', this.mountain_name);
            },
            send_writer() {
                this.$EventBus.$emit('input_writer', this.writer);
            },
            send_date() {
                this.$EventBus.$emit('input_date', this.date);
            }
        }
    }
</script>
<style>
    .box {
        display: flex;
    }
    .item {
        flex-grow: 1;
    }

    .item:nth-child(1) {
        flex-basis: 80px;
    }

    .item:nth-child(2) {
        flex-grow: 4;
    }
    .item:nth-child(3) {
        flex-grow: 0;
        margin-left: 10px;
    }
    .input-group {
        padding: 0px;
    }

    .input-group--text-field label {
        top: 0px;
    }

    #calBox {
        font-size: 16px;
        padding-bottom: 3px;
        margin-top: 3px;
        font-weight: bold;
        border-bottom: solid 1px darkgrey;
    }
    .btn__content {
        padding-bottom: 13px;
    }
    .application .theme--light.btn:not(.btn--icon):not(.btn--flat), .theme--light .btn:not(.btn--icon):not(.btn--flat)
    {
        margin: 0px;
    }
</style>

