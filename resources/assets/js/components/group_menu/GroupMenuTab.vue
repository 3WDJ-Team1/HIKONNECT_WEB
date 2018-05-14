<!-- 
    @file   GroupMenuTab.vue
    @brief  A component of group menu tab
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   update children components
 -->
<template>
    <!-- @div       wrapper of this component -->
    <div>
        <joinButton></joinButton>
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
        data: () => ({
            groupId: '',
            isLogined: false,
            isUpdated: false,
        }),
        created() {
            this.groupId = this.$route.params.groupid;
            console.log(this.groupId);
            console.log(sessionStorage.getItem('userid'));
            this.axios.post(Laravel.host + '/api/checkMember', {
                uuid: this.groupId,
                userid: sessionStorage.getItem('userid'),
            }).then(response => {
                console.log(response.data);
                this.$EventBus.$emit('position', response.data);
                if (response.data == 'guest') {
                    this.isLogined = true;
                } else if (response.data == 'owner') {
                    this.isLogined = false;
                    this.isUpdated = true;
                } else if (response.data == 'member') {
                    this.isLogined = false;
                }
            })
        },
        methods: {
            enterUpdate() {
                this.$refs.write.open();
                axios.post(this.$HttpAddr + '/groupinfo',  {
                    uuid: this.uuid
                }).then(response => {
                    console.log(response.data)
                });
            },
            enterGroup() {
                // 로그인 되어 있을 경우
                if (sessionStorage.getItem('userid') != 'undefind') {
                    axios.post(this.$HttpAddr + '/member', {
                        userid: sessionStorage.getItem('userid'),
                        uuid: this.groupId
                    })
                        .then(response => {
                            alert('그룹에 참가되었습니다.');
                            this.isLogined = false;
                        });
                }
                else {
                    alert('로그인 후 이용가능 합니다.');
                }
            }
        }
        ,
        watch: {
            '$route'(to, from) {
                this.groupUuid = this.$route.params.groupid;
            }
        }
    }
</script>

<style>
.tab_full {
    display: inline-block;
    width: 100%;
}
</style>