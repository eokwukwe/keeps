import Home from "./views/Home.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Dashboard from "./views/Dashboard.vue";

export const routes = [
    {
        path: '/',
        name: 'HomePage',
        component: Home
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: { guestOnly: true }
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: { guestOnly: true }
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        meta: { authOnly: true }
    }
];
