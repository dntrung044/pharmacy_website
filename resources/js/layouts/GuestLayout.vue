<script setup>
import Header from "./Frontend/Header.vue";
import Footer from "./Frontend/Footer.vue";
</script>

<template>
    <Header></Header>
    <main>
        <slot />
    </main>
    <Footer></Footer>
</template>
