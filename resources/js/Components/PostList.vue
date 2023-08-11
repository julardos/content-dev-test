<script>
    export default {
        name: "PostList",
        props: {
            posts: Object,
            user: Object,
            following: Array,
        },
        methods:{
            checkPrivatePost(post) {
                return post.is_private && this.user.id !== post.user.id && !this.following.includes(post.user.id)
            }
        }
    }
</script>

<template>
    <div class="row">
        <div class="col-6" v-for="post in posts">
            <div class="card mb-3">
                <img :src="checkPrivatePost(post) ? 'photos/default_image.png' : post.photo_path" class="card-img-top" alt="Post Photo">
                <div class="card-body">
                    <div class="row my-2 mb-3">
                        <div class="col-6">
                            <small v-if="!post.user.is_content_creator || user.id === post.user.id">By {{ post.user.name}}</small>
                            <a v-else :href="route('account.show', post.user.id)"><small>By {{ post.user.name}}</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <small>at {{ post.published_at}}</small>
                        </div>
                    </div>

                    <p v-if="!checkPrivatePost(post)">{{ post.caption }}</p>
                    <div v-else>
                        <p class="text-center">Content Locked</p>
                        <a :href="route('account.show', post.user.id)"  class="btn btn-danger px-3 py-2 w-100">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
