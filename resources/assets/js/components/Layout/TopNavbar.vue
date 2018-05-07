<template>
    <div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a
                                class="nav-link"
                                @click.stop ="drawerRight = !drawerRight"
                                 @click      ="changeDrawerRightMode('login')"
                                v-if        ="!isLogined"
                        >
                            Log in
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                                class="nav-link"
                                v-if="isLogined"
                                @click="logout('test')"
                        >
                            Log out
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                                class="nav-link"
                                v-if="!isLogined"
                                @click.stop="drawerRight = !drawerRight"
                                @click="changeDrawerRightMode('register')"
                        >
                            Sign up
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <sweet-modal
                icon    ="error"
                title   ="ERROR"
                blocking
                ref     ="pModal">
            {{ modalErrorMsg }}
        </sweet-modal>
        <sweet-modal
                icon    ="success"
                title   ="SUCCESS"
                blocking
                ref     ="cModal">
            Complited!
        </sweet-modal>
        <v-navigation-drawer
                v-model="drawerRight"
                right
                app
                temporary>
            <login v-if="drawerRightMode === 'login'"></login>
            <register v-else></register>
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
            drawerRightMode: 'login'
        }),
        created() {
            this.$EventBus.$on('errorModalOpen', (message) => {
                this.modalErrorMsg = message;
                this.$refs.pModal.open();
            });
            this.$EventBus.$on('complitedModalOpen', (value) => {
                this.$refs.cModal.open();
            });
            this.$EventBus.$on('clickGettingStartBtn', () => {
                this.changeDrawerRightMode('login');
                this.drawerRight = !this.drawerRight;
            });
            this.$EventBus.$on('setRightDrawerFlipped', (value) => {
                this.drawerRight = false;
            });
            this.$EventBus.$on('isLogined', (v) => {
                this.isLogined = true;
                this.userNickname = sessionStorage.getItem('nickname');
            });
            this.isUserLogined();
        },
        components: {
            'login': Login,
        },
        methods: {
            changeDrawerRightMode(argValue) {
                this.drawerRightMode = argValue;
                this.$EventBus.$emit("openDrawer", this.drawerRightMode);
            },
            logout(userId) {
                sessionStorage.clear();
                this.isLogined = false;
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
    .navigation-drawer--temporary:not(.navigation-drawer--close), .navigation-drawer--is-mobile:not(.navigation-drawer--close)  {
        background-color: white;
    }

</style>
