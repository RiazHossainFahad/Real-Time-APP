<template>
<v-container>
  <v-col cols="12" md="6" sm="8" xs="12">

    <div v-if="getError != []">
      <v-alert type="error" v-for="(err, index) in error" :key="index">
      {{err[0]}}
    </v-alert>
    </div>

    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
      class="mx-3"
      @submit.prevent="signup"
    >

      <v-text-field
        v-model="form.name"
        :rules="[rules.required]"
        label="Name"
        type="text"
        required
      ></v-text-field>

      <v-text-field
        v-model="form.email"
        :rules="emailRules"
        label="E-mail"
        type="email"
        required
      ></v-text-field>

      <v-text-field
          v-model="form.password"
          :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
          :rules="[rules.required, getLength()]"
          :type="show1 ? 'text' : 'password'"
          label="Password"
          counter
          @click:append="show1 = !show1"
      ></v-text-field>

      <v-text-field
          v-model="form.password_confirmation"
          :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
          :rules="[rules.required, getMatch()]"
          :type="show2 ? 'text' : 'password'"
          label="Password Confirmation"
          counter
          @click:append="show2 = !show2"
      ></v-text-field>

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        type="submit"
        @click="validate"
      >
        Signup
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
  export default {
    data: () => {
        return {
            valid: true,
            form: {
              name: '',
              email: '',
              password: '',
              password_confirmation: '',
            },
            emailRules: [
              v => !!v || 'E-mail is required',
              v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            show1: false,
            show2: false,
            rules: {
                required: value => !!value || 'Required.',
            },
            error: [],
        }
    },
    computed: {
      getError(){
        return this.error;
      }
    },
    created(){
      if(User.loggedIn()){
        this.$router.push({name: 'forum'});
      }
    },
    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      signup(){
        User.signup(this.form)
          .then(res => {
            res == true ? window.location = '/forum' : this.error = res;
          })
      },
      getMatch(){
        return this.form.password_confirmation != this.form.password ? 'Password Mismatched' : true;
      },
      getLength(){
        return this.form.password !='' ? (this.form.password.length < 4 ? 'The password must be at least 4 characters.' : true) : true;
      }
    },
  }
</script>

<style>

</style>