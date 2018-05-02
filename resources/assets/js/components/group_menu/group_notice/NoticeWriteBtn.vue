<!-- 
    @file   NoticeWriteBtn.vue
    @brief  A component of floating write Button
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   error test
 -->
<template>
    <div>
        <!-- @v-btn         floating button for deciding to open modal -->
        <v-btn
            fab
            dark
            class       ="btn--right btn--floating btn--fixed btn--bottom"
            color       ="cyan"
            @click      ="openWriteModal()"
            style       ="margin-bottom: 10%;">
            <v-icon color="white">mode_edit</v-icon>
        </v-btn>
        <!-- @sweet-modal   the modal which have form script for writing notices -->
        <sweet-modal ref="write" blocking>
            <router-view name="form"></router-view>
        </sweet-modal>
    </div>
</template>

<script>
    export default {
        methods : {
            /**
             * @function    openModifyModal
             * @brief       if button is clicked, this is invoked.
             *              the function for opening modal.
             */
            openWriteModal : function() {

                this.$refs.write.open();
                this.$EventBus.$emit('noticeData', {title: '', content: ''});
                this.$EventBus.$emit('modalMode', 'write');
            },

        }
    }
</script>

<style>
</style>