<template>
    <div>
        <mainbar></mainbar>
        <mainbody></mainbody>
    </div>
</template>
<script>
    import mainbar from './mainbar.vue'
    import mainbody from './mainbody.vue'


    export default {
        components: {
            'mainbar'   : mainbar,
            'mainbody'  : mainbody
        }
    }
</script>