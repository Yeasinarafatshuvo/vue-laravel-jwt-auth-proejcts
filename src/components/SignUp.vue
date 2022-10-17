<template>
  <div class="register container">
    <div>
      <h1>Sign Up Page</h1>
    </div>
    <input type="text" placeholder="Enter name" v-model="name" />
    <input type="text" placeholder="Enter email" v-model="email" />
    <input type="text" placeholder="Enter phone number" v-model="phone_no" />
    <input type="text" placeholder="Enter password" v-model="password" />
    <input
      type="text"
      placeholder="Confrim password"
      v-model="password_confirmation"
    />
    <button @click="signUp">Sign Up</button>
    <p>
      <router-link to="/login">Login</router-link>
    </p>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "SignUp",
  data() {
    return {
      name: "",
      email: "",
      phone_no: "",
      password: "",
      password_confirmation: "",
    };
  },
  methods: {
    async signUp() {
      let result = await axios
        .post("http://127.0.0.1:8000/api/register", {
          name: this.name,
          email: this.email,
          phone_no: this.phone_no,
          password: this.password,
          password_confirmation: this.password_confirmation,
        })
        .then((response) => {
          if (response.status == 200) {
            alert("You are registered successfully");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style></style>
