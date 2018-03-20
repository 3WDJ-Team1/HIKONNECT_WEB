<template>
    <v-app
        id="inspire">
        <v-navigation-drawer
            fixed
<<<<<<< HEAD
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
                to="/">
                <v-list-tile-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                    {{ item.text }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </router-link>
=======
            clipped
            v-model="drawer"
            app
            dark
            class="nav-drawer">
        <v-list
            dense>
            <v-list-tile v-for="item in items" :key="item.text" @click="">
            <v-list-tile-action>
                <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>
                {{ item.text }}
                </v-list-tile-title>
            </v-list-tile-content>
            </v-list-tile>
>>>>>>> 7322c00bfd0336767cda98b19c5c412576e9d1c3
            <v-subheader class="mt-3 grey--text text--darken-1">
                <v-icon color="grey darken-1">star</v-icon>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                BOOK MARKS
            </v-subheader>
            <v-list>
<<<<<<< HEAD
            <v-list-tile v-for="item in items2" :key="item.text" avatar>
=======
            <v-list-tile v-for="item in items2" :key="item.text" avatar @click="">
>>>>>>> 7322c00bfd0336767cda98b19c5c412576e9d1c3
                <v-list-tile-avatar>
                <img :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`" alt="">
                </v-list-tile-avatar>
                <v-list-tile-title v-text="item.text"></v-list-tile-title>
            </v-list-tile>
            </v-list>
<<<<<<< HEAD
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
            <span style="font-size: 1.4em;">HIKONNECT</span>
        </v-toolbar-title>
        <v-layout row align-center style="margin-left: 65em; padding: 0;">
            <v-flex
                xs2
                sm3
                md4
                style="font-size: 1em; margin-right: 2em;"
                @click.stop="drawerRight = !drawerRight"
                @click="changeDrawerRightMode('login')">
                <v-icon color="white">lock</v-icon>
                SIGN IN
            </v-flex>
            <v-flex
                xs2
                sm3
                md4
                style="font-size: 1em;"
                @click.stop="drawerRight = !drawerRight"
                @click="changeDrawerRightMode('register')">
                <v-icon color="white">assignment_ind</v-icon>
                SIGN UP
            </v-flex>
        </v-layout>
        </v-toolbar>
        <v-content>
        <v-container fill-height fluid style="padding: 0;">
            <v-layout fluid>
=======
            <v-list-tile class="mt-3" @click="">
            <v-list-tile-action>
                <v-icon color="grey darken-1">add_circle_outline</v-icon>
            </v-list-tile-action>
            <v-list-tile-title class="grey--text text--darken-1">Browse Channels</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="">
            <v-list-tile-action>
                <v-icon color="grey darken-1">settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-title class="grey--text text--darken-1">Manage Subscriptions</v-list-tile-title>
            </v-list-tile>
        </v-list>
        </v-navigation-drawer>
        <v-toolbar
            color="light-green"
            fixed
            clipped-left
            app
            dark>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-icon class="mx-3">fab fa-youtube</v-icon>
        <v-toolbar-title class="mr-5 align-center">
            <span class="title">Youtube</span>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-layout row align-center style="max-width: 650px">
            <v-text-field
            placeholder="Search..."
            single-line
            append-icon="search"
            :append-icon-cb="() => {}"
            color="white"
            hide-details
            ></v-text-field>
        </v-layout>
        </v-toolbar>
        <v-content>
        <v-container fill-height>
            <v-layout justify-center align-center>
>>>>>>> 7322c00bfd0336767cda98b19c5c412576e9d1c3
            <v-flex>
                <router-view
                    class="router-inside">
                </router-view>
            </v-flex>
            </v-layout>
<<<<<<< HEAD
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
=======
        </v-container>
        </v-content>
    </v-app>
    <!-- <div class="container">
        <div>
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
    </div> -->
>>>>>>> 7322c00bfd0336767cda98b19c5c412576e9d1c3
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
</style>

<script>
    import Login    from "./loginAndRegister/login.vue";
    import Register from "./loginAndRegister/register.vue";

<<<<<<< HEAD
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
                    path: '/'
                },
                {
                    icon: 'account_circle',
                    text: 'MY PAGE',
                    path: '/mypage'
                },
            ],
            items2: [
                { picture: 28, text: 'Joseph' },
                { picture: 38, text: 'Apple' },
                { picture: 48, text: 'Xbox Ahoy' },
                { picture: 58, text: 'Nokia' },
                { picture: 78, text: 'MKBHD' }
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
        },
        created() {
            this.$EventBus.$on('errorModalOpen', (message) => {
                this.modalErrorMsg = message;
                this.$refs.pModal.open();
            })
            this.$EventBus.$on('complitedModalOpen', (value) => {
                this.$refs.cModal.open();
            })
        }
=======
    export default{data: () => ({
      drawer: false,
      items: [
        { icon: 'home', text: 'HOME' },
        { icon: 'lock', text: 'SIGN IN' },
        { icon: 'assignment_ind', text: 'SIGN UP' },
        { icon: 'group_add', text: 'JOIN HIKING GROUP' },
        { icon: 'account_circle', text: 'MY PAGE' },
        { icon: 'star', text: 'BOOK MARK' },
      ],
      items2: [
        { picture: 28, text: 'Joseph' },
        { picture: 38, text: 'Apple' },
        { picture: 48, text: 'Xbox Ahoy' },
        { picture: 58, text: 'Nokia' },
        { picture: 78, text: 'MKBHD' }
      ]
    }),
    props: {
      source: String
>>>>>>> 7322c00bfd0336767cda98b19c5c412576e9d1c3
    }
  }
</script>