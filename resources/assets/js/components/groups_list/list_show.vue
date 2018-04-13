<template>
    <v-container>
        <div class="card" v-for="item in list" :key="item.owner">
            <div class="card-header">
                <h4 class="title inlineBlocks">{{ item.title }}(n/{{ item.max_members }})</h4>
                <div class="min_members inlineBlocks">최소인원수: {{ item.min_members }}</div>
                <div class="max_members inlineBlocks">최대인원수: {{ item.max_members }}</div>
            </div>
            <div class="card-body">
                {{ item.owner }}
                <div class="end_point inlineBlocks">목적지: {{ item.end_point }}</div>
                <div class="startdate inlineBlocks">산행일자: {{ item.startdate }}</div>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </v-container>
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
                HttpAddr    : "http://localhost:8000",
            };
        },
        created()
        {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            this.$EventBus.$on('input_serch', (mountain, write, date) => {
                this.mountain_para =  mountain;
                this.writer = write;
                this.date = date;
            });
        },
        methods: {
            infiniteHandler($state) {
                let url = this.HttpAddr + '/group/index/' + this.list_num
                axios.get(url).then(response => {
                    if(response) {
                        for(let i = 0 ; i < 10 ; i++) {
                            this.list.push({
                                title: response.data.groupInformations[i].title,
                                owner: response.data.writers[i].nickname,
                                end_point: response.data.groupInformations[i].end_point,
                                startdate: response.data.groupInformations[i].start_date,
                                min_members: response.data.groupInformations[i].min_members,
                                max_members: response.data.groupInformations[i].max_members
                            });
                        }
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
<style>
    .inlineBlocks {
        display: inline-block; 
    }
    .min_members {
        margin-left: 55%;
    }
    .max_members {
        align-self: flex-end;
        margin-left: 3%;
    }
</style>
