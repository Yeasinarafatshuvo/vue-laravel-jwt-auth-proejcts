<template>
  <h1>Login page</h1>
  <div class="login container">
    <input type="text" placeholder="Enter email" v-model="email" />
    <input type="text" placeholder="Enter password" v-model="password" />
    <button @click="login">Login</button>
    <p>
      <router-link to="/sign_up">Sign up</router-link>
    </p>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async login() {
      let result = await axios
        .post("http://127.0.0.1:8000/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          console.log(response.data);
          if (response.status == 201) {
            localStorage.setItem("user-token", response.data.access_token);
            this.$router.push({ name: "Home" });
            alert("You are Login successfully");
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            alert("Please, enter valid email and password");
          }
          console.log(error);
        });
    },
  },
  mounted() {
    let user = localStorage.getItem("user-token");
    if (user) {
      this.$router.push({ name: "Home" });
    }
  },
};
</script>

<style></style>
