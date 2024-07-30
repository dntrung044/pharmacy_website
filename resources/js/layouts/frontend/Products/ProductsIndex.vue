<template>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">
            {{ title }}
        </h2>
        <ProductGrid :products="products.data" :cols="cols"></ProductGrid>
    </div>
</template>

<script>
export default {
    props: ["products", "title", "cols"],
};
</script>
<script setup>
import ProductGrid from "./ProductGrid.vue";
</script>
