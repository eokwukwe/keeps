<template>
  <b-sidebar id="material-sidebar" title="Add Resource" shadow right lazy>
    <div class="px-3 py-2">
      <form @submit.prevent="handleAdd">
        <div class="form-group">
          <label for="title">Title:</label>
          <input
            type="title"
            id="title"
            v-model="form.title"
            class="form-control form-control-sm"
            placeholder="How to create custom hooks"
          />
          <!-- <span class="text-danger error-text" v-if="loginErrors.email">{{
            loginErrors.email[0]
          }}</span> -->
        </div>
        <div class="form-group">
          <label for="link">Link:</label>
          <input
            type="link"
            id="link"
            v-model="form.link"
            class="form-control form-control-sm"
            placeholder="https://reactjs.org"
          />
          <!-- <span class="text-danger error-text" v-if="loginErrors.password">{{
            loginErrors.password[0]
          }}</span> -->
        </div>
        <div class="mb-4">
          <label for="type">Type:</label>
          <select
            id="type"
            v-model="form.type"
            class="form-control form-control-sm"
          >
            <option
              v-for="resourceType in types"
              :key="resourceType"
              :value="resourceType"
            >
              {{ resourceType }}
            </option>
          </select>
        </div>
        <!-- <button
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
          >Add
        </button> -->
        <button type="submit" class="btn btn-sm btn-primary">add</button>
      </form>
    </div>
  </b-sidebar>
</template>

<script>
  export default {
    name: "Sidebar",

    data() {
      return {
        types: ["blog", "book", "video", "audio"],
        form: {
          title: "",
          link: "",
          type: "",
        },
      };
    },

    methods: {
      handleAdd(e) {
        console.log(this.types);
      }
    }
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
