<template>
  <div>
      <v-btn icon small @click="likeReply">
          <v-icon :color="likeColor">mdi-heart</v-icon> {{count}}
      </v-btn>
  </div>
</template>

<script>
export default {
    props: ['data'],
    data(){
        return{
            liked: this.data.liked,
            count: this.data.like_count,
        }
    },
    computed:{
        likeColor(){
            return this.liked ? "blue" : "blue lighten-3"
        }
    },
    methods: {
        likeReply(){
            if(User.loggedIn){
                this.liked ? this.decrement() : this.increment();
                this.liked = !this.liked;
            }
        },
        increment(){
            axios.post(`/api/like/${this.data.id}`)
                .then(res => {
                    this.count++;
                })
                .catch(err => console.log(err.resonse.data));
        },
        decrement(){
            axios.delete(`/api/like/${this.data.id}`)
                .then(res => {
                    this.count--;
                })
                .catch(err => console.log(err.resonse.data));
        },

    }
}
</script>

<style>

</style>