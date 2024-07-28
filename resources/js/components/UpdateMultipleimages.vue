<template>
    <div>
        <input
            type="file"
            multiple
            accept="image/*"
            @change="onImageChange"
            class="file-input border border-gray-300 rounded mb-2"
        />
        <div
            v-if="images.length"
            class="image-preview-container flex gap-4 overflow-x-auto"
        >
            <div
                v-for="(image, index) in images"
                :key="index"
                class="relative group flex-shrink-0"
            >
                <img
                    :src="image.url"
                    :alt="'Image ' + (index + 1)"
                    class="w-80 h-60 object-cover rounded-lg ml-1"
                />
                <a
                    @click="removeImage(index)"
                    class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer"
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
    initialImages: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(["update:images", "remove:images"]);

const images = ref(
    props.initialImages.map((image) => ({ ...image, isNew: false }))
);
const removedImages = ref([]);

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
                isNew: true,
            });

            if (newImages.length === files.length) {
                images.value = [...images.value, ...newImages];
            }
        };
        reader.readAsDataURL(file);
    }
};

const removeImage = (index) => {
    const removedImage = images.value.splice(index, 1)[0];
    if (!removedImage.isNew) {
        removedImages.value.push(removedImage.id);
    }
    emit("remove:images", removedImages.value);
};

watch(images, (newImages) => {
    emit("update:images", newImages);
});

watch(removedImages, (newRemovedImages) => {
    emit("remove:images", newRemovedImages);
});
</script>
