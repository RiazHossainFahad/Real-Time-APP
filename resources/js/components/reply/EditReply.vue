<template>
  <v-container fluid grid-list-md>
        <vue-simplemde 
            v-model="reply.body"
        />

        <v-btn color="teal" dark @click="updateReply">
            <v-icon color="orange">mdi-file</v-icon> Save
        </v-btn>
        <v-btn dark @click="cancelEditing">
            <v-icon>mdi-cancel</v-icon> Cancel
        </v-btn>
  </v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde';

export default {
    name: "EditReply",
    props: ['reply'],
    components: {VueSimplemde},
    data(){
        return {

        }
    },
    methods: {
        updateReply(){
            axios.put(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`, {body: this.reply.body})
                .then(res => {
                    this.cancelEditing();
                })
                .catch(err => console.log(err.response.data));
        },
        cancelEditing(){
            EventBus.$emit('cancelEditing');
        }
    }
}
</script>

<style>

</style>