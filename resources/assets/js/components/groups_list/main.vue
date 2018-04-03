<template>
    <div class="container">
        <!--<header></header>-->
            <!--<body v-bind:list="groups_list_imformation.groupInformations"></body>-->
        <router-view name="header"></router-view>
        <router-view name="body"></router-view>
    </div>
</template>

<script>
    export default {

    }
</script>

<style>

</style>