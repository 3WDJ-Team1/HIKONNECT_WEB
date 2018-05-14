<template>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <b-form-select v-model="sel" class="mb-3">
                    <option value="그룹명">그룹명</option>
                    <option value="작성자">작성자</option>
                </b-form-select>
            </div>
            <div class="col-md-8">
                <fg-input type="text"
                          placeholder="검색어를 입력하시오."
                          v-model="inputForm">
                </fg-input>
            </div>
            <div class="col-md-2">
                <button class="btn btn-default btn-block" @click="inputSearch">SEARCH</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                sel: '그룹명',
                inputForm: ""
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
    select.form-control:not([size]):not([multiple]) {
        height: 40px;
    }
    .row {
        margin-right: 20px;
        margin-left: 20px;
    }
    .col-md-2 {
        padding-right: 0px;
    }
    .col-md-8 {
        padding-right: 0px;
    }
    .btn:not(:disabled):not(.disabled) {
        margin-top: 2px;
    }
    .col-md-2 {
        padding-left: 7px;
    }
</style>

