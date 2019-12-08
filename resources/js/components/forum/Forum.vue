<template>
  <v-container fluid grid-list-md>
    <v-layout row wrap>
      <v-flex xs8>
        <question
          v-for="question in questions"
          :key="question.slug"
          :question="question"
        ></question>
      </v-flex>
      Sidebar
    </v-layout>
  </v-container>
</template>

<script>
import question from './Question'
export default {
  components: {question},
  data(){
        return {
            questions: []
        }
    },
    created(){
        axios.get('api/question')
            .then(res => this.questions = res.data.data)
            .catch(err => console.log(err));
    }
}
</script>

<style>

</style>