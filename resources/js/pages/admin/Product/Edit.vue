<template>
    <AuthenticatedLayout>
        <Head title="Update product" />
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiMenu"
                title="Update product"
                main
            >
                <BaseButton
                    :route-name="route('admin.products.index')"
                    :icon="mdiArrowLeftBoldOutline"
                    label="Back"
                    color="white"
                    rounded-full
                    small
                />
            </SectionTitleLineWithButton>
            <CardBox form @submit.prevent="handleSubmit">
                <FormField
                    label="Name"
                    :class="{ 'text-red-400': form.errors.name }"
                >
                    <FormControl
                        v-model="form.name"
                        type="text"
                        placeholder="Enter Name"
                        :error="form.errors.name"
                    >
                        <div
                            class="text-red-400 text-sm"
                            v-if="form.errors.name"
                        >
                            {{ form.errors.name }}
                        </div>
                    </FormControl>
                </FormField>
                <FormField
                    label="Category"
                    :class="{ 'text-red-400': form.errors.category_id }"
                >
                    <select
                        v-model="form.category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </FormField>
                <FormField
                    label="Description"
                    :class="{ 'text-red-400': form.errors.description }"
                >
                    <QuillEditor
                        v-model:content="form.description"
                        contentType="html"
                        theme="snow"
                        :error="form.errors.description"
                    />
                </FormField>
                <FormField
                    label="Price"
                    :class="{ 'text-red-400': form.errors.price }"
                >
                    <FormControl
                        v-model="form.price"
                        type="number"
                        placeholder="Enter Price"
                        :error="form.errors.price"
                    >
                        <div
                            class="text-red-400 text-sm"
                            v-if="form.errors.price"
                        >
                            {{ form.errors.price }}
                        </div>
                    </FormControl>
                    <FormControl
                        v-model="form.price_sale"
                        type="number"
                        placeholder="Enter Price Sale"
                        :error="form.errors.price_sale"
                    >
                        <div
                            class="text-red-400 text-sm"
                            v-if="form.errors.price_sale"
                        >
                            {{ form.errors.price_sale }}
                        </div>
                    </FormControl>
                </FormField>
                <FormField label="Product Images">
                    <UpdateMultipleimages
                        v-model:images="form.images"
                        :initialImages="form.images"
                        @remove:images="updateRemovedImages"
                    />
                </FormField>
                <FormField label="Display">
                    <input
                        v-model="form.status"
                        type="checkbox"
                        :true-value="'active'"
                        :false-value="'inactive'"
                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2"
                    />
                </FormField>

                <template #footer>
                    <BaseButtons>
                        <BaseButton
                            type="submit"
                            color="info"
                            label="Submit"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        />
                    </BaseButtons>
                </template>
            </CardBox>
        </SectionMain>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
import { mdiMenu, mdiArrowLeftBoldOutline } from "@mdi/js";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import UpdateMultipleimages from "@/Components/UpdateMultipleimages.vue";

const categories = ref([]);

const props = defineProps({
    product: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    _method: "put",
    name: props.product.name,
    description: props.product.description,
    category_id: props.product.category_id,
    price: props.product.price,
    price_sale: props.product.price_sale,
    status: props.product.status,
    images: props.product.images.map((image) => ({ ...image })),
    removedImages: [],
});

const fetchCategories = () => {
    axios
        .get("/api/product_categories")
        .then((response) => {
            categories.value = response.data;
            form.category_id = props.product.category_id;
        })
        .catch((error) => {
            console.error("Error fetching categories", error);
        });
};

const updateRemovedImages = (removedImages) => {
    form.removedImages = removedImages;
};

const handleSubmit = () => {
    const formData = new FormData();
    // Add product details
    formData.append("_method", "put");
    formData.append("name", form.name);
    formData.append("description", form.description);
    formData.append("category_id", form.category_id);
    formData.append("price", form.price);
    formData.append("price_sale", form.price_sale);
    formData.append("status", form.status);
    // Add new images
    form.images.forEach((image, index) => {
        formData.append(`images[${index}]`, image.file);
    });
    // Removed images
    form.removedImages.forEach((imageId, index) => {
        formData.append(`removed_images[${index}]`, imageId);
    });
    axios
        .post(route("admin.products.update", props.product.id), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(() => {
            window.location.href = route("admin.products.index");
        })
        .catch((error) => {
            console.error(error);
        });
};

onMounted(fetchCategories);
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

.image {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 0.5rem;
    margin-left: 0.25rem;
}
</style>
