<template>
    <div class="container">
        <div class="card" v-for="information in list" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <div class="card-block wrapper">
                <img src="https://pbs.twimg.com/media/DWKZp36VAAA7c4K.jpg:orig" class="one rounded-circle" alt="Cinque Terre" width="304" height="236">
                <h4 class="two godogo card-title">{{ information.title }} = 알림 제목</h4>
                <h6 class="card-subtitle mb-2 text-muted three">3:00 PM</h6>
                <h6 class="card-subtitle mb-2 text-muted four">작성자</h6>
                <h6 class="card-subtitle mb-2 text-muted five">한라산 평균 산행 속도: 1.3km/h</h6>
                <div class="six">
                    <a href="#" class="btn btn-outline-primary">수 락</a>
                    <a href="#" class="btn btn-outline-secondary">거 절</a>
                </div>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="card card-block">
                    {{ information.title }} = 알림 내용
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "notice_information",
        props: ['list']
    }
</script>

<style scoped>
    .card   {
        margin: 50px;
    }
    #collapseExample   {
        margin: 10px;
    }
    .rounded-circle {
        width: 100px;
        height: 100px;
    }
    .card[data-v-6b25ae02]  {
        margin: 30px;
    }
    .rounded-circle[data-v-6b25ae02]    {
        display: block;
    }
    .wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: minmax(100px, auto);
    }
    .one {
        background-color: #5cb85c;
    }
    .two {
        background-color: #2e6da4;
    }
    .three {
        background-color: #5cb85c;
    }
    .four {
        background-color: #5cb85c;
        height: 50px;
        margin-bottom: 0px;
    }
    .five {
        background-color: #5cb85c;
    }
    .six    {
        background-color: #5cb85c;
    }
</style>