<template>
  <v-card
    class="mx-5 mb-4"
    color="green lighten-5"
  >
    <v-card-title>
      <span class="font-weight-bold">
          <router-link :to="question.path" class="question-link">
            {{question.title}}
          </router-link>
        </span>
          <v-list-item-title class="grey--text">{{question.user}}, {{question.created_at}}</v-list-item-title>
    </v-card-title>
        <!-- <v-card-actions>
      <v-list-item class="grow">
        <v-list-item-content>
        </v-list-item-content>

        <v-row
          align="center"
          justify="end"
        >
          <v-icon class="mr-1">mdi-heart</v-icon>
          <span class="subheading mr-2">256</span>
          <span class="mr-1">·</span>
          <v-icon class="mr-1">mdi-share-variant</v-icon>
          <span class="subheading">45</span>
        </v-row>
      </v-list-item>
    </v-card-actions> -->
    <v-card-text class="headline" v-html="body">
    </v-card-text>

  </v-card>
</template>

<script>

import md from 'marked';

export default {
    name:'Question',
    props: ['question'],
    computed: {
      body(){
        return md.parse(this.question.body);
      }
    },
}
</script>

<style>
</style>