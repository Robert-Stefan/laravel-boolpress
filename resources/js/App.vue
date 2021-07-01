<template>
    <v-app>
        <Header />

        <main>
            <router-view></router-view>
        </main>
    </v-app>
</template>

<script>
import axios from "axios"; //import parziale non globale
import Header from "./components/Header.vue";

export default {
    name: "App",
    components: {
        Header
    }
};
</script>

<style lang="scss">
// @import "~vuetify/dist/vuetify.min.css";
@import "../sass/frontoffice/utilities";
body {
    font-family: sans-serif;
}

.navigation {
    .active-page {
        background: lightblue;
    }
}
</style>
