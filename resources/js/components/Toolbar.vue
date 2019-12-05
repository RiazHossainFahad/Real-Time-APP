<template>
  <div>
    <v-toolbar color="purple darken-3" dark>
      <v-toolbar-title>Real-Time Forum</v-toolbar-title>

      <v-spacer></v-spacer>

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
export default {
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