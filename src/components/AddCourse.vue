<template>
  <Header />
  <h1>Add course</h1>
  <div class="container add_course">
    <input type="text" placeholder="Enter Course Title" v-model="title" />
    <input
      type="text"
      placeholder="Enter Course Description"
      v-model="description"
    />
    <input
      type="text"
      placeholder="Enter total videos"
      v-model="total_videos"
    />

    <button @click="add_course">Add Course</button>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
export default {
  name: "AddCourse",
  components: {
    Header,
  },
  data() {
    return {
      title: "",
      description: "",
      total_videos: "",
    };
  },
  methods: {
    add_course() {
      console.log(this.title, this.description, this.total_videos);
    },
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
