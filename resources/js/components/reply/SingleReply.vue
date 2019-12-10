<template>
  <div>
      <v-card class="mt-4">
          <v-card-title>
              <div class="font-weight-regular">
                  {{reply.user}}  
              </div>
              <div class="ml-2 subtitle-1 caption">
                said {{reply.created_at}}
              </div>

              <div v-if="!editing">
                <v-card-actions v-if="checkOwner">
                  <v-btn icon small @click="edit">
                    <v-icon color="orange">mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn icon small @click="deleteReply">
                    <v-icon color="red">mdi-delete</v-icon>
                  </v-btn>
                </v-card-actions>
              </div>

              <v-spacer></v-spacer>
              <like-reply :data="reply"></like-reply>
          </v-card-title>
          <v-divider></v-divider>

          <edit-reply v-if="editing" :reply="reply"></edit-reply>

          <v-card-text v-else class="font-weight-regular" v-html="body"></v-card-text>
      </v-card>
  </div>
</template>

<script>
import md from 'marked';
import EditReply from './EditReply';
import LikeReply from '../likes/LikeReply';

export default {
    props: ['reply', 'index'],
    components: {EditReply,LikeReply},
    data(){
      return {
        editing: false,
      }
    },
    computed:{
        checkOwner(){
            if(User.loggedIn()){
            return this.reply.user_id == User.id() ? true : false;
            }
            return  false;
      },
      body(){
        if(this.reply)
          return md.parse(this.reply.body);
      }
    },
    created(){
      this.listenCancelEditing();
    },
    methods: {
      deleteReply(){
        EventBus.$emit('deleteReply', this.reply );
      },
      edit(){
        this.editing = true;
      },
      listenCancelEditing(){
        EventBus.$on('cancelEditing', ()=>{
          this.editing = false;
        });
      }
    }
}
</script>

<style>

</style>