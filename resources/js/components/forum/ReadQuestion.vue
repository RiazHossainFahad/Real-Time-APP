<template>
  <div>
      <edit-question 
        v-if="editing"
        :question = "question"
      ></edit-question>

      <single-question v-else
        :question = "question"
      ></single-question>
  </div>
</template>

<script>
import SingleQuestion from './SingleQuestion'
import EditQuestion from '../create/EditQuestion'

export default {
    components: {SingleQuestion, EditQuestion},
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