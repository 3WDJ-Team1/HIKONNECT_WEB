<template>
    <!-- the wrapper of notice list -->
    <div class="text-center" id="group_notice">
        <!-- show the name of group -->
        <h1>{{ groupName }}</h1>
        <h2>Group notice</h2>
        <br>
        <router-view name="write"></router-view>
        <!-- notice div are formed automatically by data.notices -->
        <div v-for="notice in notices">
            <!-- the wrapper of notice card -->
            <div class="card_wrapper">
                <!-- if you click this div, -->
                <div v-b-toggle="'n' + notice.uuid" class="m-1">
                    <h3 class="card-title">{{ notice.title }}</h3>
                    <p class="card-text">writer : {{ notice.nickname }} | hits : {{ notice.hits }}</p>
                   
                </div>
                <!-- this will be shown. -->
                <b-collapse v-bind:id="'n' + notice.uuid">
                    <div class="notice_text">
                        {{ notice.content }}
                    </div>
                    <!-- send notice.uuid to children components -->
                    <router-view name="delete" v-bind:propsNotice="notice"></router-view>
                    <router-view name="modify" v-bind:propsNotice="notice"></router-view>
                </b-collapse>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : ()  => ({
                // groupName and notices will be changed by http response. (now there're dump data)
                groupName : "3WDJ-Team1",
                notices : [
                    // the type of notices is 'object' certainly.
                ],
        }),
        beforeMount() {
            // get object of notice information
            axios.get('http://localhost:8000/notice/0/5')
                .then(response => {console.log(response); this.notices = response.data});
        },
    }
</script>

<style>
/* class for card wrapper */
.card_wrapper {
    display: inline-block;
    width: 100%;
    margin: 0.3%;
    padding: 0.1%;
    border: 1px solid darkgrey;
    border-radius: 2%;
    background-color: white;
}
/* class for inner text of notice cards */
.notice_text {
    width: 90%;
    margin: 0 auto;
    word-break: keep-all;
}
</style>