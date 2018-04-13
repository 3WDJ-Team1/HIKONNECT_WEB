<template>
    <div class="container">
        <div class="serch_option">
            <ul>
                <li>
                    <div class="card card-body">
                        <input type="text" class="form-control" v-model="mountain_name" placeholder="산이름" aria-label="산이름" aria-describedby="basic-addon2">
                    </div>
                </li>
                <li>
                    <div class="card card-body">
                        <input type="text" class="form-control" v-model="writer" placeholder="작성자" aria-label=작성자 aria-describedby="basic-addon2">
                    </div>
                </li>
                <li>
                    <datetime v-model="date" placeholder="산행일자"></datetime>
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                </li>
                <li>
                    <button type="button" class="btn btn-secondary btn-lg" v-on:click="send_serch()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </li>
            </ul>
        </div>
        <b-button href="http://localhost:8000/#/make">그룹 만들기</b-button>
    </div>
</template>

<script>
    import { EventBus } from './event_bus'
    export default {

        data()  {
            return  {

                mountain_name: "",
                writer: "",
                date: ""
            }
        },
        methods:    {
            send_serch() {
                EventBus.$emit('input_serch', this.mountain_name, this.writer, this.date);
            }
        }
    }
</script>
<style>
    /* .input-group > .input-group-prepend > .btn, .input-group > .input-group-prepend > .input-group-text, .input-group > .input-group-append:not(:last-child) > .btn, .input-group > .input-group-append:not(:last-child) > .input-group-text, .input-group > .input-group-append:last-child > .btn:not(:last-child):not(.dropdown-toggle), .input-group > .input-group-append:last-child > .input-group-text:not(:last-child)   {
        padding-right: 20px;
    }
    .serch_option  {
        background-color: #ccd0d2;
    }
    ul  {
        list-style:none;
    }
    li  {
        float: left;
    }
     .dropdown-menu a  {
         height: 400px;
         font-size: 12px;
         display: inline;
     } */
</style>

