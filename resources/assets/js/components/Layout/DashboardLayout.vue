<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="wrapper">
        <side-bar>
            <mobile-menu slot="content"></mobile-menu>
            <div class="box" align="center" style="margin-bottom: 17px;" v-if="login">
                <div class="item">
                    <v-avatar
                            class="grey lighten-4"
                            size="56"
                            slot="activator">
                        <img :src="imageSrc"/>
                    </v-avatar>
                </div>
                <div class="item">
                    <h3>{{ userNickname }}</h3>
                </div>
            </div>
            <sidebar-link to="/group-list">
                <i class="nc-icon nc-circle-09"></i>
                <p>그룹찾기</p>
            </sidebar-link>
            <sidebar-link to="/record" v-if="login">
                <i class="nc-icon nc-notes"></i>
                <p>나의 활동기록</p>
            </sidebar-link>
            <sidebar-link to="/table-list" v-if="login">
                <i class="nc-icon nc-paper-2"></i>
                <p>나의 그룹</p>
            </sidebar-link>
            <sidebar-link to="/user" v-if="login">
                <i class="nc-icon nc-atom"></i>
                <p>마이 페이지</p>
            </sidebar-link>
        </side-bar>
        <div class="main-panel">
            <top-navbar></top-navbar>

            <dashboard-content @click="toggleSidebar">

            </dashboard-content>

            <content-footer></content-footer>
        </div>
    </div>
</template>
<style lang="scss">

</style>
<script>
    import TopNavbar from './TopNavbar.vue'
    import ContentFooter from './ContentFooter.vue'
    import DashboardContent from './Content.vue'
    import MobileMenu from './MobileMenu.vue'

    export default {
        data: () => ({
            imageSrc: "http://hikonnect.ga:3000/images/UserProfile/" + sessionStorage.getItem('userid') + ".jpg",
            login: false,
            userNickname: sessionStorage.getItem('nickname'),
        }),
        created() {
            if (sessionStorage.getItem('userid') != undefined) {
                this.login = true;
            }
        },
        components: {
            TopNavbar,
            ContentFooter,
            DashboardContent,
            MobileMenu
        },
        methods: {
            toggleSidebar() {
                if (this.$sidebar.showSidebar) {
                    this.$sidebar.displaySidebar(false)
                }
            }
        }
    }

</script>
<style>
    .box {
        display: flex;
    }

    .item {
        flex-grow: 1;
    }

    .item:nth-child(2) {
        flex-grow: 2;
    }

    .item:nth-child(2) h3 {
        margin: 0px;
        padding-top: 10px;
        padding-left: 20px;
        float: left;
    }
</style>
