<template>
    <div>
        <v-tabs icons-and-text centered color="white" grow style="width: 100%;">
            <v-tabs-slider color="cyan accent-1" style="height: 5px;"></v-tabs-slider>
            <v-tab href="#tab-1">
            notices
                <v-icon>announcement</v-icon>
            </v-tab>
            <v-tab href="#tab-2">
            plan
                <v-icon>event</v-icon>
            </v-tab>
            <v-tab href="#tab-3">
            members
                <v-icon>group</v-icon>
            </v-tab>
            <v-tab-item
                :key="1"
                :id="'tab-' + 1"
            >
                <v-card flat>
                    <router-view name="notice"></router-view>
                </v-card>
            </v-tab-item>
            <v-tab-item
                :key="2"
                :id="'tab-' + 2"
            >
                <v-card flat>
                    <!-- <router-view name="notice"></router-view> -->
                </v-card>
            </v-tab-item>
            <v-tab-item
                :key="3"
                :id="'tab-' + 3"
            >
                <v-card flat>
                    <!-- <router-view name="notice"></router-view> -->
                </v-card>
            </v-tab-item>
        </v-tabs>
        
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style>

</style>