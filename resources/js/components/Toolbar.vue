<template>
  <div>
    <v-toolbar color="purple darken-3" dark>
      <v-toolbar-title>Real-Time Forum</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-toolbar-items>
        <v-btn text>Forum</v-btn>
        <v-btn text>Ask Question</v-btn>
        <v-btn text>Category</v-btn>
        <v-btn text>
          <router-link to="/login" class="router-link">
            Login
          </router-link>
        </v-btn>
      </v-toolbar-items>

      <!-- <template v-if="$vuetify.breakpoint.smAndUp">
        <v-btn icon>
          <v-icon>mdi-export-variant</v-icon>
        </v-btn>
        <v-btn icon>
          <v-icon>mdi-delete-circle</v-icon>
        </v-btn>
        <v-btn icon>
          <v-icon>mdi-plus-circle</v-icon>
        </v-btn>
      </template> -->
    </v-toolbar>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.router-link{
  color: #fff !important;
  text-decoration: none;
}
</style>