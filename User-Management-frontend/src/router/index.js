import { createRouter, createWebHistory } from "vue-router";
import Home from "@/components/Home.vue";
import Registration  from "@/components/Registration.vue";
import Login from "@/components/Login.vue";
import Search from "@/components/Search.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home
    },
    {
        path: "/register",
        name: "Registration",
        component: Registration,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: '/searchByName',
        name: "SearchByName",
        component: Search
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;