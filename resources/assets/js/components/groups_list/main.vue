<template>
    <div class="container">
        <list_serch></list_serch>
        <list_show v-bind:list="groups_list_imformation"></list_show>
    </div>
</template>

<script>

    import list_serch from './list_serch'
    import list_show from './list_show'

    export default {
        components: {
            'list_serch'    :   list_serch,
            'list_show'     :   list_show
        },
        data()  {
            return  {
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
            // this.fetchItems();
        },
        method: {
            fetchItem()
            {
                this.axios.post('http://localhost:8000/list')
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            }
        }
    }
</script>

<style scoped>

</style>