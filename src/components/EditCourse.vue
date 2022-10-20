<template>
  <Header />
  <div class="container">
    <h2>Edit Course</h2>
    <div class="container add_course">
      <input type="text" v-model="title" />
      <input type="text" v-model="description" />
      <input type="text" v-model="total_videos" />
      <button @click="update_course">Update Course</button>
    </div>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import axios from "axios";
export default {
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
    async update_course() {
      await axios
        .put(
          "http://127.0.0.1:8000/api/course-update/" + this.$route.params.id,

          {
            title: this.title,
            description: this.description,
            total_videos: this.total_videos,
          },
          {
            headers: {
              Authorization: `bearer ${localStorage.getItem("user-token")}`,
            },
          }
        )
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({ name: "Home" });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  async mounted() {
    let user = localStorage.getItem("user-token");
    if (!user) {
      this.$router.push({ name: "Login" });
    }

    await axios
      .get(
        "http://127.0.0.1:8000/api/get_single_course/" + this.$route.params.id,
        {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        }
      )
      .then((response) => {
        this.title = response.data.data.title;
        this.description = response.data.data.description;
        this.total_videos = response.data.data.total_videos;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style></style>
