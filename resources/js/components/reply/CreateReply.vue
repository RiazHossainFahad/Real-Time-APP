<template>
  <v-container grid-list-md>
      <v-form
        @submit.prevent="createReply"
      >      
        <vue-simplemde 
            v-model="body"
        />

        <v-btn color="success" type="submit">Reply</v-btn>
      </v-form>
  </v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde';

export default {
    props: ['QSlug'],
    components: {VueSimplemde},
    data(){
        return{
            body:''
        }
    },
    methods: {
        createReply(){
            if(this.body){
                axios.post(`/api${this.QSlug}/reply`, {body: this.body})
                    .then(res=>{
                        this.body = '';
                        EventBus.$emit('newReply', res.data.data);
                        window.scroll(0,0);
                    })
                    .catch(err => console.log(err.response.data));
            }
        }
    }
}
</script>

<style>

</style>