<template>
  <b-card
    :title="resource.title"
    footer-tag="footer"
    footer-bg-variant="default"
    class="border border-info"
  >
    <template v-slot:footer>
      <div class="d-flex justify-content-between">
        <span>
          <b-badge variant="secondary">{{ resource.type }}</b-badge>
        </span>
        <span>
          <b-button
            size="sm"
            :href="resource.link"
            variant="info"
            class="py-0 px-1"
            rel="noopener noreferrer"
            target="_blank"
          >
            <b-icon icon="folder-symlink-fill"></b-icon>
            Link</b-button
          >
          <b-button
            @click="handleDelete($event, resource.id)"
            size="sm"
            variant="danger"
            class="py-0 px-1"
            :id="resource.id"
          >
            <div
              v-if="loadingIndex && isDeleting"
              role="status"
              class="spinner-border spinner-border-sm text-light"
            >
              <span class="sr-only">Loading...</span>
            </div>
            <b-icon v-else icon="trash"></b-icon>
            Del</b-button
          >
        </span>
      </div>
    </template>
  </b-card>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";

  export default {
    name: "StudyMaterialCard",

    data() {
      return {
        isLoadingIndex: "",
      };
    },

    props: {
      resource: {
        type: Object,
      },
      // deleteResource: Function,
      // isDeleting: Boolean
    },

    computed: {
      ...mapGetters(["isDeleting"]),

      loadingIndex() {
        return this.isLoadingIndex;
      },
    },

    methods: {
      ...mapActions(["deleteResource"]),

      async handleDelete($event, id) {
        this.isLoadingIndex = $event.target.id;

        this.deleteResource(id);

        this.$router.go(0);
      },
    },
  };
</script>

<style scoped>
  .card-body {
    padding: 0rem 1rem;
    padding-top: 0.5rem;
    text-align-last: center;
  }
  .card-title {
    text-transform: capitalize;
    font-size: 1rem;
  }
  .card-footer {
    padding: 0.2rem 1.25rem;
  }
</style>
