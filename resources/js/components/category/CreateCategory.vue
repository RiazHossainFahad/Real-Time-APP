<template>
  <v-container grid-list-md>
    <v-layout row wrap>      
      <v-flex sm5>
        <div v-if="getError">
          <v-alert type="error" v-for="(err, index) in error.errors" :key="index">
            {{err[0]}}
          </v-alert>
        </div>

        <v-form
          @submit.prevent="submit"
        >
          <v-text-field
            v-model="form.name"
            label="Category Name"
            required
          ></v-text-field>

          <v-btn color="orange" v-if="editSlug" type="submit">Update Category</v-btn>
          <v-btn color="teal" v-else type="submit">Create Category</v-btn>
        </v-form>
      </v-flex >
        
      <v-flex sm6 offset-sm1>
          <v-card>
            <v-toolbar
                color="purple darken-3"
                dark
                dense
            >
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>
            <v-list v-for="(category,index) in categories" :key="index">    
                <v-list-item>
                  <v-list-item-content>
                      <v-list-item-title>{{category.name}}</v-list-item-title>
                  </v-list-item-content>
                  <v-list-item-group>
                    <v-btn icon small @click="editCategory(index)">
                      <v-icon color="orange">mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn icon small @click="deleteCategory(category.slug, index)">
                      <v-icon color="red">mdi-delete</v-icon>
                    </v-btn>
                  </v-list-item-group>
                </v-list-item>
                <v-divider></v-divider>
            </v-list>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data(){
    return {
      form: {
        name: ''
      },
      error: false,
      categories: [],
      editSlug: null,
    }
  },
  computed:{
    getError(){
      return this.error;
    }
  },
  created(){
    this.getCategory();
  },
  methods: {
    submit(){
      this.editSlug ? this.updateCategory() : this.createCategory();
    },
    createCategory(){
      axios.post('/api/category', this.form)
        .then(res => {
          this.form.name = '';
          this.categories.unshift(res.data.data);
        })
        .catch(err => this.error = err.response.data)
    },
    updateCategory(){
      axios.put(`/api/category/${this.editSlug}`, this.form)
        .then(res => {
          this.form.name = '';
          this.editSlug = null;
          this.categories.unshift(res.data.data);
        })
        .catch(err => this.error = err.response.data)
    },
    getCategory(){
      axios.get('/api/category')
            .then(res => this.categories = res.data.data)
            .catch(err => console.log(err));
    },
    editCategory(index){
      this.form.name = this.categories[index].name;
      this.editSlug = this.categories[index].slug;
      this.categories.splice(index, 1);
    },
    deleteCategory(slug, index){
      axios.delete(`/api/category/${slug}`)
            .then(res => {
              this.editSlug = null;
              this.categories.splice(index, 1);
            })
            .catch(err => console.log(err.response.data));
    }
  }
}
</script>

<style>

</style>