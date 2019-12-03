<template>
  <div>
      <toolbar></toolbar>
      <h1>HOME</h1>
      <app-footer></app-footer>
  </div>
</template>

<script>
import toolbar from './Toolbar'
import appFooter from './AppFooter'

export default {
    name: 'AppHome',
    components: {
        toolbar,
        appFooter
    }
}
</script>

<style>

</style>