<template>
<v-container>
  <v-col xs="12">
      <v-card>
        <v-form
            ref="form"
            class="mx-3 pt-4"
            @submit.prevent="updateQuestion"
        >

            <v-text-field
                v-model="form.title"
                label="Title"
                required
            ></v-text-field>

            <vue-simplemde 
                v-model="form.body"
            />

            <v-card-actions>
                <v-btn color="teal" type="submit">
                    <v-icon color="orange">mdi-file</v-icon> Save
                </v-btn>
                <v-btn dark @click="cancelEditing">
                    <v-icon>mdi-cancel</v-icon> Cancel
                </v-btn>
            </v-card-actions>

        </v-form>
      </v-card>
  </v-col>
</v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde'
  export default {
    props: ['question'],
    components: {
      VueSimplemde
    },
    data: () => {
        return {
            form: {
              title: null,
              body: null,
            }
        }
    },
    computed: {
    },
    created(){
        this.form = this.question;
    },
    methods: {
      updateQuestion(){
          axios.put(`/api/question/${this.$route.params.slug}`, this.form)
                .then(res=>{
                    this.cancelEditing();
                  })
                .catch(err => this.error = err.response.data);
      },
      cancelEditing(){
          EventBus.$emit('cancelEditing');
      }
    },
  }
</script>

<style>
@import '~simplemde/dist/simplemde.min.css';
</style>