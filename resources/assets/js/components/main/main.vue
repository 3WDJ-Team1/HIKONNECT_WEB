<template>
    <div>
        <mainbar></mainbar>
        <mainbanner></mainbanner>
        <mainbody></mainbody>

    </div>
</template>
<script>
    import mainbar from './mainbar.vue'
    import mainbody from './mainbody.vue'
    import mainbanner from './mainbanner.vue'


    export default {
        components: {
            'mainbar'   : mainbar,
            'mainbody'  : mainbody,
            'mainbanner': mainbanner
        }
    }
</script>