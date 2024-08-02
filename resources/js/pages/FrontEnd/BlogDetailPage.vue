<template>
    <GuestLayout>
        <div class="container margin_60_40">
            <div class="row">
                <div class="col-lg-9">
                    <div class="singlepost" v-if="post">
                        <figure>
                            <img :src="post.image" alt="" class="img-fluid" />
                        </figure>
                        <h1>{{ post.title }}</h1>
                        <div class="postmeta">
                            <ul>
                                <li>
                                    <a href="#"
                                        ><i class="icon_folder-alt"></i>
                                        {{ post.category.name }}</a
                                    >
                                </li>
                                <li>
                                    <i class="icon_calendar"></i>
                                    {{ formatDate(post.created_at) }}
                                </li>
                                <li>
                                    <a href="#"
                                        ><i class="icon_pencil-edit"></i>
                                        {{ post.user.name }}</a
                                    >
                                </li>
                                <li>
                                    <a href="#"
                                        ><i class="icon_comment_alt"></i> ({{
                                            post.comments.length
                                        }}) Bình luận</a
                                    >
                                </li>
                            </ul>
                        </div>
                        <!-- /post meta -->
                        <div class="post-content" v-html="post.content"></div>
                        <!-- /post -->
                    </div>
                    <!-- /single-post -->
                    <div id="comments">
                        <h5>Bình luận</h5>
                        <ul>
                            <li v-for="comment in comments" :key="comment.id">
                                <div class="avatar">
                                    <a href="#"
                                        ><img src="img/avatar1.jpg" alt="" />
                                    </a>
                                </div>

                                <div class="comment_right clearfix">
                                    <div class="comment_info">
                                        {{ comment.name }}
                                        <span>|</span
                                        >{{
                                            formatDateComment(
                                                comment.created_at
                                            )
                                        }}
                                    </div>
                                    <p>{{ comment.content }}</p>
                                </div>
                            </li>
                        </ul>
                        <button
                            v-if="hasMoreComments"
                            @click="loadMoreComments"
                            class="btn_1 mb-3 mt-4"
                        >
                            Thêm bình luận
                        </button>
                    </div>

                    <hr />

                    <h5>Để lại một bình luận:</h5>
                    <div v-if="user && user.name">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input
                                        v-model="user.name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Tên"
                                    />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input
                                        v-model="user.email"
                                        type="email"
                                        class="form-control"
                                        placeholder="Email"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea
                                v-model="content"
                                class="form-control"
                                rows="6"
                                placeholder="Nội dung"
                            ></textarea>
                        </div>
                        <div class="form-group">
                            <button
                                type="submit"
                                id="submit2"
                                class="btn_1 mb-3"
                                @click="submitComment"
                            >
                                Bình luận
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-3">
                    <!-- Latest Posts Widget -->
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
                                    <a :href="'/blog/posts/' + latestPost.id">
                                        <img :src="latestPost.image" alt="" />
                                    </a>
                                </div>
                                <small
                                    >{{ latestPost.category.name }} -
                                    {{
                                        formatDate(latestPost.created_at)
                                    }}</small
                                >
                                <h3>
                                    <a :href="'/blog/posts/' + latestPost.id">{{
                                        latestPost.title
                                    }}</a>
                                </h3>
                            </li>
                        </ul>
                    </div>
                    <!-- /widget -->
                </aside>
                <!-- /aside -->
            </div>
            <!-- /row -->
        </div>
    </GuestLayout>
</template>

<script>
import { ref, onMounted } from "vue";
import GuestLayout from "../../Layouts/GuestLayout.vue";
import axios from "axios";
import { format } from "date-fns";
import { vi } from "date-fns/locale";
import ErrorMessage from "./../../Components/ErrorMessage.vue";
import { useToast } from "vue-toastification";

export default {
    name: "PostDetails",
    components: {
        Layout,
        ErrorMessage,
    },
    props: ["postId"],
    setup(props) {
        const post = ref(null);
        const latestPosts = ref([]);
        const categories = ref([]);
        const content = ref("");
        const errorMessage = ref("");
        const user = ref({
            name: "",
            email: "",
        });
        const comments = ref([]);
        const currentPage = ref(1);
        const hasMoreComments = ref(true);
        const toast = useToast();

        const fetchComments = (page = 1) => {
            axios
                .get(`/api/blog/comments/${props.postId}?page=${page}`)
                .then((response) => {
                    if (response.data.length > 0) {
                        comments.value =
                            page === 1
                                ? response.data
                                : [...comments.value, ...response.data];
                    } else {
                        hasMoreComments.value = false;
                    }
                })
                .catch((error) => {
                    console.error("Error fetching comments:", error);
                });
        };

        const fetchUser = () => {
            const token = localStorage.getItem("authToken");
            if (token) {
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;
                axios
                    .get("/api/user")
                    .then((response) => {
                        user.value = response.data;
                    })
                    .catch((error) => {
                        console.error("Error fetching user:", error);
                    });
            } else {
                errorMessage.value = "Bạn chưa đăng nhập.";
            }
        };

        const fetchPostDetails = (id) => {
            axios
                .get(`/api/blog/posts/${id}`)
                .then((response) => {
                    post.value = response.data.post;
                    latestPosts.value = response.data.latestPosts;
                    categories.value = response.data.categories;
                })
                .catch((error) => {
                    console.error("Error fetching post details:", error);
                });
        };

        const formatDate = (dateString) => {
            return format(new Date(dateString), "dd 'tháng' MM 'năm' yyyy", {
                locale: vi,
            });
        };

        const formatDateComment = (dateString) => {
            return format(new Date(dateString), "dd/MM/yyyy");
        };

        const submitComment = () => {
            const { name, email } = user.value;
            const commentContent = content.value;
            if (!name || !email || !commentContent) {
                errorMessage.value =
                    "Vui lòng nhập đầy đủ thông tin bình luận!";
                return;
            }
            const userId = user.value.id;
            axios
                .post("/api/blog/comments", {
                    content: commentContent,
                    post_id: props.postId,
                    user_id: userId,
                    name,
                    email,
                })
                .then((response) => {
                    toast.success("Bình luận đã được lưu!");
                    content.value = "";
                    fetchComments(1); // Reset bình luận và tải lại từ đầu
                    currentPage.value = 1;
                    hasMoreComments.value = true;
                })
                .catch((error) => {
                    console.error("Lỗi khi lưu bình luận:", error);
                    errorMessage.value = "Lỗi khi lưu bình luận";
                });
        };

        const loadMoreComments = () => {
            currentPage.value++;
            fetchComments(currentPage.value);
        };

        onMounted(() => {
            fetchPostDetails(props.postId);
            fetchUser();
            fetchComments();
        });

        return {
            post,
            latestPosts,
            categories,
            content,
            errorMessage,
            user,
            comments,
            hasMoreComments,
            formatDate,
            formatDateComment,
            submitComment,
            loadMoreComments,
        };
    },
};
</script>

<style scoped>
.no-underline {
    text-decoration: none;
}
</style>
