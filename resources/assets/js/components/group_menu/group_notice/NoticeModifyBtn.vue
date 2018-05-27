<!--
    @file   NoticeModifyBtn.vue
    @brief  A component that is an editButton of each notice
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   error test
 -->
<template>
    <!-- @div   A container of this component -->
    <div class='edit_button'>
        <!-- @v-btn         button for deciding to open modal -->
        <v-btn
            style   ="height: 100%;"
            flat
            @click  ="openModifyModal();">
             <v-icon dark>edit</v-icon>&nbsp;edit
        </v-btn>

        <!-- @sweet-modal   a modal which have input form script -->
        <sweet-modal ref="modify" blocking>
            <!-- @router-view   insert component "form" -->
            <router-view name="form"></router-view>
        </sweet-modal>
    </div>
</template>

<script>
    export default {
        /**
         * @prop    propsNotice
         * @brief   the object of selected notice.
         */
        props   : ['propsNotice'],
        methods : {
            /**
             * @function    openModifyModal
             * @brief       if button is clicked, this is invoked.
             *              the function for opening modal.
             */
            openModifyModal : function() {
                this.$refs.modify.open();
                this.$EventBus.$emit('noticeData', this.propsNotice);
                this.$EventBus.$emit('modalMode', 'edit');
            }
        }
    }
</script>

<style>
    .edit_button {
        float: right;
    }
</style>