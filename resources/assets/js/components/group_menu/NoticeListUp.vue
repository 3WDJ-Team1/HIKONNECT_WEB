<template>
    <!-- the wrapper of notice list -->
    <div class="text-center">
        <!-- show the name of group -->
        <h1>{{ groupName }}</h1>
        <h2>Group notice</h2>
        <br>
        <!-- notice div are formed automatically by data.notices -->
        <div v-for="notice in notices">
            <!-- the wrapper of notice card -->
            <div class="card_wrapper">
                <!-- if you click this div, -->
                <div v-b-toggle="'n' + notice.uuid" class="m-1">
                    <h3 class="card-title">{{ notice.title }}</h3>
                    <p class="card-text">writer : {{ notice.writer }} | hits : {{ notice.hits }}</p>
                </div>
                <!-- this will be shown. -->
                <b-collapse v-bind:id="'n' + notice.uuid">
                    <b-card class="notice_text">
                            {{ notice.text }}
                    </b-card>
                </b-collapse>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data : function() {
            return {
                // groupName and notices will be changed by http response. (now there're dump data)
                groupName : "3WDJ-Team1",
                notices : [
                    // the type of notices is 'object' certainly.
                    {
                        uuid : '1',
                        title : 'Dump1',
                        writer : 'tester1',
                        hits : 10,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        uuid : '2',
                        title : 'Dump2',
                        writer : 'tester2',
                        hits : 20,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        uuid : '3',
                        title : 'Dump3',
                        writer : 'tester3',
                        hits : 30,
                        text : "exampleexampleexampleexampleexampleexampleexampleexampleexampleexampleexample exampleexampleexampleexampleexample text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        uuid : '4',
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    }
                ],
            }
        }
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
    word-break: keep-all;
}
</style>