import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue";
import AddCourse from "../components/AddCourse.vue";
import SignUp from "../components/SignUp.vue";
import Login from "../components/Login.vue";
import Profile from "../components/Profile.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/add_course",
    name: "AddCourse",
    component: AddCourse,
  },
  {
    path: "/sign_up",
    name: "SignUp",
    component: SignUp,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/user_profile",
    name: "Profile",
    component: Profile,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
