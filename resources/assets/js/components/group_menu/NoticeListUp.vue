<template>
    <!-- the wrapper of notice list -->
    <div class="text-center">
        <!-- show the name of group -->
        <h1>{{ groupName }}</h1>
        <h2>Group notice</h2>
        <br>
        <!-- notice cards are formed automatically by data.notices -->
        <div v-for="notice in notices">
            <!-- the wrapper of notice card -->
            <div class="card_wrapper">
                <b-card img-src="https://via.placeholder.com/650x50"
                        img-alt="Card image"
                        img-top
                        style="position: relative; display: inline-block;"
                        class="text-center"
                        >
                    <h3 class="card-title notice_title">{{ notice.title }}</h3>
                    <p class="card-text notice_writer_hits">writer : {{ notice.writer }} | hits : {{ notice.hits }}</p>
                    <p class="card-text notice_text">
                        {{ notice.text }}
                    </p>
                </b-card>
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
                        title : 'Dump1',
                        writer : 'tester1',
                        hits : 10,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump2',
                        writer : 'tester2',
                        hits : 20,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump3',
                        writer : 'tester3',
                        hits : 30,
                        text : "exampleexampleexampleexampleexampleexampleexampleexampleexampleexampleexampleexampleexampleexampleexampleexample text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    },
                    {
                        title : 'Dump4',
                        writer : 'tester4',
                        hits : 40,
                        text : "Some quick example text to build on the card and make up the bulk of the card's content."
                    }
                ]
            }
        }
    }
</script>

<style>
.card_wrapper {
    display: inline-block;
    margin: 0.3%;
    padding: 0.1%;
    border: 1px solid darkgrey;
    border-radius: 2%;
}
.notice_title {
    position: absolute;
    left: 5%;
    top: -10%;
    color: black;
    font-weight: bold;
}
.notice_writer_hits {
   position: absolute;
    right: 5%;
    top: 12%;
    color: black;
    font-weight: bold; 
}
.notice_text { 
    display: block;
    height: 50px;
    width: 650px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}
</style>