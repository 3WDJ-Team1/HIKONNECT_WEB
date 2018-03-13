<template>
    <div>
        <mainbar></mainbar>
        <mainbanner style="width: 1140px; height: 200px;"></mainbanner>
        <mainbody style="width: 1140px; height: 600px;"></mainbody>
        <lore style="position: absolute; margin-left: 1000px; margin-top: -870px"></lore>

    </div>

</template>
<script>
    import mainbar from './mainbar.vue'
    import mainbody from './mainbody.vue'
    import mainbanner from './mainbanner.vue'
    import lore     from './lore.vue'


    export default {
        components: {
            'mainbar'   : mainbar,
            'mainbody'  : mainbody,
            'mainbanner': mainbanner,
            'lore'      : lore
        }
    }
</script>