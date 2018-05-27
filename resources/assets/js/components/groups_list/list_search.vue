
<template>
    <div class="row" id="serchContainer">
        <div class="col-md-2">
            <b-form-select v-model="sel" class="mb-3">
                <option value="groupname">그룹명</option>
                <option value="writer">작성자</option>
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
</template>

<script>
    export default {
        data() {
            return {
                sel: 'groupname',
                inputForm: ""
            }
        },
        methods: {
            inputSearch() {
                this.$EventBus.$emit('groupListSearch', this.sel, this.inputForm);
            },
            make_group_button() {
                if (sessionStorage.userid == undefined) {
                    alert('로그인 이후 이용가능합니다.')
                } else {
                    this.$router.push('make');
                }
            }
        }
    }
</script>
<style>
    select.form-control:not([size]):not([multiple]) {
        height: 40px;
    }

    #serchContainer {
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

