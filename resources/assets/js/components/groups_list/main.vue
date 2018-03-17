<template>
    <div class="container">
        <list_search></list_search>
        <vue-data-loading :loading=false :listens="['pull-down', 'infinite-scroll']" @infinite-scroll="handleScroll" @pull-down="handleScroll">
            <list_show v-bind:list="groups_list_imformation.groupInformations"></list_show>
        </vue-data-loading></div>
</template>
<script>
    import Vue from 'vue'
    import VueDataLoading from 'vue-data-loading'
    import { EventBus } from './event_bus.js';
    import list_search from './list_search.vue'
    import list_show from './list_show.vue'

    export default {
        components: {
            VueDataLoading,
            'list_search'    :   list_search,
            'list_show'     :   list_show
        },
        data()  {
            return  {
                pageIndex: 0,
                loading: true,
                search_imformations: {
                    mountain_name: '',
                    writer: '',
                    date: ''
                },
                groups_list_imformation:{}
            }
        },
        created: function ()
        {
            this.fetchItem();
            EventBus.$on('input_serch', function (mountain_name, writer, date) {
                this.mountain_name = mountain_name;
                this.writer = writer;
                this.date = date;
            });
        },
        methods: {
            handleScroll() {
                console.log('dfasdfasdf');
                // this.pageIndex += 10;
                // this.fetchItem();
            },
            fetchItem() {
                axios.get('http://localhost:8000/group/'+ this.pageIndex + '/10')
                //axios.get('http://localhost:8000/group/10000/10')
                    .then(response => {
                        this.groups_list_imformation = response.data;
                    })
                    .catch(error => {
                        console.log('asdfasdfadfsdfsdfdsfsdf');
                        this.loading = false;
                    })
            }
        }
    }
</script>

<style scoped>

</style>