<template>
  <b-card
    :title="material.title"
    footer-tag="footer"
    footer-bg-variant="default"
    class="border border-info"
  >
    <template v-slot:footer>
      <div class="d-flex justify-content-between">
        <span>
          <b-badge variant="secondary">{{ material.type }}</b-badge>
        </span>
        <span>
          <b-button
            size="sm"
            :href="material.link"
            variant="info"
            class="py-0 px-1"
          >
            <b-icon icon="folder-symlink-fill"></b-icon>
            Link</b-button
          >
          <b-button size="sm" variant="danger" class="py-0 px-1">
            <b-icon icon="trash"></b-icon>
            Del</b-button
          >
        </span>
      </div>
    </template>
  </b-card>
</template>

<script>
  export default {
    name: "StudyMaterialCard",

    props: {
      material: {
        type: Object,
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
