<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="wrapper">
        <side-bar v-if="login">
            <div v-if="login" align="center" style="margin-bottom: 17px;">
                <div style="background-color: white; padding-top: 20px; padding-bottom: 15px;">
                    <v-avatar
                            class="grey lighten-4"
                            size="120"
                            slot="activator">
                        <img :src="imageSrc"/>
                    </v-avatar>
                </div>
                <div style="background-color: white; padding-bottom: 8px;">
                    <h1 style="color: black; margin: 0; font-family: 'Gothic A1', sans-serif; font-size: 50px;">{{ userNickname }}</h1>
                    <div style="width: 230px; height: 3px; background-color: #24b674;"></div>
                    <h4 style="color: gray; margin: 10px; font-family: 'Gothic A1', sans-serif;">{{ rank }}</h4>
                </div>
            </div>
            <sidebar-link to="/group-list">
                <i class="nc-icon nc-circle-09"></i>
                <p style="font-family: 'Gothic A1', sans-serif;">サーチグループ</p>
            </sidebar-link>
            <sidebar-link to="/record" v-if="login">
                <i class="nc-icon nc-notes"></i>
                <p style="font-family: 'Gothic A1', sans-serif;">活動記録</p>
            </sidebar-link>
            <sidebar-link to="/table-list" v-if="login">
                <i class="nc-icon nc-paper-2"></i>
                <p style="font-family: 'Gothic A1', sans-serif;">My Group</p>
            </sidebar-link>
            <sidebar-link to="/user" v-if="login">
                <i class="nc-icon nc-atom"></i>
                <p style="font-family: 'Gothic A1', sans-serif;">My Page</p>
            </sidebar-link>
        </side-bar>
        <div class="main-panel">
            <top-navbar></top-navbar>
            <dashboard-content @click="toggleSidebar" style="max-width: 100%; min-height: 100%; overflow-x: hidden;">
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

    export default {
        data: () => ({
            imageSrc: "http://hikonnect.ga:3000/images/UserProfile/" + sessionStorage.getItem('userid') + ".jpg",
            login: false,
            userNickname: sessionStorage.getItem('nickname'),
            rank: ''
        }),
        created() {
            this.positionPull();
            // 로그인 안되어 있을 경우
            if (sessionStorage.getItem('userid') != undefined) {
                this.login = true;
            }
            if(!this.login) {
                var x = document.createElement("STYLE");
                var t = document.createTextNode(".main-panel {width: 100%;}");
                x.appendChild(t);
                document.head.appendChild(x);
            } else  {
                var x = document.createElement("STYLE");
                var t = document.createTextNode(".main-panel {width: 85.1%;}");
                x.appendChild(t);
                document.head.appendChild(x);
            }
        },
        components: {
            TopNavbar,
            ContentFooter,
            DashboardContent
        },
        methods: {
            positionPull() {
                this.axios.get('http://hikonnect.ga/api/user/' + sessionStorage.getItem('userid'))
                    .then(response => {
                        if(response.data.grade == '동네 뒷산')   {
                            this.rank = '裏山';
                        }
                        
                    });
            },
            toggleSidebar() {
                if (this.$sidebar.showSidebar) {
                    this.$sidebar.displaySidebar(false)
                }
            }
        }
    }

</script>
<style>
    .item:nth-child(2) h3 {
        margin: 0px;
        padding-top: 10px;
        padding-left: 20px;
        float: left;
    }
</style>
