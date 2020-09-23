<template>
  <div class="h-screen">
    <Navigation />
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>


<script>
  import Home from "../views/Home";
  import Navigation from "./Navigation.vue";

  export default {
    name: "App",

    components: {
      Navigation,
      Home
    },
  };
</script>

<style>
  .h-screen {
    min-height: 100vh;
  }
</style>
