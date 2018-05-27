
<template>
    <div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a
                                style="cursor:pointer"
                                class="nav-link"
                                @click.stop ="drawerRight = !drawerRight"
                                v-if        ="!isLogined"
                        >
                            Log in
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                                style="cursor:pointer"
                                class="nav-link"
                                v-if="isLogined"
                                @click="logout('test')"
                        >
                            Log out
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                                style="cursor:pointer"
                                class="nav-link"
                                v-if="!isLogined"
                                @click="signUp()"
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
            <login></login>
        </v-navigation-drawer>
    </div>
</template>
<script>
    import Login from '../loginAndRegister/login'
    export default {
        data: () => ({
            userNickname: sessionStorage.getItem('nickname'),
            modalErrorMsg: '',
            isLogined: false,
            drawerRight: false,
            mypageRoute : {
                icon: 'account_circle',
                text: 'MY PAGE',
                path: '/overview',
                imagePath: sessionStorage.getItem('image_path')
            },
        }),
        created() {
            this.$EventBus.$on('errorModalOpen', (message) => {
                this.modalErrorMsg = message;
                this.$refs.pModal.open();
            });
            this.$EventBus.$on('complitedModalOpen', (value) => {
                this.$refs.cModal.open();
                location.reload();
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
            this.userNickname = sessionStorage.getItem('nickname');
            this.mypageRoute.imagePath = sessionStorage.getItem('image_path');
        },
        components: {
            Login
        },
        methods: {
            signUp()    {
                this.$router.push("/admin/user");
            },
            logout(userId) {
                sessionStorage.clear();
                this.isLogined = false;
                location.reload();
                this.$router.push('/admin/overview');
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
