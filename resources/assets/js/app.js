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

import 'D:/HIKONNECT_WEB/fontawesome-free-5.0.8/svg-with-js/js/fontawesome-all.min'

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);





// export const eventBus = new Vue();

import ExampleComponent from "./components/ExampleComponent.vue";
import App from './components/App.vue';
import groups_list from './components/groups_list/main.vue'
import group_make from './components/group_make/group_make'
import notice from './components/notice/main'

const routes = [
    {
        name: 'notice',
        path: '/',
        component: notice
    }
];

const router = new VueRouter({ routes })
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')