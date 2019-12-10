<template>
  <v-parallax
    dark
    height="auto"
    id="parallax-hero"
    src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
  >
    <v-row
      align="center"
      justify="center"
    >
      <v-col class="text-center" cols="12">
        <h1 class="display-3 font-weight-thin mb-4">REAL-TIME FORUM</h1>
        <h4 class="headline">Build with Laravel, Vue.js & Vuetify.js!</h4>
      </v-col>
    </v-row>
  </v-parallax>
</template>


<script>
export default {
 mounted() {
    document.getElementById('parallax-hero').style.height = '88vh'
  }
}
</script>

<style>
</style>