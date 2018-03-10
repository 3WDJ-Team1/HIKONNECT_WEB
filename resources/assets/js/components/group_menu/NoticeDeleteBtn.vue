<!-- 
    @file   NoticeDeleteBtn.vue
    @brief  A component that is a deleteButton of each notice
    @author Sungeun Kang
    @todo   error test
 -->
<template>
    <!-- @div   A container of this component -->
    <div class='edit_button'>
        <!-- @v-btn     button for invoking delete function -->
        <v-btn style="height: 100%;" flat v-on:click="deleteNotice">
             <v-icon dark>remove</v-icon>&nbsp;delete
        </v-btn>
    </div>
</template>

<script>
    export default {
        data: () => ({
            /**
             * httpAddr     (String)        the address for axios request
             */
            httpAddr: 'http://localhost:8000'
        }),
        /**
         * @prop    propsNotice
         * @brief   the object of selected notice.
         */
        props: ['propsNotice'],
        methods: {
            /**
             * @function    deleteNotice
             * @brief       if button is clicked, send http request.
             */
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