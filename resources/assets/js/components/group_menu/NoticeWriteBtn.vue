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
            <router-view name="form" v-bind:propsUuid="uuid"></router-view>
        </sweet-modal>
    </div>
</template>

<script>
    export default {
        data: () => ({
            uuid: ''
        }),
        methods : {
            openWriteModal : function() {
                this.$refs.write.open();
            }
        }
    }
</script>

<style>
</style>