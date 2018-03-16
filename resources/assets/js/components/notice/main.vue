<template>
    <notice_information v-bind:list="notice_information.groupInformations"></notice_information>
</template>

<script>
    import notice_information from './notice_information'
    export default {
        name: "notice_main",
        components: {
          'notice_information': notice_information
        },
        data()  {
            return  {
                notice_information:{}
            }
        },
        created: function ()
        {
            this.fetchItem();
        },
        methods: {
            fetchItem() {
                axios.get('http://localhost:8000/group/0/10')
                //axios.get('http://localhost:8000/group/10000/10')
                    .then(response => {
                        this.notice_information = response.data;
                    })
            }
        }
    }
</script>

<style scoped>

</style>