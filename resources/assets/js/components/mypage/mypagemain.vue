<template>
    <div>
    <history></history>
    <modify></modify>
    <rank></rank>
    </div>
</template>
<script>
    import modify from './modify.vue';
    import rank from './rank.vue';
    import history from './history.vue';
    export default {
        components: {
            'modify' : modify,
            'rank' : rank,
            'history' : history

        }
    }
</script>