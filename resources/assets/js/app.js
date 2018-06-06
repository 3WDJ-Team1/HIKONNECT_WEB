
import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'


import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

require('./bootstrap');

// sweet-modal
import SweetModal   from 'sweet-modal-vue/src/plugin.js';
Vue.use(SweetModal);

import VueModalTor from 'vue-modaltor'
Vue.use(VueModalTor);


// vuetify
import Vuetify      from 'vuetify';
Vue.use(Vuetify);

import 'vuetify/dist/vuetify.css';
import 'material-design-icons-iconfont/dist/material-design-icons.scss'

// vue axios
import VueAxios     from 'vue-axios';
import axios        from 'axios';
Vue.use(VueAxios, axios);

// // vue-spinner
Vue.component('sync-loader', require('vue-spinner/src/SyncLoader.vue'));

// event bus
Vue.prototype.$EventBus = new Vue();

// vue-event-calendar
import 'vue-event-calendar/dist/style.css';
import vueEventCalendar     from 'vue-event-calendar';

Vue.use(vueEventCalendar, {
    locale  : 'en',
    color   : '#c0c4cc',
});

// ElementUI
import ElementUI            from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);

// set httpAddr all Vue components
Vue.prototype.$HttpAddr = Laravel.host + "/api";

// vue-datatime
import Datetime             from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
Vue.use(Datetime);

// vue-toasted
import Toasted              from 'vue-toasted';
Vue.use(Toasted);


// LightBootstrap plugin
import LightBootstrap from './light-bootstrap-main'

// router setup
import routes from './route'
// plugin setup
Vue.use(VueRouter);
Vue.use(LightBootstrap);

// configure router
const router = new VueRouter({
    routes, // short for routes: routes
    linkActiveClass: 'nav-item active'
})

/* eslint-disable no-new */
new Vue({
    el: '#app',
    render: h => h(App),
    router
})
