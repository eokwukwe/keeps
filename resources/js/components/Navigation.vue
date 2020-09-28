<template>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top py-1">
    <div id="navigation" class="container">
      <div class="navbar-header">
        <router-link class="navbar-brand" to="/">
          <img
            src="../../../public/img/logo.png"
            width="30"
            height="30"
            loading="lazy"
            alt="logo"
          />
          Keeps
        </router-link>
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

        <b-button
          v-b-toggle.material-sidebar
          variant="success"
          size="sm"
          v-if="isLoggedIn"
          class="py-0 mr-5"
        >
          <b-icon icon="plus" aria-hidden="true"></b-icon>
          Add</b-button
        >

        <div v-if="isLoggedIn" class="text-white text-capitalize mr-3">
          <b-avatar size="1.58rem" variant="secondary"></b-avatar>
        </div>

        <button
          class="nav-item nav-link btn btn-sm btn-warning text-dark"
          v-if="isLoggedIn"
          @click.prevent="handleLogout"
        >
          <b-icon icon="power" aria-hidden="true"></b-icon>
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
      ...mapGetters(["isLoggedIn", "loggedInUser"]),
    },

    created() {
      const guestRoutes = ["LoginPage", "RegisterPage", "HomePage"];
      const currentRoute = this.$router.history.current.name;

      if (!guestRoutes.includes(currentRoute)) {
        this.loggedIn();
      }

      // if (this.isLoggedIn) {
      //   this.getLoggedInUser();
      // }
    },

    mounted() {
      if (this.isLoggedIn) {
        this.getLoggedInUser();
      }
    },

    methods: {
      ...mapActions(["logout", "loggedIn", "getLoggedInUser"]),

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

  /* .navbar {
                                  padding: 0 !important;
                                } */

  .navbar-expand .navbar-nav .nav-link {
    padding: 0.1rem 0.7rem;
    font-size: 0.8rem;
  }

  @media screen and (max-width: 520px) {
    #navigation {
      padding: 0 1rem;
    }
  }
</style>
