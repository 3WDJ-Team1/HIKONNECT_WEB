<template>
    <group_make v-bind:list="baby"></group_make>
</template>

<script>
    import group_make from './group_make'
    export default {
        name: "group_make_main",
        components: {
            "group_make": group_make
        },
        data()  {
            return {
                baby: {
                    "items": [
                        {"full_name": "팔공산"},
                        {"full_name": "산기적"},
                        {"full_name": "송솔"},
                        {"full_name": "디져라"},
                        {"full_name": "씨부랄"},
                        {"full_name": "개새끼"},
                        {"full_name": "디져라"},
                        {"full_name": "썅"},
                    ]
                }
            }
        }
    }
</script>

<style scoped>

</style>