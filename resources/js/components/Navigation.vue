<template>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <div id="navigation" class="container">
      <div class="navbar-header">
        <router-link class="navbar-brand" to="/">Keeps</router-link>
      </div>
      <ul class="nav navbar-nav">
        <router-link
          v-if="!isLoggedIn"
          class="nav-item nav-link bg-primary mr-2 rounded-sm"
          :to="{ name: 'LoginPage' }"
        >
          Login
        </router-link>

        <router-link
          v-if="!isLoggedIn"
          class="nav-item nav-link border border-primary rounded-sm"
          :to="{ name: 'RegisterPage' }"
        >
          Register
        </router-link>

        <router-link
          v-if="isLoggedIn"
          class="nav-item nav-link"
          :to="{ name: 'DashboardPage' }"
        >
          Dashboard
        </router-link>

        <button
          class="nav-item nav-link btn btn-sm btn-warning text-dark font-weight-bold"
          v-if="isLoggedIn"
          @click.prevent="handleLogout"
        >
          Logout
        </button>
      </ul>
    </div>
  </nav>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";

  export default {
    computed: {
      ...mapGetters(["isLoggedIn"]),
    },

    created() {
      const guestRoutes = ["LoginPage", "RegisterPage", "HomePage"];
      const currentRoute = this.$router.history.current.name;

      if (!guestRoutes.includes(currentRoute)) {
        this.loggedIn();
      }
    },

    methods: {
      ...mapActions(["logout", "loggedIn"]),

      async handleLogout() {
        await this.logout();
        this.$router.push({ name: "LoginPage" });
      },
    },
  };
</script>

<style>
  .router-link-exact-active {
    color: #ffffff !important;
    transition: all 0.25s;
  }

  .navbar {
    padding: 0 !important;
  }

  .navbar-expand .navbar-nav .nav-link {
    padding: 0 0.5rem;
    font-size: 0.8rem;
  }

  @media screen and (max-width: 520px) {
    #navigation {
      padding: 0 1rem;
    }
  }
</style>
