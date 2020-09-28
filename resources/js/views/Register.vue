<template>
  <div class="d-flex justify-content-center align-items-center register">
    <div class="card" style="max-width: 400px; min-width: 350px">
      <h4 class="card-header text-center py-1">Register</h4>
      <div class="card-body">
        <form @submit.prevent="handleRegister">
          <div class="form-group">
            <label for="name">Name:</label>
            <input
              type="text"
              v-model="form.name"
              class="form-control form-control-sm"
              id="name"
              placeholder="Jame Smith"
            />
            <span class="text-danger error-text" v-if="registerErrors.name">{{
              registerErrors.name[0]
            }}</span>
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
            <span class="text-danger error-text" v-if="registerErrors.email">{{
              registerErrors.email[0]
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
            <span
              class="text-danger error-text"
              v-if="registerErrors.password"
              >{{ registerErrors.password[0] }}</span
            >
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
              v-if="registerErrors.password_confirmation"
              >{{ registerErrors.password_confirmation[0] }}</span
            >
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
              <span class="sr-only">Loading...</span>
            </span>
            Register
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";
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
      };
    },

    computed: {
      ...mapGetters(["loading", "registerErrors", "isRegistered"]),
    },

    methods: {
      ...mapActions(["register", "clearErrors"]),

      async handleRegister() {
        this.clearErrors('registerErrors');

        await this.register(this.form);

        if (this.isRegistered) {
          this.$router.push({ name: "LoginPage" });
        }
      },
    },
  };
</script>

<style scoped>
  .register {
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
