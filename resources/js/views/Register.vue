<template>
  <div class="mt-4">
    <div class="row">
      <div class="col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">
        <div class="card">
          <h4 class="card-header text-center py-1">Register</h4>
          <div class="card-body">
            <form @submit.prevent="register">
              <div class="form-group">
                <label for="name">Name:</label>
                <input
                  type="text"
                  v-model="form.name"
                  class="form-control form-control-sm"
                  id="name"
                  placeholder="Jame Smith"
                />
                <span class="text-danger error-text" v-if="errors.name">{{ errors.name[0] }}</span>
              </div>

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

              <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input
                  type="password"
                  v-model="form.password_confirmation"
                  class="form-control form-control-sm"
                  id="password_confirmation"
                  placeholder="Enter password again"
                />
                <span
                  class="text-danger error-text"
                  v-if="errors.password_confirmation"
                >{{ errors.password_confirmation[0] }}</span>
              </div>
              <button type="submit" class="btn btn-primary btn-sm btn-block" :disabled="isLoading">
                <span v-if="isLoading">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  <span class="sr-only">Loading...</span>
                </span>
                Register
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
    name: "RegisterForm",

    data() {
      return {
        form: {
          name: "",
          email: "",
          password: "",
          password_confirmation: "",
        },
        errors: [],
        isLoading: false,
      };
    },

    methods: {
      async register() {
        this.isLoading = true;
        this.errors = [];

        try {
          const res = await user.register(this.form);
          this.$router.push({ name: "Login" });
        } catch (error) {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        } finally {
          this.form = {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
          };

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
