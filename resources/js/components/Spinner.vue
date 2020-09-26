<template>
  <div id="spinner">
    <div
      class="spinner-border text-primary"
      style="width: 5rem; height: 5rem"
      role="status"
    >
      <span class="sr-only">Loading...</span>
    </div>
  </div>
</template>

<script>
  export default {};
</script>

<style scoped>
  #spinner {
    height: calc(100vh - 40px);
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
