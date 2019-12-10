/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';

Vue.use(Vuetify);

Vue.component('AppHome', require('./components/AppHome.vue').default);

import router from './Router/routes.js';
import User from './Helpers/User';
import Exception from './Helpers/Exception';

window.User = User;
window.Exception = Exception;

window.EventBus = new Vue();

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
});
