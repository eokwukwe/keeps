<template>
  <div>
    <spinner v-if="loading" />

    <div v-else class="home pt-5">
      <h3 class="mb-2">Your Resources</h3>
      <div class="row">
        <div v-if="noResource">
          <p>You have not added any resources</p>
        </div>

        <div
          v-else
          class="col-md-6 mb-3"
          v-for="resource in allResources"
          :key="resource.id"
        >
          <study-material-card
            :isDeleting="isDeleting"
            :resource="resource"
            :deleteResource="deleteResource"
          />
        </div>
      </div>

      <sidebar />
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";

  import Spinner from "../components/Spinner";
  import Sidebar from "../components/Sidebar";
  import StudyMaterialCard from "../components/StudyMaterialCard";

  export default {
    components: { Spinner, StudyMaterialCard, Sidebar },

    computed: {
      ...mapGetters(["loggedInUser", "loading", "allResources", "isDeleting"]),

      noResource() {
        return this.allResources.length === 0;
      },
    },

    methods: {
      ...mapActions(["getLoggedInUser", "getAllResources", "deleteResource"]),
    },

    mounted() {
      this.getLoggedInUser();
      this.getAllResources();
    },
  };
</script>

<style scoped>
  .material-card {
    gap: 20 !important;
  }
</style>
