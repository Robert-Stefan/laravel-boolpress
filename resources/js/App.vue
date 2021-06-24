<template>
    <div>
        <Header />

        <main>
            <div class="container">
                <h1>Blog</h1>

                Posts list
            </div>
        </main>
    </div>
</template>

<script>
import Header from "./components/Header.vue";

export default {
    name: "App",
    components: {
        Header
    },
    created() {
        console.log(axios);
    }
};
</script>

<style lang="scss">
@import "../sass/frontoffice/utilities";
body {
    font-family: sans-serif;
}
</style>
