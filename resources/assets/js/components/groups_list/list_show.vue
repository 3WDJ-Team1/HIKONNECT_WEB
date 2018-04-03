<template>
    <div class="container">
        <div class="card" v-for="group_information in list">
            <div class="card-header">
                {{ group_information.title }}
            </div>
            <div class="card-body">
                <p>{{ group_information.owner }} = 작성자</p>
                <p>{{ group_information.end_point }} = 목적지</p>
                <p>{{ group_information.startdate }} = 산행일자 </p>
                <p>{{ group_information.min_members }} = 최소인원수</p>
                <p>{{ group_information.max_members }} = 최대인원수</p>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        data() {
            return {
                search_imformations: {
                    mountain_name: '',
                    writer: '',
                    date: ''
                },
                list_num    : 0,
                list        : [],
            };
        },
        created: function ()
        {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            EventBus.$on('input_serch', function (mountain, write, date) {
                this.mountain_para =  mountain;
                this.writer = write;
                this.date = date;
            });
        },
        methods: {
            infiniteHandler($state) {
                let url = this.$HttpAddr + '/group/' + this.list_num + '/10'
                axios.get(url).then(response => {
                    if(response)    {
                        this.list = this.list.concat(response.data.groupInformations);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                });
                this.list_num += 10;
            }
        },
        components: {
            InfiniteLoading,
        },
    }
</script>
