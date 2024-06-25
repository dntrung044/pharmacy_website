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
                                <h1>{{ product.name }}</h1>
                                <p>{{ product.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="frame white"></div>
            </div>

            <div class="container margin_60_40">
                <div class="row">
                    <div class="col-lg-6 magnific-gallery">
                        <p v-for="image in product.images" :key="image.id">
                            <a
                                :href="image.url"
                                :title="image.name"
                                data-effect="mfp-zoom-in"
                            >
                                <img
                                    :src="image.url"
                                    :alt="image.name"
                                    class="img-fluid"
                                />
                            </a>
                        </p>
                    </div>
                    <div class="col-lg-6" id="sidebar_fixed">
                        <div class="prod_info">
                            <span
                                class="rating"
                                v-if="
                                    product.total_rating && product.total_number
                                "
                            >
                                <i
                                    class="icon_star"
                                    v-for="n in 5"
                                    :key="n"
                                    :class="{
                                        voted:
                                            n <=
                                            Math.round(
                                                product.total_number /
                                                    product.total_rating
                                            ),
                                    }"
                                ></i>
                                <em>
                                    {{ product.reviews?.length || 0 }}
                                    Đánh giá</em
                                >
                            </span>
                            <h1>{{ product.name }}</h1>
                            <p>{{ product.content }}</p>
                            <div class="prod_options">
                                <div class="row" v-if="product.sizes">
                                    <label
                                        class="col-xl-5 col-lg-5 col-md-6 col-6"
                                        ><strong>Chọn size </strong>(bắt
                                        buộc)</label
                                    >
                                    <div
                                        class="col-xl-4 col-lg-5 col-md-6 col-6"
                                    >
                                        <div class="custom-select-form">
                                            <select
                                                class="wide"
                                                v-model="selectedSize"
                                            >
                                                <option
                                                    v-for="size in product.sizes"
                                                    :key="size"
                                                    :value="size"
                                                >
                                                    {{ size.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label
                                        class="col-xl-5 col-lg-5 col-md-6 col-6"
                                        ><strong>SỐ LƯỢNG</strong></label
                                    >
                                    <div
                                        class="col-xl-4 col-lg-5 col-md-6 col-6"
                                    >
                                        <div class="numbers-row">
                                            <input
                                                type="number"
                                                v-model.number="quantity"
                                                class="qty2"
                                                name="quantity"
                                                min="1"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="price_main">
                                        <span class="new_price"
                                            >{{
                                                product.price_sale
                                                    | product.price
                                            }}
                                            đ</span
                                        >
                                        <span
                                            v-if="product.price"
                                            class="percentage"
                                            >-{{ discountPercentage }}%</span
                                        >
                                        <span
                                            v-if="product.price"
                                            class="old_price"
                                            >{{
                                                product.price
                                                    | product.price_sale
                                            }}
                                            đ</span
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="btn_add_to_cart">
                                        <button
                                            @click="addToCart"
                                            class="btn_1"
                                        >
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tabs_product">
                <div class="container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a
                                id="tab-A"
                                href="#pane-A"
                                class="nav-link active"
                                data-toggle="tab"
                                role="tab"
                                >Mô tả</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                id="tab-B"
                                href="#pane-B"
                                class="nav-link"
                                data-toggle="tab"
                                role="tab"
                                >Đánh giá</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab_content_wrapper">
                <div class="container">
                    <div class="tab-content" role="tablist">
                        <div
                            id="pane-A"
                            class="card tab-pane fade show active"
                            role="tabpanel"
                            aria-labelledby="tab-A"
                        >
                            <div class="card-header" role="tab" id="heading-A">
                                <h5 class="mb-0">
                                    <a
                                        class="collapsed"
                                        data-toggle="collapse"
                                        href="#collapse-A"
                                        aria-expanded="false"
                                        aria-controls="collapse-A"
                                    >
                                        Mô tả
                                    </a>
                                </h5>
                            </div>
                            <div
                                id="collapse-A"
                                class="collapse"
                                role="tabpanel"
                                aria-labelledby="heading-A"
                            >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Chi tiết</h3>
                                            <p>{{ product.content }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Specifications (100g)</h3>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-sm table-striped"
                                                >
                                                    <tbody>
                                                        <!-- <tr
                                                            v-for="(
                                                                value, key
                                                            ) in product.specifications"
                                                            :key="key"
                                                        >
                                                            <td>
                                                                <strong>{{
                                                                    key
                                                                }}</strong>
                                                            </td>
                                                            <td>{{ value }}</td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            id="pane-B"
                            class="card tab-pane fade"
                            role="tabpanel"
                            aria-labelledby="tab-B"
                        >
                            <div class="card-header" role="tab" id="heading-B">
                                <h5 class="mb-0">
                                    <a
                                        class="collapsed"
                                        data-toggle="collapse"
                                        href="#collapse-B"
                                        aria-expanded="false"
                                        aria-controls="collapse-B"
                                    >
                                        Đánh Giá
                                    </a>
                                </h5>
                            </div>
                            <div
                                id="collapse-B"
                                class="collapse"
                                role="tabpanel"
                                aria-labelledby="heading-B"
                            >
                                <div class="card-body">
                                    <div
                                        class="row justify-content-between"
                                        v-for="review in product.reviews"
                                        :key="review.id"
                                    >
                                        <div class="col-lg-6">
                                            <div class="review_content">
                                                <div
                                                    class="clearfix add_bottom_10"
                                                >
                                                    <span class="rating">
                                                        <i
                                                            v-for="star in 5"
                                                            :key="star"
                                                            :class="{
                                                                icon_star: true,
                                                                empty:
                                                                    star >
                                                                    review.rating,
                                                            }"
                                                        ></i>
                                                        <em
                                                            >{{
                                                                review.rating
                                                            }}/5.0</em
                                                        >
                                                    </span>
                                                    <em
                                                        v-if="
                                                            review.active === 1
                                                        "
                                                        >Hiển thị</em
                                                    >
                                                    <em v-else>Ẩn</em>
                                                </div>
                                                <h4>Trung</h4>
                                                <p>{{ review.comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-right">
                                        <a
                                            href="leave-review.html"
                                            class="btn_1"
                                            >Để lại đánh giá</a
                                        >
                                    </p>
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
import Layout from "../layouts/Index.vue";
import axios from "axios";

export default {
    name: "ProductDetail",
    components: {
        Layout,
    },
    props: ["id"],
    data() {
        return {
            product: {},
            selectedSize: null,
            quantity: 1,
        };
    },
    computed: {
        discountPercentage() {
            if (!this.product.price || !this.product.price_sale) return 0;
            return Math.round(
                ((this.product.price - this.product.price_sale) /
                    this.product.price) *
                    100
            );
        },
    },
    mounted() {
        this.fetchProduct();
    },
    methods: {
        fetchProduct() {
            axios
                .get(`/api/products/${this.id}`)
                .then((response) => {
                    this.product = response.data.product;
                    this.selectedSize = this.product.sizes
                        ? this.product.sizes[0]
                        : null;
                    console.log("data", this.product);
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the product!",
                        error
                    );
                });
        },
        addToCart() {
            // Implement add to cart functionality here
        },
    },
};
</script>

<style scoped>
/* Add any relevant styles here */
</style>
