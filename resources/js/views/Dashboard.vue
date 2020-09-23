<template>
  <div class="home col-8 mx-auto">
    <h1>Dashboard</h1>
    <div class="card">
      <div class="card-body" v-if="user">
        <h3>Hello, {{ user.name }}</h3>
        <span>{{ user.email }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import user from '../apis/user'

export default {
  data() {
    return {
      user: null
    };
  },
  mounted() {
    user.auth().then(response => {
      this.user = response.data;
    });
  }
};
</script>
