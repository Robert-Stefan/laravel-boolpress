<template>
    <div class="container">
        <h1>Contact US</h1>

        <p>lorem ipsum dolor sit amet</p>

        <form @submit.prevent="postForm">
            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" id="name" />
            </div>

            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" />
            </div>

            <div class="form-group">
                <label for="message">Message*</label>
                <textarea id="message" cols="30" rows="10"></textarea>
            </div>

            <button type="submit">Send</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Contact",
    methods: {
        postForm() {
            console.log("Post form data here");
        }
    }
};
</script>

<style lang="scss" scoped>
.form-group {
    margin-bottom: 1rem;
}
label {
    display: block;
}
</style>
