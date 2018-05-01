<template>
    <div>
        <router-view v-if="listEventB" name="item"></router-view>
        <router-view v-if="makeEventB" name="make"></router-view>
        <v-btn
                style="margin-bottom: 10%;"
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                @click="makeEvent"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "plan_main",
        data() {
            return {
                listEventB: true,
                makeEventB: false,
            }
        },
        created() {
            this.$EventBus.$on('makeEventOK', (sign) => {
                if (sign == true) {
                    listEventB = true;
                    makeEventB = false;
                }
            })
        },
        methods: {
            makeEvent() {
                this.makeEventB = true;
                this.listEventB = false;
            }
        }
    }
</script>

<style scoped>

</style>