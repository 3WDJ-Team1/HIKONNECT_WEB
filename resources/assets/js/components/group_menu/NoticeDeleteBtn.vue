<!-- NoticeDeleteBtn.vue -->
<template>
    <div class='edit_button'>
        <v-btn style="height: 100%;" flat v-on:click="deleteNotice">
             <v-icon dark>remove</v-icon>&nbsp;delete
        </v-btn>
    </div>
</template>

<script>
    export default {
        data: {
            httpAddr: 'http://hikonnect.ga'
        },
        props: ['propsNotice'],
        methods: {
            deleteNotice: function () {
                axios.delete(this.httpAddr + '/notice/' + this.propsNotice.uuid, {});
            }
        }
    }
</script>

<style>
    .edit_button {
        float: right;
    }
</style>