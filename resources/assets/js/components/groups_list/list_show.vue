<template>
    <div class="container">
        <div class="card" v-for="group_information in list">
            <div class="card-header">
                {{ group_imformation.name }}
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>제목, 목적지, 작성자, 6시간 후, 산행 예정 일자, 최대 인원수, 최소 인원 수, 참여 수</p>
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
