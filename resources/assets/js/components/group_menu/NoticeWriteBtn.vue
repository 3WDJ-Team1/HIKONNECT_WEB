<!-- 
    @file   NoticeWriteBtn.vue
    @brief  A component of floating write Button
    @author Sungeun Kang
    @todo   error test
 -->
<template>
    <div>
        <!-- @v-btn         floating button for deciding to open modal -->
        <v-btn
            fab
            dark
            large
            class="btn--bottom btn--floating btn--fixed btn--right"
            color="cyan"
            v-on:click="openWriteModal()">
            <v-icon style="color: white">add</v-icon>
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