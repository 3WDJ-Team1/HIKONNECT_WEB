/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// vue-router
import VueRouter from 'vue-router'
window.Vue.use(VueRouter);

// route structure
import routes from './route.js';

// BootstrapVue
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

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

// // vue-spinner
// Vue.component('sync-loader', require('vue-spinner/src/SyncLoader.vue'));

// event bus
Vue.prototype.$EventBus = new Vue();

// vue-event-calendar
import 'vue-event-calendar/dist/style.css';
import vueEventCalendar     from 'vue-event-calendar';
Vue.use(vueEventCalendar, {
    locale  : 'en',
    color   : 'lightskyblue',
});

// ElementUI
import ElementUI            from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);

// vue-datatime
import Datetime             from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
Vue.use(Datetime);

// vue-toasted
import Toasted              from 'vue-toasted';
Vue.use(Toasted);

import App                  from './components/App.vue';

// set httpAddr all Vue components
Vue.prototype.$HttpAddr = Laravel.host + "/api";

const router = new VueRouter({ routes:routes });
import ExampleComponent     from "./components/ExampleComponent.vue";

// groups_list
import groups_list from './components/groups_list/main.vue'
import list_search from './components/groups_list/list_search'
import list_show from './components/groups_list/list_show'


// group_make
import group_make from './components/group_make/group_make'
import group_make_main from './components/group_make/group_make_main'

// notice
import notice from './components/notice/main'
import notice_information from './components/notice/notice_information'

const routes = [
    // group menu
    {
        path: '/list',
        component: groups_list,
        children: [
            {
                path: '/list',
                components: {
                    header: list_search,
                    body: list_show,
                }
            }
        ]
    },
    {
        path: '/notice',
        component: notice,
        children: [
            {
                path: '/notice',
                components: {
                    body: notice_information
                }
            }
        ]
    },
    {
        path: '/',
        component: group_make_main,
        children: [
            {
                path: '/',
                components: {
                    make: group_make
                }
            }
        ]
    }
];

const router = new VueRouter({ routes });
 
// view-router 와 직접적인 관련이 있다.
new Vue(Vue.util.extend({ router }, App)).$mount('#app');

//         component   : group_make_main,
//         children    : [
//             {
//                 path: '/',
//                 components: {
//                     make: group_make
//                 }
//             }
//         ]
//     }
// ];
