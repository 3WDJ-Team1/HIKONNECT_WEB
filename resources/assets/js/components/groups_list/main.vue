<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="container">
        <router-view name="header"></router-view>
        <router-view name="body"></router-view>
        <groupMakeButton></groupMakeButton>
    </div>
</template>

<script>
    import groupMakeButton from './groupMakeButton'
    export default {
        components: {
            groupMakeButton
        }
    }
</script>

<style>

</style>