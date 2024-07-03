<template>
    <Layout>
        <template v-slot:content>
            <div v-if="post">
                <h1>{{ post.title }}</h1>
                <p>{{ post.content }}</p>
            </div>
            <div v-else>
                <p>Loading...</p>
            </div>
        </template>
    </Layout>
</template>

<script>
import Layout from "../layouts/Index.vue";
import axios from "axios";

export default {
    name: "BlogPost",
    components: {
        Layout,
    },
    props: {
        postId: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            post: null,
        };
    },
    created() {
        this.fetchPost();
    },
    methods: {
        fetchPost() {
            axios
                .get(`/api/posts/${this.postId}`)
                .then((response) => {
                    this.post = response.data.post;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>

<style scoped>
/* Your component styles */
</style>
