/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 
require('./bootstrap');
 
window.Vue = require('vue');

import VueRouter    from 'vue-router';
window.Vue.use(VueRouter);
 
import Bootstrap    from 'bootstrap-vue';
Vue.use(Bootstrap);

import ExampleComponent from "./components/ExampleComponent.vue";
import NoticeListUp     from "./components/group_menu/NoticeListUp.vue";
import NoticeShowDetail from "./components/group_menu/NoticeShowDetail.vue";
import App              from './components/App.vue';

const routes = [
    {
        name: 'Example',
        path: '/',
        component: ExampleComponent,
    },
    {
        name: 'NoticeListUp',
        path: '/notice',
        component: NoticeListUp
    },
    {
        name: 'NoticeShowDetail',
        path: '/notice/detail',
        component: NoticeShowDetail
    }
];
 
const router = new VueRouter({ routes })
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')