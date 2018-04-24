<template>
    <div>
        <vue-modaltor  :visible="open" @hide="hideModal">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </vue-modaltor>
        <b-btn @click="open=true">modal-basic</b-btn>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                open: false
            }
        },
        methods: {
            hideModal() {
                this.open = false;
            }
        }
    }
</script>

<!-- import CSS through SCSS or Link to compiled CSS whichever you prefer -->
<!-- or use your own custom styles! -->
<style>
    /* ... */
</style>