<template>
  <div>
      <edit-question 
        v-if="editing"
        :question = "question"
      ></edit-question>

    <div  v-else>
      <single-question
        :question = "question"
      ></single-question>

      <replies :replies = "question.reply" :QSlug = "question.path"></replies>

      <create-reply :QSlug = "question.path"></create-reply>
    </div>
  </div>
</template>

<script>
import SingleQuestion from './SingleQuestion'
import EditQuestion from '../create/EditQuestion'
import Replies from '../reply/Replies';
import CreateReply from '../reply/CreateReply';

export default {
    components: {SingleQuestion, EditQuestion, Replies, CreateReply},
    data() {
        return {
            question: [],
            editing: false,
        }
    },
    created(){

        this.listenEmitEditing();
        this.listenCancelEditing();
        this.getQuestion();
    },
    methods:{
        listenEmitEditing(){
            EventBus.$on('startEditing', ()=>{
                this.editing = true;
            });
        },
        listenCancelEditing(){
            EventBus.$on('cancelEditing', ()=>{
                this.editing = false;
            });
        },
        getQuestion(){
            axios.get(`/api/question/${this.$route.params.slug}`)
                .then(res => this.question = res.data.data)
                .catch(err => console.log(err));
        }
    }
}
</script>

<style>

</style>