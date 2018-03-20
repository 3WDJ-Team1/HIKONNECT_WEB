/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
window.Vue = require('vue');

import VueRouter from 'vue-router';
window.Vue.use(VueRouter);



import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


//import 'D:/HIKONNECT_WEB/fontawesome-free-5.0.8/svg-with-js/js/fontawesome-all.min'

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

export const eventBus = new Vue();
window.Vue.use(VueRouter);
import groups_list from './components/groups_list/main.vue'
import group_make from './components/group_make/group_make_main'
import notice from './components/notice/main'

// bootstrap-vue
import Bootstrap    from 'bootstrap-vue';
Vue.use(Bootstrap);

// sweet-modal
import SweetModal   from 'sweet-modal-vue/src/plugin.js';
Vue.use(SweetModal);

// vuetify
import Vuetify      from 'vuetify';
Vue.use(Vuetify);

import 'vuetify/dist/vuetify.min.css';

// vue axios
import VueAxios     from 'vue-axios';
import axios        from 'axios';
Vue.use(VueAxios, axios);

// vue-spinner
Vue.component('sync-loader', require('vue-spinner/src/SyncLoader.vue'));

// event bus
Vue.prototype.$EventBus = new Vue();

import listSerch            from "./components/listSerch.vue";

import main                 from './components/main/main.vue';
import mainbody             from './components/main/mainbody.vue';
import test                 from './components/main/test.vue';
import login                from './components/login.vue';
import register             from './components/register.vue';
import mypage               from './components/mypage/mypagemain.vue';
import modify               from './components/mypage/modify.vue';
import graph                from  './components/mypage/graph.vue';
import update from  './components/mypage/update.vue';
// vue-event-calendar
import 'vue-event-calendar/dist/style.css';
import vueEventCalendar     from 'vue-event-calendar';
Vue.use(vueEventCalendar, {
    locale: 'en',
    color: 'lightskyblue',
});

// ElementUI
import ElementUI            from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
import level  from  './components/mypage/level.vue';

// vue-toasted
import Toasted              from 'vue-toasted';
Vue.use(Toasted);

import App                  from './components/App.vue';
import GroupMenuTab         from "./components/group_menu/GroupMenuTab.vue";

// group notice
import NoticeListUp         from "./components/group_menu/group_notice/NoticeListUp.vue";
import NoticeWriteBtn       from './components/group_menu/group_notice/NoticeWriteBtn.vue';
import NoticeModifyBtn      from './components/group_menu/group_notice/NoticeModifyBtn.vue';
import NoticeDeleteBtn      from './components/group_menu/group_notice/NoticeDeleteBtn.vue';
import NoticeFormInside     from './components/group_menu/group_notice/NoticeFormInside.vue';

// group plan
import GroupPlan            from './components/group_menu/group_plan/GroupPlan.vue';
import GroupPlanMap         from './components/group_menu/group_plan/GroupPlanMap.vue';
import GroupPlanCalendar    from './components/group_menu/group_plan/GroupPlanCalendar.vue';

// group member list
import GroupMemberList      from './components/group_menu/group_member/GroupMemberList.vue';
import GroupMemberDetail    from './components/group_menu/group_member/GroupMemberDetail.vue';

// routing structure
const routes = [
    // this is an example
    {
        name: 'main',
        path: '/',
        component: main,
    },
    {
        name: 'mainbody',
        path: '/main',
        component: mainbody
    },
    {
        name: 'test',
        path: '/test',
        component: test
    },
    {
        name: 'register',
        path: '/register',
        component: register
    },
    {
        name: 'login',
        path: '/login',
        component: login
    },
    {
        name: 'notice',
        path: '/',
        component: notice
    },
    {
        name: 'mypage',
        path: '/mypage',
        component: mypage
    },
    {
        name: 'modify',
        path: '/modify',
        component: modify
    },
    {
        name: 'graph',
        path: '/graph',
        component: graph
    },
    // group menu
    {
        name        : 'GroupMenu',
        path        : '/group',
        component   : GroupMenuTab,
        children    : [
            // tab of group menu
            {
                path        : '/group',
                components  : {
                    notice      : NoticeListUp,
                    plan        : GroupPlan,
                    member_list : GroupMemberList,
                },
                children: [
                    {
                        path        : '/group',
                        components  : {
                            // write, modify, delete button of NoticeListUp
                            write   : NoticeWriteBtn,
                            modify  : NoticeModifyBtn,
                            delete  : NoticeDeleteBtn,
                            // components in GroupPlan
                            map         : GroupPlanMap,
                            calendar    : GroupPlanCalendar,
                            // component in GroupMemberList
                            member_detail   : GroupMemberDetail,
                        },
                        children: [
                            {
                                path        : '/group',
                                components  : {
                                    // inner form component of modal(NoticeWriteBtn, NoticeModifyBtn)
                                    form : NoticeFormInside
                                }
                            }
                        ]
                    }
                ]
            },
            {
                name: 'graph',
                path: '/graph',
                component: graph
            },
            {
                name: 'level',
                path: '/level',
                component: level
            },
            {
                name: 'update',
                path: '/update',
                component: update
            }
        ]
    },
];
 
const router = new VueRouter({ mode: 'history', routes:routes });
 
// view-router 와 직접적인 관련이 있다.
new Vue(Vue.util.extend({ router }, App)).$mount('#app');

