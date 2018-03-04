/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 
require('./bootstrap');
 
window.Vue = require('vue');
import VueRouter from 'vue-router';
 
window.Vue.use(VueRouter);
 
import ExampleComponent from "./components/ExampleComponent.vue";
import App from './components/App.vue';
import jungyu from './components/jungyu.vue';

const routes = [
    {
        name: 'Example',
        path: '/',
        component: ExampleComponent,
    },
    {
        name: 'jungyu',
        path: '/jungyu',
        component: jungyu
    }
];
 
const router = new VueRouter({ routes })
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')