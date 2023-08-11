<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30"
    ></h1>

    <form
        class="form"
        @submit.prevent="create"
    >
        <div class="form__section">
            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="photo"
                    >Photo</label>
                    <input
                        id="photo"
                        type="file"
                        required
                    />
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="caption"
                    >Caption</label>
                    <textarea name="caption" id="caption" cols="30" rows="10" v-model="form.caption"></textarea>
                </div>
            </div>

            <div class="form__row">
                <div class="form__item">
                    <label
                        class="form__label"
                        for="published_at"
                    >Publish Date</label>
                    <input
                        id="published_at"
                        type="datetime-local"
                        required
                    />
                </div>
            </div>

            <div class="form__row" >
                <div class="form-check">
                    <input
                        id="is_private"
                        type="checkbox"
                        class="form-check-input"
                        v-model="form.is_private"
                        required
                    />
                    <label
                        class="form-check-label"
                        for="is_private"
                    >&nbsp;Private Post?</label>
                </div>
            </div>

            <div class="form__row">
                <div class="form__action">
                    <Button
                        text="Submit On Development"
                        styles="full"
                        :disabled="true"
                    />
                </div>
            </div>
        </div>
    </form>

</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";
    import PostList from "../../Components/PostList.vue";
    import {useForm} from "@inertiajs/vue3";

    export default {
        layout: AppLayout,

        props: {
            post: Object,
        },

        components: {PostList},

        data() {
            return {
                title: "Create Post",
                form: useForm({
                    photo: '',
                    caption: this.post?.caption || '',
                    published_at: this.post?.published_at || new Date(),
                    is_private: this.post?.is_private || false,
                }),
            };
        },

        methods: {
            create()
            {

            }
        }
    };
</script>
