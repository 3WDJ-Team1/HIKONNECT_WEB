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
Vue.use(VueAxios, axios) ;

import lodash from 'lodash'
import VueLodash from 'vue-lodash'
Vue.use(VueLodash, lodash);

import Vuetify from 'vuetify'
Vue.use(Vuetify);

 
import main from './components/main/main.vue';
import mainbody from './components/main/mainbody.vue';
import App from './components/App.vue';
import login from './components/login.vue';
import register from './components/register.vue';
import mypage from './components/mypage/mypagemain.vue';
import modify from './components/mypage/modify.vue';
import graph  from  './components/mypage/graph.vue';
import update from  './components/mypage/update.vue';
import level  from  './components/mypage/level.vue';





const routes = [
    {
        name: 'main',
        path: '/',
        component: main,
        children: [
            {
                name: 'mainbody',
                path: '/main',
                component: mainbody
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
    }

];
 
const router = new VueRouter({ mode: 'history', routes:routes });
 
new Vue(Vue.util.extend({ router }, App)).$mount('#app');//view-router 와 직접적인 관련이 있다.

