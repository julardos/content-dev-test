<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30"
    ></h1>

    <form
        class="form"
        @submit.prevent="update"
    >
        <h3 v-if="user.is_content_creator">You are registered as Creator</h3>

        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="Name"
                    >Name</label>
                    <input
                        id="name"
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
                        disabled
                    />
                </div>
            </div>

            <template v-if="user.is_content_creator">
                <div class="form__row">
                    <div class="form__item">
                        <label
                            class="form__label"
                            for="expertise"
                        >Expertise</label>
                        <input
                            id="expertise"
                            type="text"
                            v-model="form.expertise"
                            required
                        />
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__item">
                        <label
                            class="form__label"
                            for="description"
                        >Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" v-model="form.description"></textarea>
                    </div>
                </div>

                <div class="form__row">
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
                        <small>*Type with separation coma (,). Example=Technology, Music, Film</small>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__item">
                        <label
                            class="form__label"
                            for="subscription_fee"
                        >Subscription Fee</label>
                        <div class="input-group">
                            <div class="input-group-prepend ">
                                <span class="input-group-text " style="height: 50px">Rp.</span>
                            </div>
                            <input
                                id="subscription_fee"
                                type="number"
                                step="1000"
                                v-model="form.subscription_fee"
                                required
                                class="form-control"
                            />
                            <div class="input-group-append">
                                <span class="input-group-text" style="height: 50px">/month</span>
                            </div>
                        </div>
                        <small>*You can fill 0 or above</small>
                    </div>
                </div>
            </template>

            <div class="form__row">
                <div class="form__action">
                    <Button
                        text="Update"
                        :disabled="form.processing"
                    />
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import { useForm } from "@inertiajs/vue3";

    import AppLayout from "@js/Layouts/App.vue";

    export default {
        layout: AppLayout,

        props: {
            user: Object,
            profile: Object
        },

        data() {
            return {
                title: "Edit Account",
                form: useForm({
                    name: this.user.name,
                    email: this.user.email,
                    password: "",
                    expertise: this.profile?.expertise,
                    genres: this.profile?.genres,
                    description: this.profile?.description,
                    subscription_fee: this.profile?.subscription_fee,
                }),
            };
        },

        methods: {
            update() {
                this.form.patch(route("account.update"), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
