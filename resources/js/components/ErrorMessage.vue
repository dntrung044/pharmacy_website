<template>
    <div v-if="message" class="error-message">
        {{ message }}
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    message: {
        type: String,
        required: false,
        default: "",
    },
});
</script>

<style scoped>
.error-message {
    color: #ff0000;
    background-color: #ffe6e6;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
}
</style>
