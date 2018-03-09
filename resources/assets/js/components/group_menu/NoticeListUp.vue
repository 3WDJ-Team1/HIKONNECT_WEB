<template>
    <!-- the wrapper of notice list -->
    <div class="text-center" id="group_notice">
        <!-- show the name of group -->
        <h1>{{ groupName }}</h1>
        <h2>Group notice</h2>
        <br>
        <router-view name="write"></router-view>
        <!-- Use infinite scroll for pagination -->
        <div>
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
        <pulse-loader></pulse-loader>
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
            page: 1,
            size: 5,
            bottom: false,
            httpAddr: 'http://hikonnect.ga',
            loader: {

            }
        }),
        created() {
            window.addEventListener('scroll', () => {
                this.bottom = this.bottomVisible()
                console.log(window.scrollY + ', ' + document.documentElement.scrollHeight+ ',' +document.documentElement.clientHeight)
            });
            axios.get(this.httpAddr + '/notice/0/10')
                .then(response => { this.notices = response.data });
        },
        methods: {
            bottomVisible: function () {
                const scrollY = window.scrollY;
                const visible = document.documentElement.clientHeight;
                const pageHeight = document.documentElement.scrollHeight;
                const bottomOfPage = visible + scrollY + 1 >= pageHeight
                return bottomOfPage || pageHeight < visible
            },
            addNotices() {
                let url = this.httpAddr + '/notice/' + ((this.page - 1) * this.size + 10) + '/' + ((this.page + 1) * this.size + 10);
                axios.get(url)
                .then(response => {
                    for (let i = 0 ; i < this.size ; i++) {
                        this.notices.push(response.data[i]);
                    }
                });
                this.page++;
            }
        },
        watch: {
            bottom(bottom) {
                if (bottom) {
                    this.addNotices();
                }
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
    margin: 0 auto;
    word-break: keep-all;
}
</style>