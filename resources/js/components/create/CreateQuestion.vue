<template>
<v-container>
  <v-col xs="12">

    <div v-if="getError">
        <v-alert type="error" v-for="(err, index) in error.errors" :key="index">
            {{err[0]}}
        </v-alert>
    </div>

    <div v-if="getSuccessMsg">
        <v-alert type="success">
            {{successMsg}}
        </v-alert>
    </div>

    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
      class="mx-3"
      @submit.prevent="createQuestion"
    >

      <v-text-field
        v-model="form.title"
        :rules="rules"
        label="Title"
        required
      ></v-text-field>

        <v-autocomplete
        v-model="form.category_id"
        label="Category"
        :rules="rules"
        :items="categories"
        item-text="name"
        item-value="id"
        ></v-autocomplete>

    <vue-simplemde 
        v-model="form.body"
    />

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        type="submit"
        @click="validate"
      >
        Ask Question
      </v-btn>

      <v-btn
        color="error"
        class="mr-4"
        @click="reset"
      >
        Reset
      </v-btn>

    </v-form>
  </v-col>
</v-container>
</template>

<script>
import VueSimplemde from 'vue-simplemde'
  export default {
    components: {
      VueSimplemde
    },
    data: () => {
        return {
            valid: true,
            form: {
              title: '',
              category_id: '',
              body: '',
            },
            rules: [
              v => !!v || 'Required',
            ],
            error: false,
            categories: [],
            successMsg: false,
        }
    },
    computed: {
      getError(){
        return this.error;
      },
      getSuccessMsg(){
        if(this.successMsg == [])
          return false;
        return this.successMsg;
      }
    },
    created(){
        axios.get('/api/category')
            .then(res => {this.categories = res.data.data})
            .catch(err => console.log(err));
    },
    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
        }
      },
      reset () {
        this.$refs.form.reset()
        this.form.body = ''
        this.error = false;
      },
      createQuestion(){
          axios.post('/api/question', this.form)
                .then(res=>{
                  this.successMsg = "Question created successfully!";
                  this.reset();
                  })
                .catch(err => this.error = err.response.data);
      }
    },
  }
</script>

<style>
@import '~simplemde/dist/simplemde.min.css';
</style>