<template>
  <div>
    <v-toolbar color="purple darken-3" dark>
      <v-toolbar-title>
        <router-link to="/" class="router-link">
          Real-Time Forum
        </router-link>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <app-notification v-if="login"></app-notification>

      <v-toolbar-items
        v-for="item in items"
        :key="item.title"
      >
        <v-btn 
          text
          v-if="item.show"
        >
          <router-link
            :to="item.to"
            class="router-link"
          >
            {{item.title}}
          </router-link>
        </v-btn>
      </v-toolbar-items>

    </v-toolbar>
  </div>
</template>

<script>
import AppNotification from './AppNotification';

export default {
  components: {AppNotification},
  data(){
    return{
      items: [
        {title: 'Forum', to: '/forum', show: true},
        {title: 'Ask Question', to: '/ask-question', show: User.loggedIn()},
        {title: 'Category', to: '/category', show: User.loggedIn()},
        {title: 'logout', to: '/logout', show: User.loggedIn()},
        {title: 'Login', to: '/login', show: !User.loggedIn()},
        {title: 'Signup', to: '/signup', show: !User.loggedIn()},
      ]
    }
  },
  computed: {
    login(){
      return User.loggedIn();
    }
  },
  created(){
    EventBus.$on('logout', () => {
      User.logout();
    })
  }
}
</script>

<style lang="scss">
.router-link{
  color: #fff !important;
  text-decoration: none;
}
</style>