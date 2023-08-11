<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30 text-center"
    ></h1>

    <form
        class="form"
        @submit.prevent="register"
    >
        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="Name"
                    >Last Name</label>
                    <input
                        id="last-name"
                        type="text"
                        v-model="form.name"
                        required
                    />
                </div>
            </div>

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

            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="form.is_creator"
                    id="is_creator"
                >
                <label class="form-check-label" for="is_creator">
                    &nbsp;Register as Creator
                </label>
            </div>

<!--        TODO: I want to create genres with autocomplete select box when i have time -->
            <div class="form__row" v-if="form.is_creator">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="genres"
                    >Genres</label>
                    <input
                        id="genres"
                        type="text"
                        v-model="form.genres"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <Button
                        text="Register"
                        styles="full"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>

    <div class="d-mt-30 m-mt-15 text-center">
        <p>
            <Link :href="route('login')">Login</Link>
        </p>
    </div>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    import GuestLayout from "@js/Layouts/Guest.vue";

    export default {
        layout: GuestLayout,

        props: {
            name: String,
            email: String,
            password: String,
        },

        data() {
            return {
                title: "Register",
                form: useForm({
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    is_creator: false,
                    genres: null,
                }),
            };
        },

        methods: {
            register() {
                this.form.post(route("register.store"));
            },
        },
    };
</script>
