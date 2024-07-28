<template>
    <div>
        <input
            type="file"
            multiple
            accept="image/*"
            @change="onImageChange"
            class="file-input border border-gray-300 rounded"
        />
        <div
            v-if="selectedImages.length"
            class="image-preview-container flex gap-4 overflow-x-auto"
        >
            <div
                v-for="(image, index) in selectedImages"
                :key="index"
                class="relative group flex-shrink-0"
            >
                <img
                    :src="image.url"
                    :alt="'Image ' + (index + 1)"
                    class="w-80 h-80 object-cover rounded-lg ml-1"
                />
                <a
                    @click="removeImage(index)"
                    class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                >
                    ✕
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps({
    modelValue: Array,
});
const emit = defineEmits(["update:modelValue"]);

const selectedImages = ref(props.modelValue || []);

const onImageChange = (event) => {
    const files = event.target.files;
    const newImages = [];
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = (e) => {
            newImages.push({
                file: file,
                url: e.target.result,
            });
            // Only update selectedImages and emit when all files are read
            if (newImages.length === files.length) {
                selectedImages.value = [...selectedImages.value, ...newImages];
                emit("update:modelValue", selectedImages.value);
            }
        };
        reader.readAsDataURL(file);
    }
};

// Remove an image from the preview list
const removeImage = (index) => {
    selectedImages.value.splice(index, 1);
    emit("update:modelValue", selectedImages.value);
};
// Watch for prop changes and update local state
watch(
    () => props.modelValue,
    (newVal) => {
        selectedImages.value = newVal;
    }
);
</script>

<style scoped>
.file-input {
    margin-bottom: 20px;
}

.image-preview-container {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    overflow-x: auto;
    white-space: nowrap;
}

.image-preview {
    width: 100px;
    height: 100px;
}

.image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
