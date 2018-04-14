<template>
    <v-app
        id="inspire">
        <!-- 최상단 이동 버튼 -->
        <a name="#"></a>
        <v-btn
              color="red"
              dark
              midiuem
              fixed
              right
              bottom
              fab
              href="#">
                <v-icon>keyboard_arrow_up</v-icon>
        </v-btn>
        <!-- #최상단 이동 버튼 -->
        <v-navigation-drawer
            v-model="drawerRight"
            right
            app
            temporary>
            <login v-if="drawerRightMode === 'login'"></login>
            <register v-else></register>
        </v-navigation-drawer>

        <v-navigation-drawer
            fixed
            v-model="drawer"
            app      
            clipped  
            class="nav-drawer">
            <router-link
                tag="v-layout"
                :to="mypageRoute.path"
                v-if="isLogined"
                class="my-page-route">
                <v-flex
                    xs4
                    sm4
                    md4>
                    <v-avatar
                        class="grey lighten-4"
                        size="56"
                        slot="activator">
                        <img :src="mypageRoute.imagePath" alt="avatar"/>
                    </v-avatar>
                </v-flex>
                <v-flex 
                    xs6
                    sm6
                    md6
                    style="line-height: 300%; font-size: 1.5em;">
                    {{ userNickname }}
                </v-flex>
                <v-flex
                    xs2
                    sm2
                    md2
                    style="margin-top:5%">
                    <v-icon x-large>keyboard_arrow_right</v-icon>
                </v-flex>
            </router-link>
        <v-list
            dense>
            <router-link
                tag="v-list-tile"
                v-for="item in items"
                :key="item.text"
                :to="item.path">
                <v-list-tile-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                    {{ item.text }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </router-link>
            <v-subheader
                v-if    ="isLogined"
                class   ="mt-3 grey--text text--darken-1">
                <v-icon color="grey darken-1">star</v-icon>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                BOOK MARKS
            </v-subheader>
            <v-list>
            <v-list-tile 
                v-if    ="isLogined"
                v-for   ="item in items2"
                :key    ="item.text"
                avatar>
                <v-list-tile-avatar>
                <img :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`" alt="">
                </v-list-tile-avatar>
                <v-list-tile-title v-text="item.text"></v-list-tile-title>
            </v-list-tile>
            </v-list>
        </v-list>
        </v-navigation-drawer>
        <v-toolbar
            color="blue-grey darken-4"
            fixed
            clipped-left
            app
            dark
            flat
            scroll-off-screen>
        <v-btn icon  @click.stop="drawer = !drawer">
            <v-icon style="margin-bottom: 0.5em;">menu</v-icon>
        </v-btn>
        <v-toolbar-title class="mr-5 align-center">
            <span 
            style="
                font-size: 1.4em;
                cursor:pointer;"
            @click="goToHome()">
            HIKONNECT
            </span>
        </v-toolbar-title>
        <v-layout
            row
            fluid
            align-content-end
            align-end
            justify-end
            style="padding: 0;">
            <v-btn
                v-if        ="!isLogined"
                style       ="padding: 0; background-color: transparent;"
                flat
                @click.stop ="drawerRight = !drawerRight"
                @click      ="changeDrawerRightMode('login')">
                <v-icon color="white">lock</v-icon>
                SIGN IN
            </v-btn>
            <v-btn
                v-if="isLogined"
                style="padding: 0; background-color: transparent;"
                flat
                @click="logout('test')">
                <v-icon color="white">lock_open</v-icon>
                LOGOUT
            </v-btn>
            <v-btn
                v-if="!isLogined"
                style="padding: 0; background-color: transparent;"
                flat
                @click.stop="drawerRight = !drawerRight"
                @click="changeDrawerRightMode('register')">
                <v-icon color="white">assignment_ind</v-icon>
                SIGN UP
            </v-btn>
        </v-layout>
        </v-toolbar>
        <v-content>
        <v-container
            fill-height
            fluid
            style="padding: 0;">
            <v-layout fluid>
            <v-flex>
                <router-view
                    class="router-inside">
                </router-view>
            </v-flex>
            </v-layout>
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
        </v-container>
        </v-content>
    </v-app>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
    .nav-drawer {
        overflow-y: hidden;
    }
    .router-inside {
        width: 100%;
    }
    body v-app {
        overflow: hidden;
    }
    .my-page-route {
        padding: 3% 10%;
    }
    .my-page-route:hover {
        background-color: rgb(226, 226, 226);
    }
</style>

<script>
    import Login    from "./loginAndRegister/login.vue";
    import Register from "./loginAndRegister/register.vue";

    export default{
        data: () => ({
            userNickname: sessionStorage.getItem('nickname'),
            drawer: false,
            drawerRight: false,
            drawerRightMode: 'login',
            mypageRoute : {
                    icon: 'account_circle',
                    text: 'MY PAGE',
                    path: '/mypage',
                    imagePath: sessionStorage.getItem('image_path')
            },
            items: [
                { 
                    icon: 'home',
                    text: 'HOME',
                    path: '/'
                },
                {
                    icon: 'group_add',
                    text: 'JOIN HIKING GROUP',
                    path: '/list'
                },
            ],
            items2: [
                
            ],
            modalErrorMsg: "",
            isLogined: false
        }),
        components: {
            'login' : Login,
            'register' : Register
        },
        methods: {
            changeDrawerRightMode(argValue) {
                this.drawerRightMode = argValue;
                this.$EventBus.$emit("openDrawer", this.drawerRightMode);
            },
            goToHome() {
                location.href='/#/';
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
        },
        created() {
            this.$EventBus.$on('errorModalOpen', (message) => {
                this.modalErrorMsg = message;
                this.$refs.pModal.open();
            })
            this.$EventBus.$on('complitedModalOpen', (value) => {
                this.$refs.cModal.open();
            })
            this.$EventBus.$on('clickGettingStartBtn', () => {
                this.changeDrawerRightMode('login');
                this.drawerRight = !this.drawerRight;
            })
            this.$EventBus.$on('setRightDrawerFlipped', (value) => {
                this.drawerRight = false;
            })
            this.$EventBus.$on('isLogined', (v) => {
                this.isLogined = true;
                this.userNickname = sessionStorage.getItem('nickname');
            })
            this.isUserLogined();
            this.userNickname = sessionStorage.getItem('nickname');
            this.mypageRoute.imagePath = sessionStorage.getItem('image_path');
        },
    }
</script>