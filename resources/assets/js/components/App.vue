<template>
    <v-app
        id="inspire">
        <v-navigation-drawer
            fixed
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
            <v-subheader class="mt-3 grey--text text--darken-1">
                <v-icon color="grey darken-1">star</v-icon>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                BOOK MARKS
            </v-subheader>
            <v-list>
            <v-list-tile v-for="item in items2" :key="item.text" avatar @click="">
                <v-list-tile-avatar>
                <img :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`" alt="">
                </v-list-tile-avatar>
                <v-list-tile-title v-text="item.text"></v-list-tile-title>
            </v-list-tile>
            </v-list>
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
            <v-flex>
                <router-view
                    class="router-inside">
                </router-view>
            </v-flex>
            </v-layout>
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
    }
  }
</script>