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
            fixed
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
            <v-subheader class="mt-3 grey--text text--darken-1">
                <v-icon color="grey darken-1">star</v-icon>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                BOOK MARKS
            </v-subheader>
            <v-list>
            <v-list-tile v-for="item in items2" :key="item.text" avatar>
                <v-list-tile-avatar>
                <img :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`" alt="">
                </v-list-tile-avatar>
                <v-list-tile-title v-text="item.text"></v-list-tile-title>
            </v-list-tile>
            </v-list>
        </v-list>
        </v-navigation-drawer>
        <v-toolbar
            color="teal lighten-1"
            fixed
            clipped-left
            app
            dark
            flat>
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
                style="padding: 0; background-color: transparent;"
                flat
                @click.stop="drawerRight = !drawerRight"
                @click="changeDrawerRightMode('login')">
                <v-icon color="white">lock</v-icon>
                SIGN IN
            </v-btn>
            <v-btn
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
                icon="error"
                title="ERROR"
                blocking
                ref="pModal">
                {{ modalErrorMsg }}
            </sweet-modal>
            <sweet-modal
                icon="success"
                title="SUCCESS"
                blocking
                ref="cModal">
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
</style>

<script>
    import Login    from "./loginAndRegister/login.vue";
    import Register from "./loginAndRegister/register.vue";

    export default{
        data: () => ({
            drawer: false,
            drawerRight: false,
            drawerRightMode: 'login',
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
                {
                    icon: 'account_circle',
                    text: 'MY PAGE',
                    path: '/mypage'
                },
            ],
            items2: [
                
            ],
            modalErrorMsg: ""
        }),
        components: {
            'login' : Login,
            'register' : Register
        },
        methods: {
            changeDrawerRightMode(argValue) {
                this.drawerRightMode = argValue;
            },
            goToHome() {
                location.href='/#/';
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
                console.log('button cliked!');
                this.changeDrawerRightMode('login');
                this.drawerRight = !this.drawerRight;
            })
        },
    }
</script>