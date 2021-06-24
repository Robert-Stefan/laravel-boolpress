/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//FRONT OFFICE

window.Vue = require("vue");
window.axios = require("axios");

// INIT VUE MAIN INSTANCE
import App from "./App.vue";

const root = new Vue({
    el: "#root",
    render: h => h(App)
});
