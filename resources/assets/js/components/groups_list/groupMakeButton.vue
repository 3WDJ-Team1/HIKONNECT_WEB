<template>
    <v-app>
        <v-btn
                dark
                midiuem
                fixed
                right
                bottom
                fab
                color="pink"
                @click="groupMakeAlert('top', 'center')"
        >
            <v-icon>add</v-icon>
        </v-btn>
        <sweet-modal ref="write" blocking>
            <router-view name="make"></router-view>
        </sweet-modal>
    </v-app>
</template>

<script>
    export default {
        methods: {
            // 로그인 후 사용가능하도록 제한하기
            groupMakeAlert(verticalAlign, horizontalAlign) {
                // 로그인 안 되어 있을 경우
                if (sessionStorage.getItem('userid') == undefined) {
                    // alert창 띄워주기
                    const notification = {
                        template: "<span><b>로그인 후 사용가능합니다.</b></span>"
                    };
                    this.$notifications.notify(
                        {
                            component: notification,
                            icon: 'nc-icon nc-app',
                            horizontalAlign: horizontalAlign,
                            verticalAlign: verticalAlign,
                            type: 'warning'
                        })
                } else {
                    // 로그인 되어 있으면 그룹 만들기 모달 띄워주기
                    this.$refs.write.open();
                }
            }
        }
    }
</script>

<style scoped>

</style>