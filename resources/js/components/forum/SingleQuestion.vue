<template>
  <v-container grid-list-md>
      <v-card>
          <v-card-title>
              <div>
                <div class="headline">
                    {{question.title}}
                </div>
                <span class="grey--text subtitle-1">{{question.user}} said {{question.created_at}}</span>
              </div>
              <v-spacer></v-spacer>
              <v-btn color="teal" dark>{{question.reply_count}} Replies</v-btn>
          </v-card-title>

        <v-card-text v-html="body">
        </v-card-text>

        <v-card-actions v-if="checkOwner">
          <v-btn icon small @click="emitEditing">
            <v-icon color="orange">mdi-pencil</v-icon>
          </v-btn>
          <v-btn icon small @click="destroy">
            <v-icon color="red darken-4">mdi-delete</v-icon>
          </v-btn>
        </v-card-actions>

      </v-card>
  </v-container>
</template>

<script>
import md from 'marked'

export default {
    props: ['question'],
    computed: {
      body(){
        if(this.question.body)
          return md.parse(this.question.body);
      },
      checkOwner(){
        if(User.loggedIn()){
         return this.question.user_id == User.id() ? true : false;
        }
        return  false;
      }
    },

    methods: {
      destroy(){
        axios.delete(`/api/question/${this.$route.params.slug}`)
              .then(res => {
                this.$router.push('/forum');
              })
              .catch(err => console.log(err.response.data));
      },
      emitEditing(){
        EventBus.$emit('startEditing');
      }
    }
}
</script>

<style>

</style>