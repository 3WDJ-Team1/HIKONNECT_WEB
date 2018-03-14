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
                search_imformations: {
                    mountain_name: '',
                    writer: '',
                    date: ''
                },
                items: [],
                groups_list_imformation:    [
                    {name: '1'},
                    {name: '2'},
                    {name: '3'},
                    {name: '4'},
                    {name: '5'},
                    {name: '6'},
                    {name: '7'}
                ]
            }
        },
        created: function ()
        {
            window.addEventListener('scroll', this.handleScroll);
            EventBus.$on('input_serch', function (mountain_name, writer, date) {
                this.mountain_name = mountain_name;
                this.writer = writer;
                this.date = date;
            })
            // this.fetchItems();
        },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        },
        methods: {
            handleScroll () {
                this.scrolled = window.screenY > 0;
            }
        },
        fetchItem()
        {
            this.axios.post('http://localhost:8000/list')
                .then(response => {
                    // console.log(response.data);
                    this.items = response.data;
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    }
</script>

<style scoped>

</style>