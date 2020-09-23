<template>
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div id="navigation" class="container">
      <div class="navbar-header">
        <router-link class="navbar-brand" to="/">Keeps</router-link>
      </div>
      <ul class="nav navbar-nav">
        <router-link 
          v-if="!isLoggedIn" 
          class="nav-item nav-link" 
          :to="{ name: 'Login' }"
        >
          LOGIN
        </router-link>

        <router-link
          v-if="!isLoggedIn"
          class="nav-item nav-link"
          :to="{ name: 'Register' }"
        >
          REGISTER
        </router-link>

        <router-link
          v-if="isLoggedIn"
          class="nav-item nav-link"
          :to="{ name: 'Dashboard' }"
        >
          Dashboard
        </router-link>
        
        <a class="nav-item nav-link" 
          v-if="isLoggedIn" 
          @click.prevent="logout" 
          href="#"
        >
          Logout
        </a>
      </ul>
    </div>
  </nav>
</template>

<script>
  import user from "../apis/user";

  export default {
    data() {
      return {
        isLoggedIn: false,
      };
    },
    mounted() {
      this.$root.$on("login", () => {
        this.isLoggedIn = true;
      });

      this.isLoggedIn = !!localStorage.getItem("token");
    },
    methods: {
      logout() {
        user.logout().then(() => {
          localStorage.removeItem("token");
          this.isLoggedIn = false;
          this.$router.push({ name: "Login" });
        });
      },
    },
  };
</script>

<style>
  .router-link-exact-active {
    color: #ffffff !important;
    transition: all 0.25s;
    /* background-color: gray;
                border-radius: 3px;
                text-transform: capitalize; */
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
