<template>
  <div class="d-flex justify-content-center align-items-center login">
    <div class="card" style="max-width: 400px; min-width: 350px">
      <h4 class="card-header text-center py-1">Login</h4>
      <div class="card-body">
        <form @submit.prevent="handleSubmit">
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              v-model="form.email"
              class="form-control form-control-sm"
              id="email"
              placeholder="example@mail.com"
            />
            <span class="text-danger error-text" v-if="loginErrors.email">{{
              loginErrors.email[0]
            }}</span>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input
              type="password"
              v-model="form.password"
              class="form-control form-control-sm"
              id="password"
              placeholder="Enter password"
            />
            <span class="text-danger error-text" v-if="loginErrors.password">{{
              loginErrors.password[0]
            }}</span>
          </div>
          <button
            type="submit"
            class="btn btn-primary btn-sm btn-block"
            :disabled="loading"
          >
            <span v-if="loading">
              <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Loading...</span> </span
            >Login
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";

  export default {
    name: "LoginForm",

    data() {
      return {
        form: {
          email: "",
          password: "",
        },
      };
    },

    computed: {
      ...mapGetters(["loading", "loginErrors", "isLoggedIn"]),
    },

    methods: {
      ...mapActions(["login", "clearErrors", "loggedOut"]),

      async handleSubmit() {
        this.clearErrors("loginErrors");

        await this.login(this.form);

        if (this.isLoggedIn) {
          this.$router.push({ name: "DashboardPage" });
        }
      },
    },
  };
</script>

<style scoped>
  .login {
    height: 100vh;
  }

  .error-text {
    font-size: 0.7rem;
  }

  label {
    margin-bottom: 0;
    font-size: 0.8rem;
  }
</style>
