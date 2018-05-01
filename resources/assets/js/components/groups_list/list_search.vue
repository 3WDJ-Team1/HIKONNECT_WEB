<template>
    <div class="container">
        <div class="box">
            <div class="item">
                <v-select
                        :items="items"
                        label="그룹명"
                        item-value="text"
                        single-line
                        v-model="sel"
                        @input="search()"
                ></v-select>
            </div>
            <div class="item">
                <v-text-field
                        v-if="NameVis"
                        label="그룹명을 입력하시오."
                        v-model="group_name"
                        required>
                </v-text-field>
                <v-text-field
                        v-if="WriterVis"
                        label="작성자를 입력하시오."
                        v-model="writer"
                        required
                ></v-text-field>
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
                    {text: '그룹명'},
                    {text: '작성자'}
                ],
                sel: '',
                NameVis: true,
                WriterVis: false,
                group_name: "",
                writer: "",
                httpAddr: Laravel.host,
            }
        },
        methods: {
            inputSearch()   {
                if (this.sel == '그룹명') {
                    this.send_name();
                } else if (this.sel == '작성자') {
                    this.send_writer();
                }
            },
            search() {
                if (this.sel == '그룹명') {
                    this.NameVis = true;
                    this.WriterVis = false;
                } else if (this.sel == '작성자') {
                    this.NameVis = false;
                    this.WriterVis = true;
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
                this.$EventBus.$emit('input_name','groupname', this.group_name);
            },
            send_writer() {
                this.$EventBus.$emit('input_writer','writer', this.writer);
            },
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

