<template>
    <GuestLayout>
        <HeroSliderNewVue
            :hero_carousel="JSON.parse(homePageContent.hero_carousel)"
        ></HeroSliderNewVue>
        <CategoryList :categories="categories"></CategoryList>
        <ProductsIndex
            :products="productBestSellers"
            :title="'Best Sellers'"
            :cols="4"
            class="mb-10"
        ></ProductsIndex>
        <Popups :discounts="discounts"></Popups>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "../../Layouts/GuestLayout.vue";
import CategoryList from "../../Layouts/Frontend/HomePage/CategoryList.vue";
import HeroSliderNewVue from "../../Layouts/Frontend/HomePage/HeroSliderNew.vue";
import Popups from "../../Layouts/Frontend/Popups.vue";
import ProductsIndex from "../../Layouts/Frontend/Products/ProductsIndex.vue";

const props = defineProps({
    homePageContent: {
        type: Object,
        default: () => ({}),
    },
    categories: {
        type: Object,
        default: () => ({}),
    },
    productBestSellers: {
        type: Object,
        default: () => ({}),
    },
    discounts: {
        type: Object,
        default: () => ({}),
    },
});
</script>
