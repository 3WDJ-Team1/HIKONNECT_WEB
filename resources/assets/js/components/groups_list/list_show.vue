<template>
    <v-container>
        <v-card>
            <v-card-title primary-title>
                <div>
                    <div class="headline">그룹 이름</div>
                    <span class="grey--text">작성자</span>
                </div>
            </v-card-title>
            <v-card-actions>
                <!--<v-btn flat :to="toGroupDetail + '/' + item.uuid">그룹 페이지로 이동</v-btn>-->
                <v-btn flat :to="toGroupDetail + '/d9cb0da3-4c71-11e8-82cb-42010a9200af'">그룹 페이지로 이동</v-btn>
                <v-btn flat color="purple">그룹 참여하기</v-btn>
                <v-spacer></v-spacer>
                <v-btn icon @click.native="show = !show">
                    <v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                </v-btn>
            </v-card-actions>
            <v-slide-y-transition>
                <v-card-text v-show="show">
                    <div class="member-count-wrapper">
                        <div class="min_members inlineBlocks">최소인원수: 2</div>
                        <div class="max_members inlineBlocks">최대인원수: 3</div>
                    </div>
                    모집 내용
                </v-card-text>
            </v-slide-y-transition>
        </v-card>
        <div class="card" v-for="item in list" :key="item.owner">
            <div class="card-header">
                <h4 class="title inlineBlocks">{{ item.title }} </h4>
                <h5>{{ item.nickname }}</h5>
                <h5>{{ item.content }}</h5>
                <v-btn
                        @click="joinAlert()"
                        v-if="joinVisible(item.nickname)"
                        style="margin-right: 5%;"
                        color="red"
                        dark
                        midiuem
                        fab>
                    <v-icon>person_add</v-icon>
                </v-btn>
            </div>
            <div class="card-body">
                <div class="member-count-wrapper">
                    <div class="min_members inlineBlocks">최소인원수: {{ item.min_members }}</div>
                    <div class="max_members inlineBlocks">최대인원수: {{ item.max_members }}</div>
                </div>
                <!--<div class="end_point inlineBlocks">목적지: {{ item.end_point }}</div>-->
                <!--<div class="startdate inlineBlocks">산행일자: {{ item.start_date }}</div>-->
            </div>
            <v-btn flat color="teal" :to="toGroupDetail + '/' + item.uuid">
                <span>to group home</span>
                <v-icon>description</v-icon>
            </v-btn>
            <v-btn flat color="teal" :to="toUpdate + '/' + item.uuid"
                   v-if="updateVisible(item.nickname)">
                <span>update group page content</span>
                <v-icon>update</v-icon>
            </v-btn>
        </div>
        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </v-container>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        data() {
            return {
                show: false,
                select: "",
                mountain_name: '',
                writer: '',
                date: '',
                list_num: 0,
                list: [],
                HttpAddr: Laravel.host,
                toGroupDetail: '/group',
                toUpdate: '/group_update'
            };
        },
        created() {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            this.$EventBus.$on('input_name', (sel, mountain) => {
                this.select = sel;
                this.mountain_name = mountain;
                this.infiniteHandler();
            });
            this.$EventBus.$on('input_writer', (sel, writer) => {
                this.select = sel;
                this.writer = writer;
                this.infiniteHandler();
            });
            this.$EventBus.$on('input_date', (sel, date) => {
                this.select = sel;
                this.date = date.substring(0, 4) + "-" + date.substring(5, 7) + "-" + date.substring(8, 10);
                this.infiniteHandler();
            });
        },
        methods: {
            updateVisible(writer) {
                if (sessionStorage.userid != undefined) {
                    // 로그인 되어 있으면
                    if (sessionStorage.getItem('nickname') == writer) {
                        // 등산 참가버튼 없애기
                        return true;
                    }
                }
            },
            joinAlert() {
                if (sessionStorage.userid != undefined) {
                    // 로그인 되어 있으면
                    this.joinGroup(sessionStorage.uuid);
                } else {
                    alert('로그인 후 이용가능 합니다.');
                }
            },
            joinVisible(writer) {
                // 작성자 일 경우
                if (sessionStorage.getItem('nickname') == writer) {
                    // 등산 참가버튼 없애기
                    return false;
                } else {
                    return true;
                }

            },
            /**
             * 그룹 리스트 받아오기
             * @author      Jiyoon Lee, Sungeun Kang <kasueu0814@gmail.com>
             * @augments    $state state of infinite-loading */
            infiniteHandler($state) {
                let url;
                if (this.mountain_name != "") {
                    url = this.HttpAddr + '/groupList/' + this.list_num + "/" + this.select + "/" + this.mountain_name;
                } else if (this.writer != "") {
                    console.log(this.writer);
                    url = this.HttpAddr + '/groupList/' + this.list_num + "/" + this.select + "/" + this.writer;
                } else if (this.date != "") {
                    console.log(this.date);
                    url = this.HttpAddr + '/groupList/' + this.list_num + "/" + this.select + "/" + this.date;
                } else {
                    url = this.HttpAddr + '/groupList/' + this.list_num;
                }
                axios.get(url).then(response => {
                    if (response) {
                        this.list = this.list.concat(response.data);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                });
                this.list_num += 10;
            },
            /**
             * 그룹 참여 쿼리를 보내는 함수
             * @author      Sungeun Kang
             * @augments    groupId : uuid of groups
             */
            joinGroup(groupId) {
                axios.post(this.$HttpAddr + '/entryGroup', {
                    userUuid: sessionStorage.uuid,  // user의 uuid
                    groupUuid: groupId               // group의 uuid
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
    .card {
        margin-bottom: 20px;
    }

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
