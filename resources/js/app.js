import Vue from "vue";
import VueRouter from "vue-router";

import { routes } from "./route";
import App from "./components/App.vue";

require("./bootstrap");

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: routes,
});

const app = new Vue({
    el: "#app",
    components: { App },
    router,
    // render: (h) => h(App),
});
