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
 
window.Vue.use(VueRouter);
 
import ExampleComponent from "./components/ExampleComponent.vue";
import App from './components/App.vue';
import listShow from "./components/listShow.vue";
import listSerch from "./components/listSerch.vue";
import groupList from "./components/groupList.vue";

const routes = [
    {
        name: 'groupList',
        path: '/',
        component: groupList
    }
];


 
const router = new VueRouter({ routes })
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')