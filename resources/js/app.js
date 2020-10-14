require("./bootstrap");

window.Vue = require("vue");
import Form from "./form";
window.Form = Form;
import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
import { routes } from "./routes";
import App from "./components/app.vue";

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: "history",
    routes: routes
});

const app = new Vue({
    el: "#app",
    router: router,
    render: h => h(App)
});
