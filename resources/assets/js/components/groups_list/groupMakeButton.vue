<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
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
                style       ="margin-right: 1%; font-size: 13px; font-weight: bold;"
        >
            그룹
            <br>
            만들기
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
    .btn--floating {
        border-radius: 50%;
        min-width: 0;
        height: 56px;
        width: 56px;
        padding: 0;
    }
    .btn--floating.btn--fixed,
    .btn--floating.btn--absolute {
        z-index: 4;
    }
    .btn--floating:not(.btn--depressed) {
        -webkit-box-shadow: 0px 3px 5px -1px rgba(0,0,0,0.2), 0px 6px 10px 0px rgba(0,0,0,0.14), 0px 1px 18px 0px rgba(0,0,0,0.12);
        box-shadow: 0px 3px 5px -1px rgba(0,0,0,0.2), 0px 6px 10px 0px rgba(0,0,0,0.14), 0px 1px 18px 0px rgba(0,0,0,0.12);
    }
    .btn--floating:not(.btn--depressed):active {
        -webkit-box-shadow: 0px 7px 8px -4px rgba(0,0,0,0.2), 0px 12px 17px 2px rgba(0,0,0,0.14), 0px 5px 22px 4px rgba(0,0,0,0.12);
        box-shadow: 0px 7px 8px -4px rgba(0,0,0,0.2), 0px 12px 17px 2px rgba(0,0,0,0.14), 0px 5px 22px 4px rgba(0,0,0,0.12);
    }
    .btn--floating .btn__content {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        margin: 0;
        padding: 0;
    }
    .btn--floating:after {
        border-radius: 50%;
    }
    .btn--floating .btn__content :not(:only-child) {
        -webkit-transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
        transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
    }
    .btn--floating .btn__content :not(:only-child):first-child {
        opacity: 1;
    }
    .btn--floating .btn__content :not(:only-child):last-child {
        opacity: 0;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    .btn--floating .btn__content :not(:only-child):last-child,
    .btn--floating .btn__content :not(:only-child):first-child {
        -webkit-backface-visibility: hidden;
        position: absolute;
        left: 0;
        top: 0;
    }
    .btn--floating.btn--active .btn__content :not(:only-child):first-child {
        opacity: 0;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .btn--floating.btn--active .btn__content :not(:only-child):last-child {
        opacity: 1;
        -webkit-transform: rotate(0);
        transform: rotate(0);
    }
    .btn--floating .icon {
        height: inherit;
        width: inherit;
    }
    .btn--floating.btn--small {
        height: 40px;
        width: 40px;
    }
    .btn--floating.btn--small .icon {
        font-size: 18px;
    }
    .btn--floating.btn--large {
        height: 72px;
        width: 72px;
    }
    .btn--floating.btn--large .icon {
        font-size: 30px;
    }
    .btn--floating .icon {
        height: auto;
    }

</style>