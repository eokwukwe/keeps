<template>
  <div class="">
    <Navigation />
    <div class="container h-screen">
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
      Home,
    },
  };
</script>

<style>
  @import "../../../node_modules/bootstrap/dist/css/bootstrap.min.css";
  @import "../../../node_modules/bootstrap-vue/dist/bootstrap-vue.min.css";

  .h-screen {
    min-height: 100vh;
  }
</style>
