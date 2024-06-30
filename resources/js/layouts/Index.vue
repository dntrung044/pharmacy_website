<template>
    <Header></Header>
    <main>
        <slot name="content"></slot>
    </main>
    <Footer></Footer>
</template>
<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";

export default {
    name: "Layout",
    components: {
        Header,
        Footer,
    },
};
</script>
