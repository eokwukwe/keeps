<template>
  <div>
    <spinner v-if="loading" />

    <div v-else class="home pt-5">
      <h3 class="mb-2">Your Resources</h3>
      <div class="row">
        <div
          class="col-md-6 mb-3"
          v-for="(material, i) in materials"
          :key="i"
        >
          <study-material-card :material="material" />
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
    data() {
      return {
        materials: [
          {
            _id: "1",
            title: "Form validation with Next.js/React part 2",
            description:
              "Learn how to validate custom input components with 'react hook form'",
            link: "https://www.youtube.com/watch?v=fm_UA4_0XBE",
            type: "video",
            category: "react",
          },
          {
            _id: "2",
            title: "Setup project from Github",
            description:
              "Short guide how to setup a starting project in order to work on my tutorials.",
            link: "https://eincode.com/blogs/setup-project-from-github-repo",
            type: "blog",
            category: "github",
          },
          {
            _id: "3",
            title: "React hook form validation",
            description: "Custom form validation with react hooks",
            link:
              "https://eincode.com/blogs/learn-how-to-validate-custom-input-components-with-react-hook-form",
            type: "blog",
          },
        ],
      };
    },

    components: { Spinner, StudyMaterialCard, Sidebar },

    computed: {
      ...mapGetters(["loggedInUser", "loading"]),
    },

    methods: {
      ...mapActions(["getLoggedInUser"]),
    },

    mounted() {
      this.getLoggedInUser();
    },
  };
</script>

<style scoped>
  .material-card {
    gap: 20 !important;
  }
</style>
