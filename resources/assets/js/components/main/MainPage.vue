<template>
    <v-app>
        <v-content style="padding: 0;">
        <section>
            <v-parallax :src="httpAddr + '/images/mountain_1.jpg'" height="650">
            <v-layout
                column
                align-center
                justify-center
                class="white--text">
                <img :src="httpAddr + '/images/hikonnect.png'" alt="Vuetify.js" height="100">
                <h1 class="white--text mb-2 display-1 text-xs-center">Group hiking</h1>
                <div class="subheading mb-3 text-xs-center">by Ganbariya</div>
                <v-btn
                class="cyan mt-5"
                dark
                large
                href="/login"
                >
                GETTING START
                </v-btn>
            </v-layout>
            </v-parallax>
        </section>

        <section>
            <v-layout
            column
            wrap
            class="my-5"
            align-center
            >
            <v-flex
                xs12
                sm4
                class="my-3">
                <div class="text-xs-center">
                <h2 class="headline">The best way to start developing</h2>
                <span class="subheading">
                    Cras facilisis mi vitae nunc 
                </span>
                </div>
            </v-flex>
            <v-flex xs12>
                <v-container grid-list-xl>
                <v-layout
                    row
                    wrap
                    align-center>
                    <v-flex
                        xs12
                        md4>
                    <v-card class="elevation-0 transparent">
                        <v-card-text class="text-xs-center">
                        <v-icon
                            x-large
                            class="blue--text text--lighten-2">color_lens</v-icon>
                        </v-card-text>
                        <v-card-title
                            primary-title
                            class="layout justify-center">
                        <div class="headline text-xs-center">Material Design</div>
                        </v-card-title>
                        <v-card-text>
                        Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                        Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                        </v-card-text>
                    </v-card>
                    </v-flex>
                    <v-flex
                        xs12
                        md4>
                    <v-card class="elevation-0 transparent">
                        <v-card-text class="text-xs-center">
                        <v-icon
                            x-large
                            class="blue--text text--lighten-2">flash_on</v-icon>
                        </v-card-text>
                        <v-card-title
                            primary-title
                            class="layout justify-center">
                        <div class="headline">Fast development</div>
                        </v-card-title>
                        <v-card-text>
                        Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                        Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                        </v-card-text>
                    </v-card>
                    </v-flex>
                    <v-flex
                        xs12
                        md4>
                    <v-card class="elevation-0 transparent">
                        <v-card-text class="text-xs-center">
                        <v-icon
                            x-large
                            class="blue--text text--lighten-2">build</v-icon>
                        </v-card-text>
                        <v-card-title
                            primary-title
                            class="layout justify-center">
                        <div class="headline text-xs-center">Completely Open Sourced</div>
                        </v-card-title>
                        <v-card-text>
                        Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                        Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                        </v-card-text>
                    </v-card>
                    </v-flex>
                </v-layout>
                </v-container>
            </v-flex>
            </v-layout>
        </section>

        <section>
            <v-parallax
                :src="httpAddr + '/images/mountain_2.jpg'"
                height="500">
            <v-layout
                column
                align-center
                justify-center>
                <div class="headline white--text mb-3 text-xs-center">
                    Find or create your group, and enjoy it!
                </div>
                <em>Your Hiking, will be better.</em>
                <v-btn
                class="red darken-1 mt-5"
                dark
                large
                href="/pre-made-themes"
                >
                FIND GROUPS
                </v-btn>
            </v-layout>
            </v-parallax>
        </section>

        <section>
            <v-container grid-list-xl>
            <v-layout
                row
                wrap
                justify-center
                class="my-5">
                <v-flex
                    xs12
                    sm4>
                <v-card class="elevation-0 transparent">
                    <v-card-title
                        primary-title
                        class="layout justify-center">
                    <div class="headline">Company info</div>
                    </v-card-title>
                    <v-card-text>
                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                    Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                    </v-card-text>
                </v-card>
                </v-flex>
                <v-flex
                    xs12
                    sm4
                    offset-sm1>
                <v-card class="elevation-0 transparent">
                    <v-card-title
                        primary-title
                        class="layout justify-center">
                    <div class="headline">Contact us</div>
                    </v-card-title>
                    <v-card-text>
                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                    </v-card-text>
                    <v-list class="transparent">
                    <v-list-tile>
                        <v-list-tile-action>
                        <v-icon class="blue--text text--lighten-2">phone</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                        <v-list-tile-title>777-867-5309</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                        <v-list-tile-action>
                        <v-icon class="blue--text text--lighten-2">place</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                        <v-list-tile-title>Chicago, US</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                        <v-list-tile-action>
                        <v-icon class="blue--text text--lighten-2">email</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                        <v-list-tile-title>john@vuetifyjs.com</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    </v-list>
                </v-card>
                </v-flex>
            </v-layout>
            </v-container>
        </section>

        <v-footer class="black">
            <!-- <v-layout row wrap align-center>
            <v-flex xs12>
                <div class="white--text ml-3">
                Made with
                <v-icon class="red--text">favorite</v-icon>
                by <a class="white--text" href="https://vuetifyjs.com" target="_blank">Vuetify</a>
                and <a class="white--text" href="https://github.com/vwxyzjn">Costa Huang</a>
                </div>
            </v-flex>
            </v-layout> -->
        </v-footer>
        </v-content>
    </v-app>
</template>
<script>
    export default {
        data: () => ({
            title   : 'Your Logo',
            httpAddr: Laravel.host
        })
    }
 </script>