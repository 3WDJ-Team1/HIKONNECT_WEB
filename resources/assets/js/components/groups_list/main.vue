<template>
    <div class="container">
        <list_search></list_search>
        <list_show v-bind:list="groups_list_imformation"></list_show>
    </div>
</template>
<script>

    import { EventBus } from './event_bus.js';
    import Vue from 'vue'
    import list_search from './list_search.vue'
    import list_show from './list_show.vue'

    EventBus.$on('i-got-clicked', clickCount => {
        console.log(`Oh, that's nice. It's gotten ${clickCount} clicks! :)`)
    });

    export default {
        components: {
            'list_search'    :   list_search,
            'list_show'     :   list_show
        },
        data()  {
            return  {
                pageIndex: 0,
                search_imformations: {
                    mountain_name: '',
                    writer: '',
                    date: ''
                },
                groups_list_imformation:    []
            }
        },
        created: function ()
        {
            this.fetchItem();
            window.addEventListener('scroll', this.handleScroll);
            EventBus.$on('input_serch', function (mountain_name, writer, date) {
                this.mountain_name = mountain_name;
                this.writer = writer;
                this.date = date;
            })
        },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        },
        methods: {
            handleScroll() {
                // this.scrolled = window.screenY > 0;
                this.pageIndex += 10;
            },
            fetchItem() {
                axios.get('http://localhost:8000/group', this.pageIndex)
                    .then(response => {
                        // console.log(response.data);
                        this.groups_list_imformation = response.data;
                    })
            }
        }
    }
</script>

<style scoped>

</style>