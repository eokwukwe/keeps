<template>
  <div class="mt-4">
    <div class="row">
      <div class="col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">
        <div class="card">
          <h4 class="card-header text-center py-1">Login</h4>
          <div class="card-body">
            <form @submit.prevent="login">
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  v-model="form.email"
                  class="form-control form-control-sm"
                  id="email"
                  placeholder="example@mail.com"
                />
                <span class="text-danger error-text" v-if="errors.email">{{ errors.email[0] }}</span>
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
                <span class="text-danger error-text" v-if="errors.password">{{ errors.password[0] }}</span>
              </div>
              <button type="submit" class="btn btn-primary btn-sm btn-block" :disabled="isLoading">
                <span v-if="isLoading">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  <span class="sr-only">Loading...</span>
                </span>Login
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import user from "../apis/user";

  export default {
    name: "LoginForm",

    data() {
      return {
        form: {
          email: "",
          password: "",
        },
        errors: [],
        isLoading: false,
      };
    },
    methods: {
      async login() {
        this.isLoading = true;
        this.errors = [];

        try {
          const res = await user.login(this.form);

          this.$root.$emit("login", true);

          localStorage.setItem("token", res.data.access_token);

          this.$router.push({ name: "Dashboard" });
        } catch (error) {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        } finally {
          this.form = { email: "", password: "" };
          this.isLoading = false;
        }
      },
    },
  };
</script>

<style scoped>
  .error-text {
    font-size: 0.7rem;
  }

  label {
    margin-bottom: 0;
    font-size: 0.8rem;
  }
</style>
