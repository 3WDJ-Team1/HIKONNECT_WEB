<!--
    @file   NoticeDeleteBtn.vue
    @brief  A component that is a deleteButton of each notice
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   error test
 -->
<template>
    <!-- @div   A container of this component -->
    <div class='edit_button'>
        <!-- @v-btn     button for invoking delete function -->
        <v-btn style="height: 100%;" flat @click="deleteNotice">
             <v-icon dark>remove</v-icon>&nbsp;delete
        </v-btn>

    </div>
</template>

<script>
    export default {
        data: () => ({

        }),
        /**
         * @prop    propsNotice
         * @brief   the object of selected notice.
         */
        props   : ['propsNotice'],
        methods : {
            /**
             * @function    deleteNotice
             * @brief       if button is clicked, send http request.
             */
            deleteNotice() {
                axios.delete(this.$HttpAddr + '/notice',  {
                    uuid: this.propsNotice.uuid
                });
                this.$router.push('/group/' + this.groupId);
            }
        }
    }
</script>

<style>
    .edit_button {
        float: right;
    }
</style>