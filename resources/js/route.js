import Vue from "vue";
import VueRouter from "vue-router";

import ExampleComponent from "./components/ExampleComponent.vue";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history"
});

export const routes = [
    {
        path: "/",
        component: ExampleComponent
    }
];