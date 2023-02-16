<template>
  <h1>Home Page</h1>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      loading: false,
    };
  },
  mounted() {
    console.log("hello");
  },
}
</script>

<style scoped>
h1 {
  color: purple;
}
</style>