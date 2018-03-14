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
import VueRouter from 'vue-router';

export const eventBus = new Vue();
window.Vue.use(VueRouter);
import ExampleComponent from "./components/ExampleComponent.vue";
import App from './components/App.vue';
import groups_list from './components/groups_list/main.vue'
import group_make from './components/group_make/group_make'

const routes = [
    {
        name: 'group_make',
        path: '/',
        component: group_make
    }
];

const router = new VueRouter({ routes })
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')