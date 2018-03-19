<template>
    <div class="container">
        <div id="accordion" v-for="information in list">
            <div class="card">
                <div class="card-bodywrapper">
                    <img src="https://pbs.twimg.com/media/DWKZp36VAAA7c4K.jpg:orig" class="onerounded-circle" alt="CinqueTerre" width="304" height="236">
                    <h4 class="twogodogocard-title">{{information.title}}=알림제목
                        <span class="glyphiconglyphicon-menu-down" aria-hidden="true" data-toggle="collapse" data-target=".collapseshow" aria-expanded="true" aria-controls="collapseOne"></span>
                    </h4>
                    <h6 class="card-subtitlemb-2text-mutedthree">3:00PM</h6>
                    <h6 class="card-subtitlemb-2text-mutedfour">작성자</h6>
                    <h6 class="card-subtitlemb-2text-mutedfive">한라산평균산행속도:1.3km/h</h6>
                    <div class="six">
                        <a href="#" class="btnbtn-outline-primary">수락</a>
                        <a href="#" class="btnbtn-outline-secondary">거절</a>
                    </div>
                </div>

                <div class="collapseshow" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        {{information.title}}=알림내용
                    </div>
                </div>
            </div>
        </div>


        <div v-for="information in list">
        <div class="card" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <div class="card-blockwrapper">
                <img src="https://pbs.twimg.com/media/DWKZp36VAAA7c4K.jpg:orig" class="onerounded-circle" alt="CinqueTerre" width="304" height="236">
                <h4 class="twogodogocard-title">{{information.title}}=알림제목</h4>
                <h6 class="card-subtitlemb-2text-mutedthree">3:00PM</h6>
                <h6 class="card-subtitlemb-2text-mutedfour">작성자</h6>
                <h6 class="card-subtitlemb-2text-mutedfive">한라산평균산행속도:1.3km/h</h6>
                <div class="six">
                    <a href="#" class="btnbtn-outline-primary">수락</a>
                    <a href="#" class="btnbtn-outline-secondary">거절</a>
                </div>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="cardcard-block">
                    {{information.title}}=알림내용
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default{
        name:"notice_information",
            props:['list'],
            methods:{
            accept(){
                axios.get('http://localhost:8000/group/0/10')
                //axios.get('http://localhost:8000/group/10000/10')
                    .then(response=>{
                        this.notice_information=response.data;
                    })
            }
        }
    }
</script>

<style scoped>
    .card{
        margin:50px;
    }
    #collapseExample{
        margin:10px;
    }
    .rounded-circle{
        width:100px;
        height:100px;
    }
    .card[data-v-6b25ae02]{
        margin:30px;
    }
    .rounded-circle[data-v-6b25ae02]{
        display:block;
    }
    .wrapper{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        grid-column-gap:10px;
        grid-row-gap:1em;
        grid-auto-rows:minmax(20px,auto);
        margin:0px;
    }
    .one{
        background-color:#5cb85c;
    }
    .two{
        background-color:#2e6da4;
    }
    .three{
        background-color:#5cb85c;
    }
    .four{
        background-color:#5cb85c;
        height:50px;
        margin-bottom:0px;
    }
    .five{
        background-color:#5cb85c;
    }
    .six{
        background-color:#5cb85c;
    }
    .two[data-v-6b25ae02]{
        margin:0px;
    }
    .three[data-v-6b25ae02]{
        margin:0px;
    }
    .four[data-v-6b25ae02]{
        margin:0px;
    }
    .five[data-v-6b25ae02]{
        margin:0px;
    }
    .card[data-v-6b25ae02][data-v-6b25ae02][data-v-6b25ae02]{
        margin:0px;
    }
</style>
