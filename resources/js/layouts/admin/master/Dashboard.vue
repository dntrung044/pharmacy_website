<script setup>
import SideBar from "../SideBar.vue";
import { ref } from "vue";
import TopNavBar from "../TopNavBar.vue";
const sidebarOpen = ref(true);
const mainClass = ref("");

const handleDiscloserButtonClick = (value) => {
    sidebarOpen.value = value;
    mainClass.value = value
        ? "relative min-h-screen"
        : "relative min-h-screen px-20";
};
</script>
<template>
    <div class="bg-stone-300" :class="{ 'ico-mode': !sidebarOpen }">
        <!--  -->
        <SideBar class="block" :side-bar-open="sidebarOpen"></SideBar>

        <!-- No mobile o menu tipo icone deve ser ativado, mostra o mesmo menu no mobile -->
        <!--  -->
        <div
            class="flex-1 bg-white transition-margin ease-in-out duration-300"
            :class="
                sidebarOpen
                    ? 'md:ml-[256px] lg:ml-[256px] ml-[10rem]'
                    : 'ml-0 lg:ml-[3.6rem] md:ml-[3.6rem]'
            "
        >
            <TopNavBar
                class="w-full"
                @open="handleDiscloserButtonClick"
            ></TopNavBar>

            <!-- <main class="relative min-h-screen"> -->
            <main :class="mainClass">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>
