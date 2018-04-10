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


// bootstrap-vue
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'



// vue-datatime
import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
Vue.use(Datetime);


import App                  from './components/App.vue';
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
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');