/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 
require('./bootstrap');
 
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

import NoticeListUp         from "./components/group_menu/group_notice/NoticeListUp.vue";
import NoticeWriteBtn       from './components/group_menu/group_notice/NoticeWriteBtn.vue';
import NoticeModifyBtn      from './components/group_menu/group_notice/NoticeModifyBtn.vue';
import NoticeDeleteBtn      from './components/group_menu/group_notice/NoticeDeleteBtn.vue';
import NoticeFormInside     from './components/group_menu/group_notice/NoticeFormInside.vue';

import GroupPlan            from './components/group_menu/group_plan/GroupPlan.vue';
import GroupPlanMap         from './components/group_menu/group_plan/GroupPlanMap.vue';
import GroupPlanCalendar    from './components/group_menu/group_plan/GroupPlanCalendar.vue';

// routing structure
const routes = [
    // this is an example
    {
        name        : 'Example',
        path        : '/',
        component   : ExampleComponent,
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
                    notice  : NoticeListUp,
                    plan    : GroupPlan
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
                            map     : GroupPlanMap,
                            calendar: GroupPlanCalendar
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
const router = new VueRouter({ routes })
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')