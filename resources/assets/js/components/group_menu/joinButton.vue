<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <sweet-modal ref="write" blocking id="groupModifyModal">
            <update_delete-modal></update_delete-modal>
        </sweet-modal>
        <img style="position: absolute; top: 1%; left: 1%;" src="http://localhost:8000/images/nav.png" height="70" width="400" alt="">
        <a style="color: white; position: absolute; top: 2.3%; left: 4.3%; font-size: 20px; font-family: 'Nanum Gothic', sans-serif;" v-if="owner == 'owner'" @click="updatedModal">
            <img src="http://localhost:8000/images/checkL.png" width="30" alt="">&nbsp;グループ修正</a>
        <a style="color: white; position: absolute; top: 2.3%; left: 15%; font-size: 20px; font-family: 'Nanum Gothic', sans-serif;" v-if="owner == 'owner'" @click="deleted">
            <img src="http://localhost:8000/images/ex.png" width="30" alt="">&nbsp;グループ削除</a>
        <a style="color: white; position: absolute; top: 2.3%; left: 4.3%; font-size: 20px; font-family: 'Nanum Gothic', sans-serif;"
           v-if="position && owner != 'owner'" @click="leaveGroup">
            <img src="http://localhost:8000/images/minus.png" width="30" alt="">&nbsp;グループ脱退</a>
        <a style="color: white; position: absolute; top: 2.3%; left: 15%; font-size: 20px; font-family: 'Nanum Gothic', sans-serif;"
           v-if="!position && owner != 'owner'" @click="enterGroup">
            <img src="http://localhost:8000/images/plus.png" width="30" alt="">&nbsp;グループ参加</a>
    </div>
</template>

<script>
    import Update_deleteModal from "../groups_list/update_deleteModal";

    export default {
        components: {
            Update_deleteModal
        },
        data: () => ({
            position: '',
            owner: ''
        }),
        created() {
            this.$EventBus.$on('ownerGet', (owner) => {
                this.owner = owner;
            });
            this.$EventBus.$on('positionGet', (position) => {
                this.position = position
            });
        },
        methods: {
            updatedModal() {
                this.$refs.write.open();
            },
            leaveGroup() {
                // 로그인 되어 있을 경우
                axios.post(this.$HttpAddr + '/out_group', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.$route.params.groupid
                }).then(response => {
                    if (response.data == 'true') {
                        const notification = {
                            template: "<span><b>グループ脱退完了</b></span>"
                        };
                        this.$notifications.notify(
                            {
                                component: notification,
                                icon: 'nc-icon nc-app',
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'success'
                            });
                        this.position = 'guest';
                        location.reload();
                    }
                });
            },
            deleted() {
                axios.delete(this.$HttpAddr + '/hikingGroup/' + this.$route.params.groupid)
                    .then((response) => {
                        if (response.data == 'true') {
                            const notification = {
                                template: "<span><b>グループ削除完了</b></span>"
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
                axios.post(this.$HttpAddr + '/member', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.$route.params.groupid
                }).then(response => {
                    if (response.data == 'true') {
                        const notification = {
                            template: "<span><b>グループ参加完了</b></span>"
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
        }
    }
</script>

<style scoped>
    .navbar .dropdown.nav-item .dropdown-toggle:after {
        margin-top: 12px;
    }
</style>