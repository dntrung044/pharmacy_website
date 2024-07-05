<template>
    <Layout>
        <template v-slot:content>
            <section class="slider">
                <div id="slider" class="flexslider">
                    <ul class="slides">
                        <li v-for="product in products" :key="product.id">
                            <img
                                style="width: 1475px; height: 800px"
                                :src="product.thumbnail"
                                alt="../../img/flex_slides/slide_1.jpg"
                            />
                            <div class="meta">
                                <h3>{{ product.name }}</h3>
                                <div class="info">
                                    <p>{{ product.description }}</p>
                                </div>
                                <a
                                    :href="`/menu/${product.id}`"
                                    class="btn_1"
                                    >{{ product.button_name }}</a
                                >
                            </div>
                        </li>
                    </ul>
                    <div id="icon_drag_mobile"></div>
                </div>
                <div id="carousel_slider_wp">
                    <div id="carousel_slider" class="flexslider">
                        <ul class="slides">
                            <li v-for="product in products" :key="product.id">
                                <img
                                    style="width: 400px; height: 200px"
                                    :src="product.image"
                                    alt=""
                                />
                                <div class="caption">
                                    <h3>
                                        {{ product.name
                                        }}<span>{{
                                            product.category.name
                                        }}</span>
                                    </h3>
                                    <small>${{ product.price }}</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </template>
    </Layout>
</template>

<script>
import Layout from "./../../layouts/frontend/Index.vue";
import axios from "axios";

export default {
    name: "Home",
    components: {
        Layout,
    },
    data() {
        return {
            products: [],
        };
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios
                .get("/api/products")
                .then((response) => {
                    this.products = response.data;
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the products!",
                        error
                    );
                });
        },
    },
};
</script>
