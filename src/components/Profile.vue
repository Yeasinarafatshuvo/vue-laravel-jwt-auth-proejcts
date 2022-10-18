<template>
  <Header />

  <div class="container" v-if="profile.name">
    <h2 class="bg-success">User Profile of {{ profile.name }}</h2>
    <table class="table table-bordered">
      <thead class="bg-primary">
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
      </thead>
      <tbody>
        <tr>
          <td>{{ profile.name }}</td>
          <td>{{ profile.email }}</td>
          <td>{{ profile.phone_no }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import axios from "axios";
export default {
  name: "Profile",
  components: {
    Header,
  },
  data() {
    return {
      profile: "",
    };
  },

  methods: {
    async loadProfileData() {
      await axios
        .get("http://127.0.0.1:8000/api/profile", {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          this.profile = response.data.data;
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

    this.loadProfileData();
  },
};
</script>

<style></style>
