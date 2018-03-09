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

import SweetModal   from 'sweet-modal-vue/src/plugin.js';
Vue.use(SweetModal);

import Vuetify      from 'vuetify';
Vue.use(Vuetify);

import 'vuetify/dist/vuetify.min.css';

import VueAxios     from 'vue-axios';
import axios        from 'axios';
Vue.use(VueAxios, axios);

Vue.component('sync-loader', require('vue-spinner/src/SyncLoader.vue'));

Vue.prototype.$EventBus = new Vue();

import ExampleComponent     from "./components/ExampleComponent.vue";
import NoticeListUp         from "./components/group_menu/NoticeListUp.vue";
import App                  from './components/App.vue';
import NoticeWriteBtn       from './components/group_menu/NoticeWriteBtn.vue';
import NoticeModifyBtn      from './components/group_menu/NoticeModifyBtn.vue';
import NoticeDeleteBtn      from './components/group_menu/NoticeDeleteBtn.vue';
import NoticeFormInside     from './components/group_menu/NoticeFormInside.vue';

const routes = [
    {
        name: 'Example',
        path: '/',
        component: ExampleComponent,
    },
    {
        name: 'NoticeListUp',
        path: '/notice',
        component: NoticeListUp,

        children: [
            {
                path : '/notice',
                components : {
                    write : NoticeWriteBtn,
                    modify: NoticeModifyBtn,
                    delete: NoticeDeleteBtn
                },

                children: [
                    {
                        path: '/notice',
                        components: {
                            form : NoticeFormInside
                        }
                    }
                ]
            }
        ]
    },
];
const router = new VueRouter({ routes })
 
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app')