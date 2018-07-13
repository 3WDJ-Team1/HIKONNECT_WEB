<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div style="height: 120px; margin: auto; width: 95%; background-color: white; box-shadow: 5px 5px 10px 1px #cecece;">
        <div class="row" style="padding-top: 38px; width: 95%; margin: auto;" id="serchContainer" >
            <div class="col-md-2">
                <b-form-select v-model="sel" style="border-color:#24b674; border-width: 2px;" class="mb-3">
                    <option value="groupname">グルーブ名</option>
                    <option value="writer">作成者</option>
                </b-form-select>
            </div>
            <div class="col-md-8">
                <fg-input type="text"
                          @keyup.enter.native="inputSearch"
                          placeholder="検索語を入力してください"
                          v-model="inputForm">
                </fg-input>
            </div>

            <div class="col-md-2">
                <button class="btn btn-default btn-block" style="border-color:#24b674; background-color: #24b67470; height: 50px; padding: 0;" @click="inputSearch">
                    <img src="http://localhost:8000/images/search.png" width="30" alt="">
                </button>
            </div>
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
                    alert('ログインしてください。')
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
        margin-top: 0;
    }

    .col-md-2 {
        padding-left: 7px;
    }
</style>

