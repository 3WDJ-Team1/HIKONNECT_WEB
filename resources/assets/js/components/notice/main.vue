<template>
    <router-view name="body" v-bind:list="notice_information.groupInformations"></router-view>
</template>

<script>
    export default {
        name: "notice_main",
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
                axios.get('http://localhost:8000/group/store')
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