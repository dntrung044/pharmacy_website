<template>
    <Layout>
        <template v-slot:content>
            <div class="filters_full clearfix" style="margin-top: 5em">
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
                                <a>
                                    <img
                                        class="img-fluid lazy"
                                        :src="product.image"
                                        alt=""
                                        style="width: 400px; height: 320px"
                                    />
                                    <div class="add_cart">
                                        <span
                                            class="btn_1"
                                            @click="addToCart(product)"
                                            >Add to cart</span
                                        >
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
import axios from "axios";
import { ref, computed } from "vue";
import Layout from "../layouts/Index.vue";
import Paginate from "vuejs-paginate-next";
import { useCartStore } from "../stores/useCartStore";

export default {
    components: {
        Layout,
        Paginate,
    },
    setup() {
        const products = ref([]);
        const categories = ref([]);
        const selectedCategories = ref([]);
        const priceRanges = [
            { min: 0, max: 20000 },
            { min: 20000, max: 50000 },
            { min: 50000, max: 150000 },
        ];
        const filteredPriceRange = ref(null);
        const sortOption = ref("popularity");
        const filteredRating = ref(null);
        const currentPage = ref(1);
        const itemsPerPage = ref(6);
        const cartStore = useCartStore();

        const fetchProducts = () => {
            axios
                .get("/api/products")
                .then((response) => {
                    products.value = response.data;
                    countProductsByCategory();
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the products!",
                        error
                    );
                });
        };

        const fetchProductsByCategory = () => {
            const url = `/api/products/by-category?categories=${selectedCategories.value.join(
                ","
            )}`;
            console.log("Fetching products by category with URL:", url);
            axios
                .get(url)
                .then((response) => {
                    products.value = response.data;
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the products by category!",
                        error
                    );
                });
        };

        const countProductsByCategory = () => {
            const categoryCounts = {};

            products.value.forEach((product) => {
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

            categories.value = categoryCounts;
        };

        const sortProducts = () => {
            currentPage.value = 1;
        };

        const toggleCategorySelection = (categoryId) => {
            if (selectedCategories.value.includes(categoryId)) {
                selectedCategories.value = selectedCategories.value.filter(
                    (id) => id !== categoryId
                );
            } else {
                selectedCategories.value.push(categoryId);
            }
            fetchProductsByCategory(); // Call API when checkbox is selected
        };

        const filterByRating = (rating) => {
            filteredRating.value = rating;
        };

        const filterByPriceRange = (range) => {
            if (
                filteredPriceRange.value &&
                filteredPriceRange.value.min === range.min &&
                filteredPriceRange.value.max === range.max
            ) {
                filteredPriceRange.value = null; // Uncheck the checkbox
            } else {
                filteredPriceRange.value = range;
            }
        };

        const getRatingCount = (rating) => {
            return products.value.filter(
                (product) =>
                    product.total_number / product.total_rating >= rating
            ).length;
        };

        const getProductsCountInPriceRange = (min, max) => {
            return products.value.filter(
                (product) => product.price >= min && product.price <= max
            ).length;
        };

        const handlePageClick = (pageNumber) => {
            currentPage.value = pageNumber;
        };

        const sortedProducts = computed(() => {
            let sorted = [...products.value];
            if (sortOption.value === "rating") {
                sorted.sort((a, b) => {
                    const ratingA = a.total_number / a.total_rating;
                    const ratingB = b.total_number / b.total_rating;
                    return ratingB - ratingA;
                });
            } else if (sortOption.value === "date") {
                sorted.sort(
                    (a, b) => new Date(b.updated_at) - new Date(a.updated_at)
                );
            } else if (sortOption.value === "price") {
                sorted.sort((a, b) => a.price_sale - b.price_sale);
            } else if (sortOption.value === "price-desc") {
                sorted.sort((a, b) => b.price_sale - a.price_sale);
            }

            if (filteredRating.value !== null) {
                sorted = sorted.filter(
                    (product) =>
                        product.total_number / product.total_rating >=
                        filteredRating.value
                );
            }
            if (filteredPriceRange.value) {
                sorted = sorted.filter(
                    (product) =>
                        product.price >= filteredPriceRange.value.min &&
                        product.price <= filteredPriceRange.value.max
                );
            }

            return sorted;
        });

        const paginatedProducts = computed(() => {
            const start = (currentPage.value - 1) * itemsPerPage.value;
            const end = start + itemsPerPage.value;
            return sortedProducts.value.slice(start, end);
        });

        const pageCount = computed(() => {
            return Math.ceil(sortedProducts.value.length / itemsPerPage.value);
        });

        const startIndex = computed(() => {
            return (currentPage.value - 1) * itemsPerPage.value;
        });

        const endIndex = computed(() => {
            return Math.min(
                startIndex.value + itemsPerPage.value,
                sortedProducts.value.length
            );
        });

        const addToCart = (product) => {
            cartStore.addToCart(product);
        };

        fetchProducts();

        return {
            products,
            categories,
            selectedCategories,
            priceRanges,
            filteredPriceRange,
            sortOption,
            filteredRating,
            currentPage,
            itemsPerPage,
            sortedProducts,
            paginatedProducts,
            pageCount,
            startIndex,
            endIndex,
            fetchProducts,
            fetchProductsByCategory,
            countProductsByCategory,
            sortProducts,
            toggleCategorySelection,
            filterByRating,
            getRatingCount,
            filterByPriceRange,
            getProductsCountInPriceRange,
            handlePageClick,
            addToCart,
        };
    },
};
</script>
