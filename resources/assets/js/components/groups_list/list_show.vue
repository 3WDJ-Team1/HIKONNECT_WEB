<template>
    <div class="container">
        <div class="card" v-for="group_information in list">
            <div class="card-header">
                {{ group_information.title }}
            </div>
            <div class="card-body">
                <p>{{ group_information.owner }} = 작성자</p>
            </div>
            <b-button style="width: 20em" href="http://localhost:8000/#/make">그룹페이지로 이동</b-button>
            <b-button style="width: 80px" href="#">등산 참가</b-button>
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
            this.$EventBus.$on('input_serch', function (mountain, write, date) {
                this.mountain_para =  mountain;
                this.writer = write;
                this.date = date;
            });
        },
        methods: {
            infiniteHandler($state) {
                let url = this.$HttpAddr + '/hiking_group/' + this.list_num + '/10'
                axios.get(url).then(response => {
                    if(response)    {
                        this.list = this.list.concat(response.data);
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
