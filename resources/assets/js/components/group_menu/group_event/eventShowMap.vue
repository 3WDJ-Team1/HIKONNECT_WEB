<template>
    <div>
        지도 보여줄라꼬
    </div>
</template>

<script>
    export default {
        name: "event-show-map",
        created()   {
            this.$EventBus.$on('eventShowMap', (code, route) => {
            });
        }
    }
</script>

<style scoped>

</style>