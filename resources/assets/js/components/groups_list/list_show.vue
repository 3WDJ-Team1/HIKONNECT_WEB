<template>
    <div class="container">
        <div class="card" v-for="group_information in list">
            <div class="card-header">
                {{ group_information.title }}
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{ group_information.owner }} = 작성자</p>
                    <p>{{ group_information.end_point }} = 목적지</p>
                    <p>{{ group_information.startdate }} = 산행일자 </p>
                    <p>{{ group_information.min_members }} = 최소인원수</p>
                    <p>{{ group_information.max_members }} = 최대인원수</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['list']
    }
</script>
