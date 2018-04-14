<template>
    <v-container>
        <div class="card" v-for="item in list" :key="item.owner">
            <div class="card-header">
                <h4 class="title inlineBlocks">{{ item.title }} </h4>
                <h5>{{ item.owner }}</h5>
            </div>
            <div class="card-body">
                <div class="member-count-wrapper">
                    <div class="min_members inlineBlocks">최소인원수: {{ item.min_members }}</div>
                    <div class="max_members inlineBlocks">최대인원수: {{ item.max_members }}</div>
                </div>
                <div class="end_point inlineBlocks">목적지: {{ item.end_point }}</div>
                <div class="startdate inlineBlocks">산행일자: {{ item.startdate }}</div>
            </div>
            <router-link
                tag="b-button"
                style="width: 20em"
                :to="toGroupDetail + '/' + item.uuid"
                >
                그룹 페이지로 이동
            </router-link>
            <!-- <b-button style="width: 20em" href="http://localhost:8000/#/make">그룹페이지로 이동</b-button> -->
            <b-button style="width: 80px" @click="joinGroup(item.uuid)">등산 참가</b-button>
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
                list_num        : 0,
                list            : [],
                HttpAddr        : "http://localhost:8000",
                toGroupDetail   : '/group',
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
                                uuid: response.data.groupInformations[i].uuid,
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
            },
            joinGroup(groupId) {
                axios.post(/*this.$HttpAddr*/'http://hikonnect.ga/api/entryGroup', {
                    userUuid: sessionStorage.uuid,
                    groupUuid: groupId
                }, {
                    // headers: {
                    //     'Access-Control-Allow-Headers' : 'Origin, Content-Type, X-Auth-Token',
                    //     'Access-Control-Allow-Origin': '*'
                    // }
                    crossdomain: true
                })
                .then(response => {
                    console.log(response);
                    if (response) {
                        this.$EventBus.$emit('complitedModalOpen', true);
                    } else {
                        this.$EventBus.$emit('errorModalOpen', '잘못된 접근입니다.');
                    }
                });
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
    .max_members {
        align-self: flex-end;
        margin-left: 3%;
    }
    .member-count-wrapper {
        text-align: end;
    }
</style>
