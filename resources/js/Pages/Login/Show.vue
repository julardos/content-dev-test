<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30 text-center"
    ></h1>

    <form
        class="form"
        @submit.prevent="login"
    >
        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="email"
                    >Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="password"
                    >Password</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label form__label--inline"
                        for="remember"
                    >
                        <input
                            id="remember"
                            type="checkbox"
                            v-model="form.remember"
                        />
                        Remember
                    </label>
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <Button
                        text="Log In"
                        styles="full"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>

    <div class="d-mt-30 m-mt-15 text-center">
        <p>or Login With :</p>
        <div class="row justify-content-center">
            <div class="col-2">
                <GoogleButton></GoogleButton>
            </div>
            <div class="col-2">
                <FacebookButton></FacebookButton>
            </div>
        </div>
    </div>

    <div class="d-mt-30 m-mt-15 text-center">
        <p>
            <Link :href="route('register')">Register</Link>
        </p>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    import AppLayout from "@js/Layouts/App.vue";
    import GoogleButton from "../../Components/GoogleButton.vue";
    import FacebookButton from "../../Components/FacebookButton.vue";

    export default {
        layout: AppLayout,

        components: {GoogleButton, FacebookButton},

        props: {
            email: String,
            password: String,
            remember: Boolean,
            redirect: String,
        },

        data() {
            return {
                title: "Log In",
                form: useForm({
                    email: this.email,
                    password: this.password,
                    remember: this.remember,
                    redirect: this.redirect,
                }),
            };
        },

        methods: {
            login() {
                this.form.post(route("login.store"));
            },
        },
    };
</script>
