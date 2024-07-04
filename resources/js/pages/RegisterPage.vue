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
                            <form @submit.prevent="register">
                                <ErrorMessage :message="errorMessage" />
                                <MDBInput
                                    type="text"
                                    label="Họ và tên"
                                    id="name"
                                    v-model="name"
                                    wrapperClass="mb-4"
                                />
                                <MDBRow class="mb-4">
                                    <MDBCol>
                                        <MDBInput
                                            type="email"
                                            label="Email"
                                            id="email"
                                            v-model="email"
                                        />
                                    </MDBCol>
                                    <MDBCol>
                                        <MDBInput
                                            type="text"
                                            label="Phone"
                                            id="phone"
                                            v-model="phone"
                                        />
                                    </MDBCol>
                                </MDBRow>
                                <MDBInput
                                    type="text"
                                    label="Địa chỉ"
                                    id="address"
                                    v-model="address"
                                    wrapperClass="mb-4"
                                />
                                <MDBInput
                                    type="password"
                                    label="Mật khẩu"
                                    id="password"
                                    v-model="password"
                                    wrapperClass="mb-4"
                                />
                                <MDBInput
                                    type="password"
                                    label="Nhập lại mật khẩu"
                                    id="rePassword"
                                    v-model="confirmPassword"
                                    wrapperClass="mb-4"
                                />
                                <!-- Checkbox -->
                                <MDBCheckbox
                                    label="Đồng ý với điều khoản của chúng tôi!"
                                    id="agreeTerms"
                                    v-model="agreeTerms"
                                    wrapperClass="d-flex justify-content-center mb-4"
                                />
                                <!-- Submit button -->
                                <MDBBtn
                                    color="primary"
                                    block
                                    class="btn btn-primary btn-block mb-4"
                                    type="submit"
                                >
                                    Đăng ký
                                </MDBBtn>
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
import { useToast } from "vue-toastification";
import Layout from "../layouts/Index.vue";
import "mdb-vue-ui-kit/css/mdb.min.css";
import { MDBRow, MDBCol, MDBInput, MDBCheckbox, MDBBtn } from "mdb-vue-ui-kit";
import ErrorMessage from "../components/ErrorMessage.vue";

export default {
    components: {
        Layout,
        MDBRow,
        MDBCol,
        MDBInput,
        MDBCheckbox,
        MDBBtn,
        ErrorMessage,
    },
    setup() {
        const name = ref("");
        const email = ref("");
        const phone = ref("");
        const address = ref("");
        const password = ref("");
        const confirmPassword = ref("");
        const agreeTerms = ref(false);
        const errorMessage = ref("");
        const toast = useToast();

        const register = async () => {
            if (password.value !== confirmPassword.value) {
                errorMessage.value =
                    "Mật khẩu và xác nhận mật khẩu không khớp!";
                return;
            }
            if (!agreeTerms.value) {
                errorMessage.value =
                    "Bạn phải đồng ý với điều khoản của chúng tôi!";
                return;
            }

            try {
                const response = await axios.post("/api/register", {
                    name: name.value,
                    email: email.value,
                    phone: phone.value,
                    address: address.value,
                    password: password.value,
                    password_confirmation: confirmPassword.value,
                });

                if (response.data.success) {
                    toast.success("Đăng ký thành công!");
                    window.location.href = "/login";
                } else {
                    toast.error(
                        "Đăng ký thất bại. Vui lòng kiểm tra lại thông tin."
                    );
                }
            } catch (error) {
                console.error("Registration error:", error);
                errorMessage.value =
                    "Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại sau.";
            }
        };

        return {
            name,
            email,
            phone,
            address,
            password,
            confirmPassword,
            agreeTerms,
            errorMessage,
            register,
        };
    },
};
</script>
