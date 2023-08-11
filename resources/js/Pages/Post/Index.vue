<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="d-mb-40 m-mb-30"
    ></h1>

    <div class="my-2" v-if="auth.user.is_content_creator">
        <a :href="route('post.create')" class="btn btn-success py-2 px-4">Add Post</a>
    </div>
    <div v-else>
        <h5>You cannot posting</h5>
        <div class="alert alert-info">You must register as content creator for posting</div>
    </div>

    <PostList :posts="posts" :user="auth.user" v-if="auth.user.is_content_creator"></PostList>
</template>

<script>
    import AppLayout from "@js/Layouts/App.vue";
    import PostList from "../../Components/PostList.vue";

    export default {
        layout: AppLayout,

        props: {
            posts: Object,
            auth: Object,
        },

        components: {PostList},

        data() {
            return {
                title: "Your Posts",
            };
        },

    };
</script>
