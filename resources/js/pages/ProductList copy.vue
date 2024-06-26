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
                                <h1>Cart</h1>
                                <p>
                                    Order food with home delivery or take away
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="frame white"></div>
            </div>

            <div class="filters_full clearfix">
                <div class="container">
                    <div class="count_results">
                        Hiển thị {{ startIndex + 1 }}–{{ endIndex }} của
                        {{ sortedProducts.length }} kết quả.
                    </div>
                    <div class="sort_select">
                        <select
                            name="sort"
                            id="sort"
                            v-model="sortOption"
                            @change="sortProducts"
                        >
                            <option value="popularity" selected="selected">
                                Phổ biến
                            </option>
                            <option value="rating">Đánh giá tốt nhất</option>
                            <option value="date">Mới nhất</option>
                            <option value="price">Giá: thấp đến cao</option>
                            <option value="price-desc">
                                Giá: cao đến thấp
                            </option>
                        </select>
                    </div>
                    <a
                        href="#collapseFilters"
                        data-toggle="collapse"
                        class="btn_filters"
                    >
                        <i class="icon_adjust-vert"></i><span>Filters</span>
                    </a>
                </div>
            </div>

            <div class="collapse filters_2" id="collapseFilters">
                <div class="container margin_detail">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="filter_type">
                                <h6>Danh Mục</h6>
                                <ul>
                                    <li
                                        v-for="(category, id) in categories"
                                        :key="id"
                                    >
                                        <label class="container_check">
                                            {{ category.name }}
                                            <small>{{ category.count }}</small>
                                            <input
                                                type="checkbox"
                                                :value="id"
                                                @change="
                                                    toggleCategorySelection(id)
                                                "
                                            />
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="filter_type">
                                <h6>Xếp hạng</h6>
                                <ul>
                                    <li>
                                        <label class="container_check">
                                            Tuyệt vời(4.5+)
                                            <small>{{
                                                getRatingCount(4.5)
                                            }}</small>
                                            <input
                                                type="checkbox"
                                                @change="filterByRating(4.5)"
                                            />
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            Rất tốt(4+)
                                            <small>{{
                                                getRatingCount(4)
                                            }}</small>
                                            <input
                                                type="checkbox"
                                                @change="filterByRating(4)"
                                            />
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            Tốt(3.5+)
                                            <small>{{
                                                getRatingCount(3.5)
                                            }}</small>
                                            <input
                                                type="checkbox"
                                                @change="filterByRating(3.5)"
                                            />
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            Tạm(3+)
                                            <small>{{
                                                getRatingCount(3)
                                            }}</small>
                                            <input
                                                type="checkbox"
                                                @change="filterByRating(3)"
                                            />
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="filter_type">
                                <h6>Giá</h6>
                                <ul>
                                    <li
                                        v-for="(range, index) in priceRanges"
                                        :key="index"
                                    >
                                        <label class="container_check">
                                            ${{ range.min }} — ${{ range.max }}
                                            <small>{{
                                                getProductsCountInPriceRange(
                                                    range.min,
                                                    range.max
                                                )
                                            }}</small>
                                            <input
                                                type="checkbox"
                                                @change="
                                                    filterByPriceRange(range)
                                                "
                                            />
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container margin_60_40">
                <div class="row small-gutters">
                    <div
                        class="col-6 col-md-4 col-xl-3"
                        v-for="product in paginatedProducts"
                        :key="product.id"
                    >
                        <div class="grid_item">
                            <figure>
                                <span
                                    class="ribbon off"
                                    v-if="product.price_sale"
                                >
                                    -{{
                                        (
                                            ((product.price -
                                                product.price_sale) /
                                                product.price) *
                                            100
                                        ).toFixed(0)
                                    }}%
                                </span>
                                <a :href="'/menu/' + product.id">
                                    <img
                                        class="img-fluid lazy"
                                        :src="product.image"
                                        alt=""
                                        style="width: 400px; height: 320px"
                                    />
                                    <div class="add_cart">
                                        <span class="btn_1">Add to cart</span>
                                    </div>
                                </a>
                            </figure>
                            <div
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
                            </div>
                            <div v-else>
                                <i class="icon_star"></i
                                ><i class="icon_star"></i
                                ><i class="icon_star"></i
                                ><i class="icon_star"></i
                                ><i class="icon_star"></i>
                            </div>

                            <a :href="'/menu/' + product.id">
                                <h3>{{ product.name }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price"
                                    >{{
                                        product.price_sale || product.price
                                    }}đ</span
                                >
                                <span
                                    class="old_price"
                                    v-if="product.price_sale"
                                    >{{ product.price }}đ</span
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <Paginate
                    v-if="sortedProducts.length > itemsPerPage"
                    :page-count="pageCount"
                    :click-handler="handlePageClick"
                    :container-class="'pagination'"
                    :page-class="'page-item'"
                    :page-link-class="'page-link'"
                    :prev-text="'«'"
                    :next-text="'»'"
                ></Paginate>
            </div>
        </template>
    </Layout>
</template>
<script>
import Layout from "../layouts/Index.vue";
import axios from "axios";
import Paginate from "vuejs-paginate-next";

export default {
    name: "Menu",
    components: {
        Layout,
        Paginate,
    },
    data() {
        return {
            products: [],
            categories: [],
            selectedCategories: [],
            sortOption: "popularity",
            filteredRating: null,
            priceRanges: [
                { min: 0, max: 20000 },
                { min: 20000, max: 50000 },
                { min: 50000, max: 150000 },
            ],
            filteredPriceRange: null,
            currentPage: 1,
            itemsPerPage: 6,
        };
    },
    computed: {
        sortedProducts() {
            let sorted = [...this.products];
            if (this.sortOption === "rating") {
                sorted.sort((a, b) => {
                    const ratingA = a.total_number / a.total_rating;
                    const ratingB = b.total_number / b.total_rating;
                    return ratingB - ratingA;
                });
            } else if (this.sortOption === "date") {
                sorted.sort(
                    (a, b) => new Date(b.updated_at) - new Date(a.updated_at)
                );
            } else if (this.sortOption === "price") {
                sorted.sort((a, b) => a.price_sale - b.price_sale);
            } else if (this.sortOption === "price-desc") {
                sorted.sort((a, b) => b.price_sale - a.price_sale);
            }

            if (this.filteredRating !== null) {
                sorted = sorted.filter(
                    (product) =>
                        product.total_number / product.total_rating >=
                        this.filteredRating
                );
            }
            if (this.filteredPriceRange) {
                sorted = sorted.filter(
                    (product) =>
                        product.price >= this.filteredPriceRange.min &&
                        product.price <= this.filteredPriceRange.max
                );
            }

            return sorted;
        },
        paginatedProducts() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.sortedProducts.slice(start, end);
        },
        pageCount() {
            return Math.ceil(this.sortedProducts.length / this.itemsPerPage);
        },
        startIndex() {
            return (this.currentPage - 1) * this.itemsPerPage;
        },
        endIndex() {
            return Math.min(
                this.startIndex + this.itemsPerPage,
                this.sortedProducts.length
            );
        },
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
                    this.countProductsByCategory();
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the products!",
                        error
                    );
                });
        },

        fetchProductsByCategory(categoryIds) {
            const url = `/api/products/by-category?categories=${this.selectedCategories.join(
                ","
            )}`;
            console.log("Fetching products by category with URL:", url);
            axios
                .get(url)
                .then((response) => {
                    this.products = response.data;
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the products by category!",
                        error
                    );
                });
        },
        countProductsByCategory() {
            const categoryCounts = {};

            this.products.forEach((product) => {
                const category = product.category;
                if (category) {
                    if (categoryCounts[category.id]) {
                        categoryCounts[category.id].count++;
                    } else {
                        categoryCounts[category.id] = {
                            name: category.name,
                            count: 1,
                        };
                    }
                }
            });

            this.categories = categoryCounts;
        },
        sortProducts() {
            this.currentPage = 1;
        },
        toggleCategorySelection(categoryId) {
            if (this.selectedCategories.includes(categoryId)) {
                this.selectedCategories = this.selectedCategories.filter(
                    (id) => id !== categoryId
                );
            } else {
                this.selectedCategories.push(categoryId);
            }
            this.fetchProductsByCategory(); // Gọi API khi checkbox được chọn
        },

        filterByRating(rating) {
            this.filteredRating = rating;
        },

        getRatingCount(rating) {
            return this.products.filter(
                (product) =>
                    product.total_number / product.total_rating >= rating
            ).length;
        },
        filterByPriceRange(range) {
            if (
                this.filteredPriceRange &&
                this.filteredPriceRange.min === range.min &&
                this.filteredPriceRange.max === range.max
            ) {
                this.filteredPriceRange = null; // Uncheck the checkbox
            } else {
                this.filteredPriceRange = range;
            }
        },

        getProductsCountInPriceRange(min, max) {
            return this.products.filter(
                (product) => product.price >= min && product.price <= max
            ).length;
        },
        handlePageClick(pageNumber) {
            this.currentPage = pageNumber;
        },
    },
};
</script>
