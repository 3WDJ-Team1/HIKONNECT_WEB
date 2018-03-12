<template>
    <div class="container">
        <div class="card" v-for="group_imformation in list">
            <div class="card-header">
                {{ group_imformation.name }}
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            list: {
                type: Array,
                required: true
            }
        }
    }
</script>
