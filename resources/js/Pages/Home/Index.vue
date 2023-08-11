<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30"
    ></h1>

    <PostList :posts="posts" :user="auth.user" :following="auth.following"></PostList>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";
    import PostList from "@js/Components/PostList.vue";

    export default {
        layout: AppLayout,

        props: {
            posts: Object,
            auth: Object,
        },

        components: {
            PostList
        },

        data() {
            return {
                title: "Home",
            };
        },
    };
</script>
