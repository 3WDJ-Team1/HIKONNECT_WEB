<template>
    <div>
        <v-btn
                style="margin-bottom: 5%;"
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                :to="eventMake"
        >
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>
<script>
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        data() {
            return {
                eventMake   : 'd9cb0da3-4c71-11e8-82cb-42010a9200af/event',
            };
        },
        methods: {
            moveMakeEvent() {
                this.$router.push('/group/' + this.groupId);
            },
            updateVisible(writer)   {
                if(sessionStorage.userid != undefined)    {
                    // 로그인 되어 있으면
                    if (sessionStorage.getItem('nickname') == writer) {
                        // 등산 참가버튼 없애기
                        return true;
                    }
                }
            },
            joinAlert() {
                if(sessionStorage.userid != undefined)    {
                    // 로그인 되어 있으면
                    this.joinGroup(sessionStorage.uuid);
                } else    {
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
                if(this.mountain_name != "")    {
                    url = this.HttpAddr + '/groupList/' + this.list_num + "/" + this.select + "/" + this.mountain_name;
                } else if(this.writer != "")    {
                    console.log(this.writer);
                    url = this.HttpAddr + '/groupList/' + this.list_num + "/" + this.select + "/" + this.writer;
                } else if(this.date != "")    {
                    console.log(this.date);
                    url = this.HttpAddr + '/groupList/' + this.list_num + "/" + this.select + "/" + this.date;
                } else  {
                    url = this.HttpAddr + '/group/index/' + this.list_num;
                }
                axios.get(url).then(response => {
                    if(response) {
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
                    userUuid    : sessionStorage.uuid,  // user의 uuid
                    groupUuid   : groupId               // group의 uuid
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
</style>
