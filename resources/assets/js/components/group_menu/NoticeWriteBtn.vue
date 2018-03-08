<!-- NoticeWriteBtn.vue -->
<template>
    <div>
        <v-btn
            fab
            dark
            large
            class="btn--bottom btn--floating btn--fixed btn--right"
            color="cyan"
            v-on:click="openWriteModal()">
            <v-icon style="color: white">add</v-icon>
        </v-btn>
        <sweet-modal ref="write" blocking>
            <router-view name="form"></router-view>
        </sweet-modal>
    </div>
</template>

<script>
    export default {
        methods : {
            openWriteModal : function() {
                this.$refs.write.open();
                this.$EventBus.$emit('noticeData', {title: '', content: ''});
            },

        }
    }
</script>

<style>
</style>