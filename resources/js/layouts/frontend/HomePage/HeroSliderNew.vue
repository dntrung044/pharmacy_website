<template>
    <vueper-slides
        autoplay
        :arrows="false"
        :breakpoints="breakpoints"
        :touchable="false"
    >
        <vueper-slide
            v-for="(slide, i) in hero_carousel"
            :key="i"
            :image="slide"
        >
        </vueper-slide>
    </vueper-slides>
</template>

<script>
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
export default {
    components: { VueperSlides, VueperSlide },
    props: ["hero_carousel"],
    data() {
        return {
            breakpoints: {
                1900: {
                    slideRatio: 1 / 2,
                },
                900: {
                    slideRatio: 1 / 3,
                },
                600: {
                    slideRatio: 1 / 1.5,
                    arrows: false,
                    bulletsOutside: false,
                },
            },
        };
    },
};
</script>
