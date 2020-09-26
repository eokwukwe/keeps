<template>
  <div>
    <spinner v-if="loading" />

    <div v-else class="home col-8 mx-auto">
      <h1>Dashboard</h1>
      <div class="card">
        <div class="card-body" v-if="loggedInUser">
          <h3>Hello, {{ loggedInUser.name }}</h3>
          <span>{{ loggedInUser.email }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";

  import Spinner from "../components/Spinner";

  export default {
    components: { Spinner },

    computed: {
      ...mapGetters(["loggedInUser", "loading"]),
    },

    methods: {
      ...mapActions(["getLoggedInUser"]),
    },

    mounted() {
      this.getLoggedInUser();
    },
  };
</script>
