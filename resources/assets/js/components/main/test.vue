<template>
    <div>
        <button v-on:click="kk">s</button>
    </div>
</template>
<script>
    export default {
        methods: {
            kk() {
                alert(sessionStorage.getItem("userid"));
            }
        }
    }
</script>