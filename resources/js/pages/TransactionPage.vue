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
                            <div class="main">
                                <div v-if="user">
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input
                                            v-model="user.name"
                                            class="form-control"
                                            placeholder="Họ và tên"
                                        />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input
                                                    v-model="user.email"
                                                    class="form-control"
                                                    placeholder="Địa chỉ Email"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input
                                                    v-model="user.phone"
                                                    class="form-control"
                                                    placeholder="Số điện thoại"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input
                                            v-model="user.address"
                                            class="form-control"
                                            placeholder="Địa chỉ"
                                        />
                                    </div>
                                </div>
                                <div v-else>
                                    <p>THÔNG TIN NGƯỜI DÙNG TRỐNG</p>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <textarea
                                        v-model="note"
                                        class="form-control"
                                        placeholder="Ghi chú"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
                        <div class="box_booking">
                            <div class="head">
                                <h3>Tóm tắt hoá đơn</h3>
                            </div>
                            <div class="main">
                                <ul class="clearfix">
                                    <li v-for="item in cart" :key="item.id">
                                        {{ item.name }} x {{ item.quantity }}
                                        <span>{{
                                            formatCurrency(
                                                item.price * item.quantity
                                            )
                                        }}</span>
                                    </li>
                                </ul>
                                <ul class="clearfix">
                                    <li>
                                        Tổng phụ<span>{{
                                            formatCurrency(cartSubtotal)
                                        }}</span>
                                    </li>
                                    <li>
                                        Phí giao hàng<span>{{
                                            formatCurrency(shippingFee)
                                        }}</span>
                                    </li>
                                    <li v-if="cartStore.discount">
                                        Mã giảm giá:
                                        {{ cartStore.discount.name }}
                                        <span
                                            v-if="
                                                cartStore.discount.condition ===
                                                1
                                            "
                                        >
                                            -{{
                                                formatCurrency(
                                                    cartStore.discount.number
                                                )
                                            }}
                                        </span>
                                        <span v-else>
                                            -{{ cartStore.discount.number }}%
                                        </span>
                                    </li>
                                    <li v-else>
                                        Mã giảm giá<span>{{
                                            formatCurrency(discount)
                                        }}</span>
                                    </li>
                                    <li class="total">
                                        TỔNG CỘNG<span>{{
                                            formatCurrency(total)
                                        }}</span>
                                    </li>
                                </ul>
                                <a
                                    @click="placeOrder"
                                    class="btn_1 full-width mb_5"
                                    >Đặt hàng ngay</a
                                >
                                <div class="text-center">
                                    <small>
                                        Quay lại giỏ hàng
                                        <router-link :to="{ name: 'Cart' }">
                                            <strong>Giỏ hàng</strong>
                                        </router-link>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Layout>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import Layout from "../layouts/Index.vue";
import { useCartStore } from "../stores/useCartStore";
import { useToast } from "vue-toastification";
import axios from "axios";
import { useRouter } from "vue-router";

export default {
    name: "Transaction",
    components: { Layout },
    setup() {
        const cartStore = useCartStore();
        const user = ref(null);
        const errorMessage = ref("");
        const toast = useToast();
        const router = useRouter();
        const shippingFee = 15000;
        const discount = 0;
        const note = ref("");

        onMounted(() => {
            fetchUser();
        });

        const cart = computed(() => cartStore.cart);
        cartStore.loadDiscount();

        const fetchUser = async () => {
            const token = localStorage.getItem("authToken");
            if (token) {
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;
                try {
                    const response = await axios.get("/api/user");
                    if (response.data.status) {
                        user.value = response.data;
                    } else {
                        errorMessage.value = response.data.message;
                    }
                } catch (error) {
                    console.error("Error fetching user:", error);
                    errorMessage.value =
                        "Đã xảy ra lỗi trong quá trình lấy thông tin người dùng.";
                }
            } else {
                errorMessage.value = "Bạn chưa đăng nhập.";
            }
        };

        const formatCurrency = (value) => {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(value);
        };

        const cartSubtotal = computed(() => {
            return cart.value.reduce(
                (acc, item) => acc + item.price * item.quantity,
                0
            );
        });

        const total = computed(() => {
            return cartSubtotal.value + shippingFee - discount;
        });

        const placeOrder = async () => {
            try {
                const response = await axios.post("/api/orders", {
                    items: cart.value.map((item) => ({
                        product_id: item.id,
                        total_item: item.quantity,
                        total_price: item.price * item.quantity,
                    })),
                    total_price: total.value,
                    transport_fee: shippingFee,
                    discount_id: cartStore.discount
                        ? cartStore.discount.id
                        : null,
                    note: note.value,
                    name: user.value.name,
                    email: user.value.email,
                    phone: user.value.phone,
                    address: user.value.address,
                });

                if (response.data.status) {
                    toast.success("Đơn hàng của bạn đã được đặt thành công!");
                    cartStore.clearCart();
                    cartStore.clearDiscount();
                    router.push({ name: "Menu" });
                } else {
                    toast.error(
                        response.data.message || "Đã xảy ra lỗi khi đặt hàng."
                    );
                }
            } catch (error) {
                console.error("Error placing order:", error);
                toast.error("Đã xảy ra lỗi khi đặt hàng.");
            }
        };

        return {
            user,
            cart,
            formatCurrency,
            cartSubtotal,
            shippingFee,
            discount,
            total,
            placeOrder,
            errorMessage,
            cartStore,
            note,
        };
    },
};
</script>
