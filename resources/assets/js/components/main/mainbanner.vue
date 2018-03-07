<template>
    <div>
        <img :src="'https://spaceplace.nasa.gov/templates/featured/sun/' + hello" width="200"/>
    </div>
</template>
<script>

    export default {
        data() {
            return {
                hello : 'hello'
            }
        }
    }
</script>