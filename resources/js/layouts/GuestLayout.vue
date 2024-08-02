<script setup>
import Header from "./Frontend/Header.vue";
import Nav from "./Frontend/Nav.vue";
import Footer from "./Frontend/Footer.vue";
</script>

<template>
    <Header />
    <Nav />
    <slot />
    <Footer />
</template>
