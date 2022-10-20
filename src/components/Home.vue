<template>
  <Header />
  <div class="container" v-if="user_name">
    <h2 class="bg-primary">Total course of {{ user_name }}</h2>
    <div v-if="total_courses.length">
      <table class="table table-bordered">
        <thead class="bg-primary">
          <th>Title</th>
          <th>Description</th>
          <th>Total videos</th>
          <th>Action</th>
        </thead>
        <tbody>
          <tr v-for="item in total_courses" :key="item.id">
            <td>{{ item.title }}</td>
            <td>{{ item.description }}</td>
            <td>{{ item.total_videos }}</td>
            <td>
              <button class="btn btn-success btn-sm">
                <router-link
                  style="text-decoration: none; color: white"
                  :to="'/edit_course/' + item.id"
                  >Update</router-link
                >
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="delete_course(item.id)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import axios from "axios";
export default {
  name: "Home",
  components: {
    Header,
  },

  data() {
    return {
      user_name: "",
      total_courses: [],
    };
  },
  methods: {
    async load_user_course_data() {
      await axios
        .get("http://127.0.0.1:8000/api/total-courses", {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          this.total_courses = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async load_profile_data() {
      await axios
        .get("http://127.0.0.1:8000/api/profile", {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          this.user_name = response.data.data.name;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async delete_course(course_id) {
      await axios
        .get("http://127.0.0.1:8000/api/delete-course/" + course_id, {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          if (response.status == 201) {
            this.load_user_course_data();
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

    this.load_profile_data();
    this.load_user_course_data();
  },
};
</script>

<style></style>
