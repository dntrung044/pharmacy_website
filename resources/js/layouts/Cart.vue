<template>
    <ul id="top_menu">
        <li><a href="#0" class="search-overlay-menu-btn"></a></li>
        <li>
            <div class="dropdown dropdown-cart">
                <a href="/cart" class="cart_bt"
                    ><strong>{{ cartStore.cartTotal }}</strong></a
                >
                <div class="dropdown-menu">
                    <ul>
                        <li v-for="item in cartStore.cart" :key="item.id">
                            <figure>
                                <img
                                    :src="item.image"
                                    width="50"
                                    height="50"
                                    class="lazy"
                                />
                            </figure>
                            <strong
                                ><span
                                    >{{ item.quantity }}x {{ item.name }}</span
                                >{{ formatCurrency(item.price) }}</strong
                            >
                            <a
                                href="#0"
                                @click.prevent="removeFromCart(item.id)"
                                class="action"
                                ><i class="icon_trash_alt"></i
                            ></a>
                        </li>
                    </ul>
                    <div class="total_drop">
                        <div class="clearfix add_bottom_15">
                            <strong
                                >Tổng:
                                <span>
                                    {{
                                        formatCurrency(cartStore.cartTotal)
                                    }}</span
                                ></strong
                            >
                        </div>
                        <router-link
                            :to="{ name: 'Cart' }"
                            class="btn_1 outline"
                            >Xem giỏ hàng</router-link
                        >
                        <router-link :to="{ name: 'Transaction' }" class="btn_1"
                            >Thanh toán</router-link
                        >
                    </div>
                </div>
            </div>
            <!-- /dropdown-cart-->
        </li>
    </ul>
</template>
<script>
import { useCartStore } from "../stores/useCartStore";
import { ref } from "vue";

export default {
    setup() {
        const cartStore = useCartStore();
        const discountCode = ref("");
        const discountError = ref("");

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
                    console.log("successfully.");
                })
                .catch((error) => {
                    discountError.value = error.response.data.error;
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
        };
    },
};
</script>
