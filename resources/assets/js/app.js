/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);



import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


window.Vue = require('vue');

import VueRouter    from 'vue-router';
window.Vue.use(VueRouter);

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

<<<<<<< HEAD
import GroupMenuTab         from "./components/group_menu/GroupMenuTab.vue";
import NoticeListUp         from "./components/group_menu/NoticeListUp.vue";
import App                  from './components/App.vue';
import NoticeWriteBtn       from './components/group_menu/NoticeWriteBtn.vue';
import NoticeModifyBtn      from './components/group_menu/NoticeModifyBtn.vue';
import NoticeDeleteBtn      from './components/group_menu/NoticeDeleteBtn.vue';
import NoticeFormInside     from './components/group_menu/NoticeFormInside.vue';
import listShow             from "./components/listShow.vue";
import listSerch            from "./components/listSerch.vue";
import groupList            from "./components/groupList.vue";

import main                 from './components/main/main.vue';
import mainbody             from './components/main/mainbody.vue';
import test                 from './components/main/test.vue';
import login                from './components/login.vue';
import register             from './components/register.vue';
import mypage               from './components/mypage/mypagemain.vue';
import modify               from './components/mypage/modify.vue';
import graph                from  './components/mypage/graph.vue';
=======
// vue-event-calendar
import 'vue-event-calendar/dist/style.css';
import vueEventCalendar     from 'vue-event-calendar';
Vue.use(vueEventCalendar, {
    locale: 'en',
    color: 'lightskyblue',
});

import App                  from './components/App.vue';
import ExampleComponent     from "./components/ExampleComponent.vue";
import GroupMenuTab         from "./components/group_menu/GroupMenuTab.vue";
>>>>>>> notice_function

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
    }
    ,
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
            }
        ]
    },
];
 
const router = new VueRouter({ mode: 'history', routes:routes });
 
// view-router 와 직접적인 관련이 있다.
new Vue(Vue.util.extend({ router }, App)).$mount('#app');

