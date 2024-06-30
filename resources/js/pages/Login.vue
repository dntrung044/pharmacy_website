<template>
    <Layout>
        <template v-slot:content>
            <section class="vh-100">
                <div class="container-fluid h-custom">
                    <div
                        class="row d-flex justify-content-center align-items-center h-100"
                    >
                        <div class="col-md-9 col-lg-6 col-xl-5">
                            <img
                                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                                class="img-fluid"
                                alt="Sample image"
                            />
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <form @submit.prevent="login">
                                <ErrorMessage :message="errorMessage" />
                                <MDBInput
                                    type="email"
                                    label="Email"
                                    id="email"
                                    v-model="email"
                                    wrapperClass="mb-4"
                                />
                                <MDBInput
                                    type="password"
                                    label="Mật khẩu"
                                    id="password"
                                    v-model="password"
                                    wrapperClass="mb-4"
                                />
                                <MDBCheckbox
                                    label="Lưu mật khẩu"
                                    id="remember"
                                    v-model="remember"
                                    wrapperClass="d-flex justify-content-between align-items-center"
                                />
                                <div
                                    class="d-flex justify-content-between align-items-center"
                                >
                                    <a href="#" class="text-body"
                                        >Quên mật khẩu?</a
                                    >
                                </div>
                                <MDBBtn
                                    color="primary"
                                    block
                                    class="btn btn-primary btn-block mb-4"
                                    type="submit"
                                >
                                    Login
                                </MDBBtn>
                                <p class="small fw-bold mt-2 pt-1 mb-0">
                                    Bạn chưa có tài khoản
                                    <router-link
                                        to="/register"
                                        class="link-danger"
                                        >Đăng ký</router-link
                                    >
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </Layout>
</template>
<script>
import { ref } from "vue";
import axios from "axios";
import { MDBInput, MDBCheckbox, MDBBtn } from "mdb-vue-ui-kit";
import Layout from "../layouts/Index.vue";
import ErrorMessage from "../components/ErrorMessage.vue"; // Import the error message component
import { useToast } from "vue-toastification";

export default {
    components: {
        MDBInput,
        MDBCheckbox,
        MDBBtn,
        Layout,
        ErrorMessage,
    },
    setup() {
        const email = ref("");
        const password = ref("");
        const remember = ref(false);
        const errorMessage = ref(""); // Add error message ref
        const toast = useToast();

        const login = async () => {
            try {
                const response = await axios.post("/api/login", {
                    email: email.value,
                    password: password.value,
                    remember: remember.value,
                });

                if (response.data.success) {
                    toast.success("Đăng nhập thành công!");
                    window.location.href = "/";
                } else {
                    errorMessage.value =
                        "Vui lòng kiểm tra thông tin đăng nhập của bạn.";
                }
            } catch (error) {
                console.error("Login error:", error);
                errorMessage.value =
                    "Đã xảy ra lỗi trong quá trình đăng nhập. Vui lòng thử lại sau.";
            }
        };

        return {
            email,
            password,
            remember,
            errorMessage,
            login,
        };
    },
};
</script>
