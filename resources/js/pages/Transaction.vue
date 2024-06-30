<template>
    <Layout>
        <template v-slot:content>
            <div class="container margin_60_40">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="box_booking_2 style_2">
                            <div class="head">
                                <div class="title">
                                    <h3>Thông tin cá nhân</h3>
                                </div>
                            </div>
                            <!-- /head -->
                            <div class="main">
                                <!-- Personal information inputs -->
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input
                                        class="form-control"
                                        v-model="userInfo.name"
                                        placeholder="First and Last Name"
                                    />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input
                                                class="form-control"
                                                v-model="userInfo.email"
                                                placeholder="Email Address"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input
                                                class="form-control"
                                                v-model="userInfo.phone"
                                                placeholder="Phone"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input
                                        class="form-control"
                                        v-model="userInfo.address"
                                        placeholder="Full Address"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /col -->
                    <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
                        <div class="box_booking">
                            <div class="head">
                                <h3>Tóm tắt hoá đơn</h3>
                            </div>
                            <!-- /head -->
                            <div class="main">
                                <ul class="clearfix">
                                    <!-- Iterate over cart items and display each item -->
                                    <li
                                        v-for="(item, index) in cart"
                                        :key="index"
                                    >
                                        <a href="#0"
                                            >{{ item.name }} x
                                            {{ item.quantity }}</a
                                        ><span>{{
                                            formatCurrency(
                                                item.price * item.quantity
                                            )
                                        }}</span>
                                    </li>
                                </ul>

                                <!-- Order summary totals -->
                                <ul class="clearfix">
                                    <li>
                                        Tổng phụ<span>{{
                                            formatCurrency(subtotal)
                                        }}</span>
                                    </li>
                                    <li>
                                        Phí giao hàng<span>{{
                                            formatCurrency(shippingFee)
                                        }}</span>
                                    </li>
                                    <li>
                                        Mã giảm giá<span>{{
                                            formatCurrency(discountAmount)
                                        }}</span>
                                    </li>
                                    <li class="total">
                                        TỔNG CỘNG<span>{{
                                            formatCurrency(total)
                                        }}</span>
                                    </li>
                                </ul>
                                <a
                                    href="/checkout"
                                    class="btn_1 full-width mb_5"
                                    >Đặt hàng ngay</a
                                >
                                <div class="text-center">
                                    <small
                                        >Hoặc gọi cho chúng tôi theo số
                                        <strong>037530702</strong></small
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- /box_booking -->
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </template>
    </Layout>
</template>

<script setup>
import Layout from "../layouts/Index.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import { useCartStore } from "../stores/useCartStore";

const userInfo = ref({
    name: "",
    email: "",
    phone: "",
    address: "",
});

const cartStore = useCartStore();

const cart = ref([]);
const subtotal = ref(0);
const shippingFee = ref(0);
const discountAmount = ref(0);
const total = ref(0);

const formatCurrency = (value) => {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(value);
};

onMounted(async () => {
    try {
        const response = await axios.get("/api/user");
        const users = response.data.users;
        console.log("dsa", response.data.users);
        userInfo.value = {
            name: users.name,
            email: users.email,
            phone: users.phone,
            address: users.address,
        };

        // Load cart data and calculate totals
        cart.value = cartStore.cart;
        subtotal.value = cartStore.subtotal;
        shippingFee.value = cartStore.shippingFee;
        discountAmount.value = cartStore.discountAmount;
        total.value = cartStore.total;
    } catch (error) {
        console.error("Error fetching data:", error);
        // Handle error fetching data
    }
});
</script>
