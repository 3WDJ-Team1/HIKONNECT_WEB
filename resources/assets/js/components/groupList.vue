<template>
    <div class="container">
        <list-serch></list-serch>
        <list-card></list-card>
    </div>
</template>

<script>
    import listSerch from './listSerch.vue'
    import listCard from './listCard.vue'

    export default {
        components: {
            'list-serch'    : listSerch,
            'list-card'   : listCard,
        }
    }
</script>