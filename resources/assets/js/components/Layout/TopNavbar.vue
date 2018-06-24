<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <nav class="navbar navbar-expand-lg" style="min-height: 67px;">
            <div class="container-fluid">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a
                                style="cursor:pointer; font-size: 30px; font-family: 'Do Hyeon', sans-serif;"
                                class="nav-link"
                                @click.stop="drawerRight = !drawerRight"
                                v-if="!isLogined"
                        >
                            로그인
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                                style="cursor:pointer; font-size: 30px; font-family: 'Do Hyeon', sans-serif;"
                                class="nav-link"
                                v-if="isLogined"
                                @click="logout()"
                        >
                            로그아웃
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                                style="cursor:pointer; font-size: 30px; font-family: 'Do Hyeon', sans-serif;"
                                class="nav-link"
                                v-if="!isLogined"
                                @click="signUp()"
                        >
                            회원가입
                        </a>
                    </li>
                </ul>
                <button type="button"
                        class="navbar-toggler navbar-toggler-right"
                        :class="{toggled: $sidebar.showSidebar}"
                        aria-controls="navigation-index"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        @click="toggleSidebar">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
            </div>
        </nav>
        <sweet-modal
                @close="reload"
                icon="error"
                title="ERROR"
                blocking
                ref="pModal">
            {{ modalErrorMsg }}
        </sweet-modal>
        <sweet-modal
                @close="reload"
                icon="success"
                title="SUCCESS"
                blocking
                ref="cModal">
            Complited!
        </sweet-modal>
        <v-navigation-drawer
                v-model="drawerRight"
                right
                app
                temporary>
            <login></login>
        </v-navigation-drawer>
    </div>
</template>
<script>
    import Login from '../loginAndRegister/login'

    export default {
        data: () => ({
            modalErrorMsg: '',
            isLogined: false,
            drawerRight: false,
            activeNotifications: false
        }),
        created() {
            this.$EventBus.$on('errorModalOpen', (message) => {
                this.modalErrorMsg = message;
                this.$refs.pModal.open();
            });
            this.$EventBus.$on('complitedModalOpen', (value) => {
                this.$refs.cModal.open();
            });
            this.isUserLogined();
        },
        components: {
            Login
        },
        methods: {
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1)
            },
            toggleNotificationDropDown() {
                this.activeNotifications = !this.activeNotifications
            },
            closeDropDown() {
                this.activeNotifications = false
            },
            toggleSidebar() {
                this.$sidebar.displaySidebar(!this.$sidebar.showSidebar)
            },
            hideSidebar() {
                this.$sidebar.displaySidebar(false)
            },
            reload() {
                location.reload();
            },
            signUp() {
                this.$router.push("/user");
            },
            logout() {
                sessionStorage.clear();
                location.reload();
                this.$router.push('/');
            },
            isUserLogined() {
                if (sessionStorage.userid != undefined) {
                    this.isLogined = true;
                }
            }
        }
    }
</script>
<style>
    .navigation-drawer--temporary:not(.navigation-drawer--close), .navigation-drawer--is-mobile:not(.navigation-drawer--close) {
        background-color: white;
    }
</style>
