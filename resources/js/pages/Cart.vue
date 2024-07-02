<template>
    <Layout>
        <template v-slot:content>
            <div class="bg_gray" style="margin-top: 5em">
                <div class="container margin_60_40">
                    <table class="table table-striped cart-list">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng phụ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in cartStore.cart" :key="item.id">
                                <td>
                                    <div class="thumb_cart">
                                        <img
                                            :src="item.image"
                                            class="lazy"
                                            alt="Image"
                                        />
                                    </div>
                                    <span class="item_cart">{{
                                        item.name
                                    }}</span>
                                </td>
                                <td>
                                    <strong>
                                        {{ formatCurrency(item.price) }}</strong
                                    >
                                </td>
                                <td>
                                    <div class="numbers-row">
                                        <input
                                            type="number"
                                            v-model.number="item.quantity"
                                            @change="
                                                updateQuantity(
                                                    item.id,
                                                    item.quantity
                                                )
                                            "
                                            class="qty2"
                                        />
                                        <div
                                            class="inc button_inc"
                                            @click="incrementQuantity(item.id)"
                                        >
                                            +
                                        </div>
                                        <div
                                            class="dec button_inc"
                                            @click="decrementQuantity(item.id)"
                                        >
                                            -
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>
                                        {{
                                            formatCurrency(
                                                item.price * item.quantity
                                            )
                                        }}</strong
                                    >
                                </td>
                                <td class="options">
                                    <a
                                        href="#"
                                        @click.prevent="removeFromCart(item.id)"
                                        ><i class="ti-trash"></i> Xoá</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        class="row add_top_30 flex-sm-row-reverse cart_actions"
                    >
                        <div class="col-sm-12">
                            <div class="apply-coupon">
                                <div class="form-group form-inline">
                                    <input
                                        type="text"
                                        name="coupon-code"
                                        value=""
                                        placeholder="Nhập mã gỉam giá"
                                        class="form-control d-inline"
                                        style="width: 200px"
                                        v-model="discountCode"
                                    />
                                    <button
                                        type="button"
                                        class="btn_1 outline"
                                        @click="applyDiscountCode"
                                    >
                                        Áp dụng
                                    </button>
                                </div>
                                <ErrorMessage :message="errorMessage" />
                            </div>
                        </div>
                    </div>
                    <!-- /cart_actions -->
                </div>
                <!-- /container -->
            </div>

            <div class="box_cart">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <ul>
                                <li>
                                    <span>Tổng phụ</span>
                                    {{ formatCurrency(cartStore.cartTotal) }}
                                </li>
                                <li v-if="cartStore.discount">
                                    <span
                                        >Mã giảm gía:({{
                                            cartStore.discount.name
                                        }})</span
                                    >
                                    -{{
                                        cartStore.discount.condition === 1
                                            ? formatCurrency(
                                                  cartStore.discount.number
                                              )
                                            : `${cartStore.discount.number}%`
                                    }}
                                </li>
                                <li><span>Phí vận chuyển</span> 15.000đ</li>
                                <li v-if="cartStore.discount.condition === 1">
                                    <span>Giảm</span> -
                                    {{
                                        formatCurrency(
                                            cartStore.cartTotal -
                                                cartStore.discount.number
                                        )
                                    }}
                                </li>
                                <li v-else>
                                    <span>Giảm</span> -
                                    {{
                                        formatCurrency(
                                            (cartStore.cartTotal *
                                                cartStore.discount.number) /
                                                100
                                        )
                                    }}
                                </li>
                                <li v-if="cartStore.discount">
                                    <span>Tổng</span>
                                    {{
                                        cartStore.discount.condition === 1
                                            ? formatCurrency(
                                                  cartStore.cartTotal -
                                                      cartStore.discount
                                                          .number +
                                                      15000
                                              )
                                            : formatCurrency(
                                                  (cartStore.cartTotal *
                                                      cartStore.discount
                                                          .number) /
                                                      100 +
                                                      15000
                                              )
                                    }}
                                </li>
                                <li v-else>
                                    <span>Tổng</span>
                                    {{
                                        formatCurrency(
                                            cartStore.cartTotal + 15000
                                        )
                                    }}
                                </li>
                            </ul>
                            <router-link
                                to="checkout"
                                class="btn_1 full-width cart"
                            >
                                Thanh toán
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /box_cart -->
        </template>
    </Layout>
</template>

<script>
import Layout from "../layouts/Index.vue";
import { useCartStore } from "../stores/useCartStore";
import { ref } from "vue";
import ErrorMessage from "../components/ErrorMessage.vue";

export default {
    name: "Cart",
    components: {
        Layout,
        ErrorMessage,
    },
    setup() {
        const cartStore = useCartStore();
        const discountCode = ref("");
        const discountError = ref("");
        const errorMessage = ref("");

        const updateQuantity = (productId, quantity) => {
            cartStore.updateQuantity(productId, quantity);
        };

        const incrementQuantity = (productId) => {
            const product = cartStore.cart.find(
                (item) => item.id === productId
            );
            if (product) {
                cartStore.updateQuantity(productId, product.quantity + 1);
            }
        };

        const decrementQuantity = (productId) => {
            const product = cartStore.cart.find(
                (item) => item.id === productId
            );
            if (product && product.quantity > 1) {
                cartStore.updateQuantity(productId, product.quantity - 1);
            }
        };

        const removeFromCart = (productId) => {
            cartStore.removeFromCart(productId);
        };

        const applyDiscountCode = () => {
            discountError.value = "";
            cartStore
                .applyDiscount(discountCode.value)
                .then(() => {
                    errorMessage.value = "";
                })
                .catch((error) => {
                    errorMessage.value = error.response.data.error;
                });
        };

        cartStore.loadDiscount();

        const formatCurrency = (value) => {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(value);
        };

        return {
            cartStore,
            discountCode,
            discountError,
            updateQuantity,
            incrementQuantity,
            decrementQuantity,
            removeFromCart,
            applyDiscountCode,
            formatCurrency,
            errorMessage,
        };
    },
};
</script>
