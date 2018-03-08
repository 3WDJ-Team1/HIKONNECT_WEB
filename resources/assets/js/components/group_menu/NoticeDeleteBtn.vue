<!-- NoticeDeleteBtn.vue -->
<template>
    <div class='edit_button'>
        <v-btn style="height: 100%;" flat>
             <v-icon dark>remove</v-icon>&nbsp;delete
        </v-btn>
    </div>
</template>

<script>
    export default {
        props :['propsUuid'],
    }
</script>

<style>
    .edit_button {
        float: right;
    }
</style>