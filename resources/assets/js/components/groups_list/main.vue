<template>
    <div class="container">
        <!--<header></header>-->
        <!--<body v-bind:list="groups_list_imformation.groupInformations"></body>-->
        <router-view name="header"></router-view>
        <router-view name="body"></router-view>
        <v-btn
                style="margin-bottom: 5%;"
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                @click="make_group_button"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        methods: {
            make_group_button() {
                if (sessionStorage.userid == undefined) {
                    alert('로그인 이후 이용가능합니다.')
                } else {
                    this.$router.push('make');
                }
            }
        }
    }
</script>

<style>

</style>