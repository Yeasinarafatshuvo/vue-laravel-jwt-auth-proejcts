<template>
  <Header />
  <h1>This is Home page</h1>
</template>

<script>
import Header from "../components/Header.vue";
export default {
  name: "Home",
  components: {
    Header,
  },

  mounted() {
    let user = localStorage.getItem("user-token");
    if (!user) {
      this.$router.push({ name: "Login" });
    }
  },
};
</script>

<style></style>
