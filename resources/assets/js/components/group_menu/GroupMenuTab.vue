<!-- 
    @file   GroupMenuTab.vue
    @brief  A component of group menu tab
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   update children components
 -->
<template>
    <!-- @div       wrapper of this component -->
    <div>
        <joinButton v-if="position != 'notLogin'"></joinButton>
        <!-- @v-tabs    there is information of tabs here -->
        <v-tabs
            icons-and-text
            centered color  ="grey lighten-4"
            style           ="width: 100%;"
            grow>
            <!-- @v-tab-slider      the slider of tabs on top -->
            <v-tabs-slider
                color="light-green accent-3"
                style="height: 5px;">
            </v-tabs-slider>
            <!-- @v-tab             the tabs in slider -->
            <v-tab
                href="#tab-1">
            공지사항
                <v-icon>announcement</v-icon>
            </v-tab>
            <v-tab href="#tab-2">
            일정
                <v-icon>event</v-icon>
            </v-tab>
            <v-tab href="#tab-3">
            멤버
                <v-icon>group</v-icon>
            </v-tab>
            <!-- @v-tab-item        the items of each tab.
                                    they are linked by 'id' -->
            <v-tab-item
                :key    ="1"
                :id     ="'tab-' + 1">
                <!-- @v-card            inner items of each tab are here. -->
                <v-card flat>
                    <!-- @router-vue(notice)          routing component whose name is notice.
                         @use                         app.js -->
                    <router-view name="notice"></router-view>
                </v-card>
            </v-tab-item>
            <v-tab-item
                :key    ="2"
                :id     ="'tab-' + 2">
                <v-card flat style="background-color: white; border: 1px soild whitesmoke;">
                    <router-view name="plan"></router-view>
                </v-card>
            </v-tab-item>
            <v-tab-item
                :key    ="3"
                :id     ="'tab-' + 3">
                <v-card flat style="background-color: white; border: 1px soild whitesmoke;" class="tab_full">
                    <router-view name="member_list"></router-view>
                </v-card>
            </v-tab-item>
        </v-tabs>
    </div>
</template>

<script>
    import joinButton from './joinButton'
    export default {
        components: {
            joinButton
        },
        data()  {
            return  {
                position: ''
            }
        },
        created()   {
            this.positionGet();
        },
        methods:    {
            positionGet() {
                if (sessionStorage.getItem('userid') != undefined) {
                    this.axios.post(Laravel.host + '/api/checkMember', {
                        uuid: this.$route.params.groupid,
                        userid: sessionStorage.getItem('userid'),
                    }).then(response => {
                        this.position = response.data;
                        this.$EventBus.$emit('sendPositionInfo', this.position);
                    });
                }
                else {
                    this.position = 'notLogin';
                }
            },
        }
    }
</script>

<style>
.tab_full {
    display: inline-block;
    width: 100%;
}
</style>