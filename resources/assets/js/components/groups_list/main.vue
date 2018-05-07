<template>
    <div class="container">
        <router-view name="header"></router-view>
        <router-view name="body"></router-view>
        <v-btn
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                @click="openWriteModal()"
        >
            <v-icon>add</v-icon>
        </v-btn>
        <sweet-modal ref="write" blocking>
            <router-view name="make"></router-view>
        </sweet-modal>
    </div>
</template>

<script>
    export default {
        methods: {
            openWriteModal() {
                this.$refs.write.open();
            }
        }
    }
</script>

<style>

</style>