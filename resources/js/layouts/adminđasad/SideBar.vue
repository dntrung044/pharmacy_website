<script setup>
import Menu from "./Menu.vue";

const props = defineProps({
    sideBarOpen: {
        type: Boolean,
        required: true,
    },
});
</script>

<template>
    <div
        class="fixed transform duration-300 w-[10rem] lg:w-64 md:w-64 bg-stone-300 h-screen overflow-y-auto"
        :class="
            props.sideBarOpen
                ? 'translate-x-0'
                : '-translate-x-[16rem] md:-translate-x-[12.4rem] lg:-translate-x-[12.4rem]'
        "
    >
        <Menu :ico-mode="!props.sideBarOpen" />
    </div>
    <div
        class="lg:hidden md:hidden fixed w-full h-full ml-[10rem] bg-stone-50"
        :class="{ hidden: !props.sideBarOpen }"
    ></div>
</template>
