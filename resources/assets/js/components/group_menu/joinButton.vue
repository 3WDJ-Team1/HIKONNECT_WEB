<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>

        <div>
                <sweet-modal ref="write" blocking>
                        <update_delete-modal></update_delete-modal>
                </sweet-modal>
        <nav class="navbar navbar-expand-lg" style="    top: 0px; display: inline-block;position: absolute; left: 0px;">
                <div class="container-fluid">
                        <div class="collapse navbar-collapse justify-content-end">
                                <ul class="nav navbar-nav mr-auto">
                                        <drop-down tag="li">
                                                <template slot="title">
                                                        <i class="nc-icon nc-grid-45"></i>
                                                </template>
                                                <a v-if="position == 'owner'" class="dropdown-item" @click="updatedModal">그룹정보 수정</a>
                                                <a v-if="position == 'owner'" class="dropdown-item" @click="deleted">그룹 삭제</a>
                                                <a v-if="position == 'member'" class="dropdown-item" @click="leaveGroup">그룹탈퇴</a>
                                                <a v-if="position == 'guest'" class="dropdown-item" @click="enterGroup">그룹 참가</a>
                                        </drop-down>
                                </ul>
                        </div>
                </div>
        </nav>
        </div>
</template>

<script>
    import Update_deleteModal from "../groups_list/update_deleteModal";
    export default {
        components:     {
            Update_deleteModal
        },
        data: () => ({
            position: '',
        }),
        created() {
            this.$EventBus.$on('sendPositionInfo', (position) => {
                    this.position = position;
            });
        },
        methods: {
            updatedModal()  {
                this.$refs.write.open();
            },
            leaveGroup() {
                // 로그인 되어 있을 경우
                    axios.post(this.$HttpAddr + '/out_group', {
                        userid: sessionStorage.getItem('userid'),
                        uuid: this.$route.params.groupid
                    }).then(response => {
                            if(response.data == 'true') {
                                const notification = {
                                    template: "<span><b>그룹에서 탈퇴하셨습니다.</b></span>"
                                };
                                this.$notifications.notify(
                                    {
                                        component: notification,
                                        icon: 'nc-icon nc-app',
                                        horizontalAlign: 'center',
                                        horizontalAlign: 'center',
                                        verticalAlign: 'top',
                                        type: 'success'
                                    });
                                this.position = 'guest';
                                location.reload();
                            }
                        });
            },
            deleted()  {
                axios.delete(this.$HttpAddr + '/hikingGroup/' + this.$route.params.groupid)
                    .then((response) => {
                        if (response.data == 'true') {
                            const notification = {
                                template: "<span><b>그룹이 삭제되었습니다.</b></span>"
                            };
                            this.$notifications.notify(
                                {
                                    component: notification,
                                    icon: 'nc-icon nc-app',
                                    horizontalAlign: 'center',
                                    verticalAlign: 'top',
                                    type: 'success'
                                });
                            this.$EventBus.$emit('group_make_sign', 'true');
                        }
                    });
                this.$router.push('/group-list')
                this.$parent.close();
                this.moveGroupList();
            },

            enterGroup() {
                // 로그인 되어 있을 경우
                if (sessionStorage.getItem('userid') != 'undefind') {
                    axios.post(this.$HttpAddr + '/member', {
                        userid: sessionStorage.getItem('userid'),
                        uuid: this.$route.params.groupid
                    })
                        .then(response => {
                            if(response.data == 'true') {
                                const notification = {
                                    template: "<span><b>그룹에 참가 되었습니다.</b></span>"
                                };
                                this.$notifications.notify(
                                    {
                                        component: notification,
                                        icon: 'nc-icon nc-app',
                                        horizontalAlign: 'center',
                                        verticalAlign: 'top',
                                        type: 'success'
                                    });
                                this.position = 'member';
                                location.reload();
                            }
                        });
                }
                else {
                    const notification = {
                        template: "<span><b>로그인 후 이용가능 합니다.</b></span>"
                    };
                    this.$notifications.notify(
                        {
                            component: notification,
                            icon: 'nc-icon nc-app',
                            horizontalAlign: 'center',
                            verticalAlign: 'top',
                            type: 'warning'
                        });
                }
            }
        }
    }
</script>

<style scoped>

</style>