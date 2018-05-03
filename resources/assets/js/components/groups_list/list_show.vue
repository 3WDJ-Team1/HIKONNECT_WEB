<template>
    <v-container>
        <v-card v-for="item in list" :key="item.owner">
            <v-card-title primary-title>
                <div>
                    <div class="headline">{{ item.title }}</div>
                    <span class="grey--text">{{ item.nickname }}</span>
                </div>
            </v-card-title>
            <v-card-actions>
                <!--<v-btn flat :to="toGroupDetail + '/' + item.uuid">그룹 페이지로 이동</v-btn>-->
                <v-btn flat :to="toGroupDetail + '/' + item.uuid">그룹 페이지로 이동</v-btn>
                <v-btn flat color="purple">그룹 참여하기</v-btn>
                <v-spacer></v-spacer>
                <v-btn icon @click.native="show = !show">
                    <v-icon>{{ show ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                </v-btn>
            </v-card-actions>
            <v-slide-y-transition>
                <v-card-text v-show="show">
                    <div class="member-count-wrapper">
                        <div class="min_members inlineBlocks">최소인원수: {{ item.min_members }}</div>
                        <div class="max_members inlineBlocks">최대인원수: {{ item.max_members }}</div>
                    </div>
                    {{ item.content }}
                </v-card-text>
            </v-slide-y-transition>
        </v-card>
        <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
             <span slot="no-more">
                There is no more Hacker News :(
             </span>
        </infinite-loading>
    </v-container>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        data() {
            return {
                group_make_sign: false,
                show: false,
                select: "a",
                input: "a",
                list_num: 0,
                list: [],
                HttpAddr: Laravel.host,
                toGroupDetail: '/group',
            };
        },
        watch:  {
            group_make_sign: function() {
                a;
            }
        },
        created() {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            this.$EventBus.$on('group_make_sign', (sign) => {
                // this.$EventBus.$emit('group_make_0', {title: '', content: '', min: '', max: ''});
                this.group_make_sign = sign;
                this.list = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
            this.$EventBus.$on('input_name', (sel, mountain) => {
                this.select = sel;
                this.input = mountain;
                this.list = [];
                this.list_num = 0;
                this.infiniteHandler();
            });
            this.$EventBus.$on('input_writer', (sel, writer) => {
                this.select = sel;
                this.input = writer;
                this.list = [];
                this.list_num = 0;
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
                this.axios.post(this.HttpAddr + '/api/groupList',
                    {
                        select: this.select,
                        input: this.input,
                        page: this.list_num
                    }).then(response => {
                    if (response) {
                        this.list = this.list.concat(response.data);
                        $state.loaded();
                        if (response.data.length < 10) {
                            $state.complete();
                        }
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
                    userUuid: sessionStorage.userid,  // user의 uuid
                    groupUuid: groupId               // group의 uuid
                }).then(response => {
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
