<template>
<div class="login">
    <div class=" login-img">
        <h1>MCJ UNIVERSITY</h1>
        <img src="/images/campus.jpg" alt="" />
    </div>
    <div class="login-form">
        <div class="logo"><img src="/images/logo.png" alt="" /></div>
        <div class="form">
            <form @submit.prevent="login">
                <input type="text" v-model="account.username" placeholder="Username" /><br />
                <input type="password" v-model="account.password" placeholder="Password" /><br />
                <button>LOGIN</button><br />
            </form>

            <a href="">LOGIN AS GUEST</a>
            <p class="error-message">
                {{ error }}
            </p>
        </div>
    </div>
</div>
</template>

<script>
import {
    host
} from "../host.js";
export default {
    data() {
        return {
            account: {
                username: "",
                password: ""
            },
            error: ""
        };
    },
    methods: {
        login() {
            this.axios
                .post(host + `/login`, this.account)
                .then(response => this.message(response.data))
                .catch(error => console.log(error))
                .finally(() => (this.loading = false));
        },
        message(message) {
            if (message == "Success") {
                window.location.href = "\home";
            } else {
                this.error = "Incorrect username or password";
            }
        }
    }
};
</script>
