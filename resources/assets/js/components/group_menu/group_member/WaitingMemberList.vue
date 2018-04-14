<template>
    <div>
        
    </div>
</template>
<script>
    export default {
        data: () => ({
            groupId: '',
            waitingMembers: [],
        }),
        methods: {
            getWaitingMembers() {
                axios.get(this.$HttpAddr + '/appliedUsers/' + this.groupId)
                .then( response => {
                    this.waitingMembers = this.waitingMembers.concat(response.data);
                });
            }
        },
        created() {
            this.groupId = this.$route.params.groupid;
        },
        // watch: {
        //     '$route' (to, from) {
        //         this.groupId = this.$route.params.groupid;
        //     }
        // }
    }
</script>
<style>
</style>