/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//FRONT OFFICE

window.Vue = require("vue");
// window.axios = require("axios");  globale

// INIT VUE MAIN INSTANCE
import App from "./App.vue";
import router from "./routes";

const root = new Vue({
    el: "#root",
    router: router,
    render: h => h(App)
});
