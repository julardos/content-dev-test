<template>
    <Head :title="title" />

    <h5>{{ user.is_content_creator ? 'Creator' : ''}}</h5>
    <h1
        v-text="user.name"
        class="d-mb-40 m-mb-30"
    ></h1>

    <p>
        {{ user.profile?.description}}
    </p>

    <p>Expertise : {{ user.profile?.expertise }}</p>
    <p>Genres : {{ user.profile?.genres.join(', ') }}</p>

    <div class="text-center">
        <p v-if="auth.following.includes(user.id)">Subscribed</p>
        <button v-else class="btn btn-success" @click="subscribe()">Subscribe This Creator</button>
    </div>

    <hr>

    <h4>Free Access Content</h4>
    <PostList :user="user" :posts="posts"></PostList>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";
    import PostList from "@js/Components/PostList.vue";
    import {router} from "@inertiajs/vue3";

    export default {
        layout: AppLayout,

        props: {
            user: Object,
            posts: Object,
            auth: Array,
        },

        components: {
            PostList
        },

        data() {
            return {
                title: "Profile",
            };
        },

        methods: {
            subscribe() {
                router.post(route("account.subscribe", this.user.id))
            }
        }
    };
</script>
