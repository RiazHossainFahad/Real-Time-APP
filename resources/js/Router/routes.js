import Vue from 'vue';
import VueRouter from 'vue-router';

import login from '../components/auth/Login'
import logout from '../components/auth/Logout'
import signup from '../components/auth/Signup'
import forum from '../components/forum/Forum'
import ReadQuestion from '../components/forum/ReadQuestion'
import CreateQuestion from '../components/create/CreateQuestion'
import CreateCategory from '../components/category/CreateCategory'

Vue.use(VueRouter);

const routes = [
  { path: '/login', component: login, name: 'login'},
  { path: '/logout', component: logout},
  { path: '/signup', component: signup},
  { path: '/ask-question', component: CreateQuestion},
  { path: '/category', component: CreateCategory},
  { path: '/forum', component: forum, name: 'forum'},
  { path: '/question/:slug', component: ReadQuestion, name: 'ReadQuestion'},
  ]

  const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang: false,
    mode: 'history'
  })

  export default router;