<template>
<v-container>
  <v-col cols="12" md="6" sm="8" xs="12">

    <div v-if="getError == 'Unauthorized'">
      <v-alert type="error">
      These credentials does not match to our records.
    </v-alert>
    </div>

    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
      class="mx-3"
      @submit.prevent="login"
    >

      <v-text-field
        v-model="form.email"
        :rules="emailRules"
        label="E-mail"
        required
      ></v-text-field>

      <v-text-field
          v-model="form.password"
          :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
          :rules="[rules.required]"
          :type="show1 ? 'text' : 'password'"
          label="Password"
          counter
          @click:append="show1 = !show1"
      ></v-text-field>

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        type="submit"
        @click="validate"
      >
        Login
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
              email: '',
              password: '',
            },
            emailRules: [
              v => !!v || 'E-mail is required',
              v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            show1: false,
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
        this.error = [];
      },
      login(){
        User.login(this.form)
          .then(res => {
            res == true ? window.location = '/forum' : this.error = res.error;
          })
      //  console.log(this.error);
      }
    },
  }
</script>

<style>

</style>