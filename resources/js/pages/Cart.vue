<template>
    <Layout>
        <template v-slot:content>
            <div
                class="hero_single inner_pages background-image"
                data-background="url(img/hero_menu.jpg)"
            >
                <div
                    class="opacity-mask"
                    data-opacity-mask="rgba(0, 0, 0, 0.6)"
                >
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-9 col-lg-10 col-md-8">
                                <h1>Your orders</h1>
                                <p>
                                    Order food with home delivery or take away
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="frame gray"></div>
            </div>
            <div class="bg_gray">
                <div class="container margin_60_40">
                    <div v-if="added" class="alert alert-success">
                        Product has been added to your cart!
                    </div>
                    <table class="table table-striped cart-list">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in carts" :key="product.id">
                                <td>
                                    <div class="thumb_cart">
                                        <img
                                            :src="product.image"
                                            class="lazy"
                                            :alt="product.name"
                                        />
                                    </div>
                                    <span class="item_cart">
                                        {{ product.quantity }}x {{ item.name }}
                                    </span>
                                </td>
                                <td>
                                    <strong
                                        >{{ item.price.toFixed(2) }} đ</strong
                                    >
                                </td>
                                <td>
                                    <div class="numbers-row">
                                        <input
                                            type="text"
                                            :value="item.quantity"
                                            class="qty2"
                                            @input="
                                                updateQuantity(
                                                    item.productId,
                                                    parseInt(
                                                        $event.target.value
                                                    )
                                                )
                                            "
                                        />
                                        <div
                                            class="inc button_inc"
                                            @click="
                                                updateQuantity(
                                                    item.productId,
                                                    item.quantity + 1
                                                )
                                            "
                                        >
                                            +
                                        </div>
                                        <div
                                            class="dec button_inc"
                                            @click="
                                                updateQuantity(
                                                    item.productId,
                                                    item.quantity - 1
                                                )
                                            "
                                        >
                                            -
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong
                                        >{{
                                            (
                                                item.price * item.quantity
                                            ).toFixed(2)
                                        }}
                                        đ</strong
                                    >
                                </td>
                                <td class="options">
                                    <a
                                        href="#"
                                        @click.prevent="
                                            removeFromCart(item.productId)
                                        "
                                    >
                                        <i class="ti-trash"></i> xoá
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        class="row add_top_30 flex-sm-row-reverse cart_actions"
                    >
                        <div class="col-sm-4 text-right">
                            <button
                                type="button"
                                class="btn_1 outline"
                                @click="updateCart"
                            >
                                Update Cart
                            </button>
                        </div>
                        <div class="col-sm-8">
                            <div class="apply-coupon">
                                <div class="form-group form-inline">
                                    <input
                                        type="text"
                                        name="coupon-code"
                                        placeholder="Promo code"
                                        class="form-control d-inline"
                                        style="width: 150px"
                                    />
                                    <button type="button" class="btn_1 outline">
                                        Apply Coupon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_cart">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <ul>
                                <li>
                                    <span>Subtotal</span>
                                    {{ cartTotal.toFixed(2) }} đ
                                </li>
                                <li><span>Delivery fee</span> 7.00 đ</li>
                                <li>
                                    <span>Total</span>
                                    {{ (cartTotal + 7).toFixed(2) }} đ
                                </li>
                            </ul>
                            <a
                                href="shop-checkout.html"
                                class="btn_1 full-width cart"
                            >
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Layout>
</template>

<script>
import Layout from "../layouts/Index.vue";

export default {
    name: "Cart",
    components: {
        Layout,
    },
    data() {
        return {
            carts: [],
        };
    },
    created() {
        this.fetchCarts();
    },
    methods: {
        fetchCarts() {
            axios
                .get("/api/carts/products_in_cart")
                .then((response) => {
                    this.carts = response.data;
                    console.log(response.data);
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the carts!",
                        error
                    );
                });
        },
    },
};
</script>
