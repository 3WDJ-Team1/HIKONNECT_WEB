/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 
require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

 
import main from './components/main/main.vue';
import App from './components/App.vue';
import login from './components/login.vue';
import register from './components/register.vue';



const routes = [
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
        name: 'main',
        path: '/',
        component: main
    }
];
 
const router = new VueRouter({ mode: 'history', routes:routes });
 
new Vue(Vue.util.extend({ router }, App)).$mount('#app');//view-router 와 직접적인 관련이 있다.
