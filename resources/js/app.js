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

window.User = User;

console.log(User.id());
// User.logout();

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
});
