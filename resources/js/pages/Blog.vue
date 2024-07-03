<template>
    <Layout>
        <template v-slot:content>
            <div class="container margin_60_40" style="margin-top: 5em">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div
                                v-for="post in paginatedPosts"
                                :key="post.id"
                                class="col-md-6"
                            >
                                <article class="blog">
                                    <figure>
                                        <a :href="'blog/posts?id=' + post.id">
                                            <img
                                                :src="post.image"
                                                alt="Post Image"
                                            />
                                            <div class="preview">
                                                <span>Xem thêm</span>
                                            </div>
                                        </a>
                                    </figure>
                                    <div class="post_info">
                                        <small
                                            >{{ post.category.name }} -
                                            {{ formatDate(post.created_at) }}
                                        </small>
                                        <h2>
                                            <a
                                                :href="
                                                    'blog/post?id=' + post.id
                                                "
                                                >{{ post.title }}</a
                                            >
                                        </h2>
                                        <p>{{ post.description }}</p>
                                        <ul>
                                            <li>
                                                <div class="thumb">
                                                    <img
                                                        src="img/avatar.jpg"
                                                        alt="Admin Avatar"
                                                    />
                                                </div>
                                                {{ post.user.name }}
                                            </li>
                                            <li>
                                                <i class="icon_comment_alt"></i>
                                                44
                                                <!-- {{ post.comments_count }} -->
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <!-- /article -->
                            </div>
                            <!-- /col -->
                            <div class="pagination-container">
                                <Paginate
                                    v-model="currentPage"
                                    :page-count="pageCount"
                                    :click-handler="handlePageClick"
                                    :container-class="'pagination'"
                                    :page-class="'page-item'"
                                    :page-link-class="'page-link'"
                                    :prev-text="'&laquo;'"
                                    :next-text="'&raquo;'"
                                ></Paginate>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /col -->

                    <aside class="col-lg-3">
                        <!-- Widget Area - Latest Posts -->
                        <div class="widget">
                            <div class="widget-title first">
                                <h4>Bài đăng Mới nhất</h4>
                            </div>
                            <ul class="comments-list">
                                <li
                                    v-for="latestPost in latestPosts"
                                    :key="latestPost.id"
                                >
                                    <div class="alignleft">
                                        <a
                                            :href="
                                                'blog/posts?id=' + latestPost.id
                                            "
                                        >
                                            <img
                                                :src="latestPost.image"
                                                alt="Latest Post Image"
                                            />
                                        </a>
                                    </div>
                                    <small
                                        >{{ latestPost.category.name }} -
                                        {{
                                            formatDateCat(latestPost.created_at)
                                        }}</small
                                    >
                                    <h3>
                                        <a
                                            :href="
                                                'blog/posts?id=' + latestPost.id
                                            "
                                            >{{ latestPost.title }}</a
                                        >
                                    </h3>
                                </li>
                            </ul>
                        </div>
                        <!-- /widget -->

                        <!-- Widget Area - Categories -->
                        <div class="widget">
                            <div class="widget-title">
                                <h4>Thể loại</h4>
                            </div>
                            <ul class="cats">
                                <li
                                    v-for="category in categories"
                                    :key="category.id"
                                >
                                    <a
                                        href="#"
                                        @click.prevent="
                                            filterByCategory(category.name)
                                        "
                                    >
                                        {{ category.name }}
                                        <span
                                            >({{ category.posts_count }})</span
                                        >
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /widget -->
                    </aside>
                    <!-- /aside -->
                </div>
                <!-- /row -->
            </div>
        </template>
    </Layout>
</template>

<script>
import Layout from "../layouts/Index.vue";
import axios from "axios";
import Paginate from "vuejs-paginate-next";
import { format } from "date-fns";
import { vi } from "date-fns/locale";
export default {
    name: "Blog",
    components: {
        Layout,
        Paginate,
    },
    data() {
        return {
            posts: [],
            latestPosts: [],
            categories: [],
            currentPage: 1,
            perPage: 4,
            selectedCategory: null,
        };
    },
    computed: {
        pageCount() {
            return Math.ceil(this.posts.length / this.perPage);
        },
        paginatedPosts() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.posts.slice(start, end);
        },
    },
    created() {
        this.fetchPosts();
        this.fetchLatestPosts();
    },
    methods: {
        fetchPosts() {
            const params = this.selectedCategory
                ? { category: this.selectedCategory }
                : {};
            axios
                .get("/api/blog/posts", { params })
                .then((response) => {
                    this.posts = response.data.posts;
                    this.categories = response.data.categories;
                    this.currentPage = 1;
                })
                .catch((error) => {
                    console.error("Error fetching blog posts:", error);
                });
        },
        handlePageClick(pageNum) {
            this.currentPage = pageNum;
        },
        fetchLatestPosts() {
            axios
                .get("/api/blog/latest")
                .then((response) => {
                    this.latestPosts = response.data.slice(0, 3);
                })
                .catch((error) => {
                    console.error("Error fetching latest posts:", error);
                });
        },
        filterByCategory(categoryName) {
            this.selectedCategory = categoryName;
            this.fetchPosts();
        },
        formatDate(dateString) {
            return format(new Date(dateString), "dd 'tháng' MM 'năm' yyyy", {
                locale: vi,
            });
        },
        formatDateCat(dateString) {
            return format(new Date(dateString), "dd.MM.yyyy");
        },
    },
};
</script>
<style scoped>
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
</style>
