<template>
    <div class="container">
        <h1>Contact US</h1>

        <p>lorem ipsum dolor sit amet</p>

        <div v-show="success" class="success-message">
            Message sent successfully.
        </div>

        <form @submit.prevent="postForm">
            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" id="name" v-model="name" />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.name"
                    :key="`err-name-${index}`"
                >
                    {{ error }}
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" v-model="email" />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.email"
                    :key="`err-email-${index}`"
                >
                    {{ error }}
                </div>
            </div>

            <div class="form-group">
                <label for="message">Message*</label>
                <textarea
                    id="message"
                    cols="30"
                    rows="10"
                    v-model="message"
                ></textarea>
                <div
                    class="error-message"
                    v-for="(error, index) in errors.message"
                    :key="`err-message-${index}`"
                >
                    {{ error }}
                </div>
            </div>

            <button type="submit" :disabled="sending">
                {{ sending ? "Sending..." : "Send" }}
            </button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Contact",
    data() {
        return {
            name: "",
            email: "",
            message: "",
            errors: {},
            success: false,
            sending: false
        };
    },
    methods: {
        postForm() {
            // console.log("Post form data here");

            this.sending = true;

            axios
                .post("http://127.0.0.1:8000/api/contacts", {
                    name: this.name,
                    email: this.email,
                    message: this.message
                })
                .then(res => {
                    console.log(res.data);
                    this.sending = false;
                    if (res.data.errors) {
                        this.errors = res.data.errors;
                        this.success = false;
                    } else {
                        this.name = "";
                        this.email = "";
                        this.message = "";

                        this.errors = {};
                        this.success = true;
                    }
                })
                .catch(err => {
                    console.log(err);
                });
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

.error-message {
    color: red;
}

.success-message {
    margin-bottom: 2rem;
    color: green;
    font-size: 1.25rem;
}

button:disabled {
    cursor: not-allowed;
}
</style>
