<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
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
import { ref, onMounted } from "vue";
import SelectMultipleimages from "@/Components/SelectMultipleimages.vue";

const categories = ref([]);
const fetchCategories = () => {
    axios
        .get("/api/product_categories")
        .then((response) => {
            categories.value = response.data;
        })
        .catch((error) => {
            console.error("Error fetching categories", error);
        });
};

const form = useForm({
    name: "",
    description: "",
    category_id: "",
    price: 0,
    price_sale: 0,
    images: [],
    status: "inactive",
});

const handleFiles = (images) => {
    form.images = images.map((img) => img.file);
};

onMounted(fetchCategories);
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create product" />
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiMenu"
                title="Add product"
                main
            >
                <Link
                    :href="route('admin.products.index')"
                    class="btn btn-white rounded-full small"
                >
                    <BaseButton
                        :icon="mdiArrowLeftBoldOutline"
                        label="Back"
                        color="white"
                        rounded-full
                        small
                    />
                </Link>
            </SectionTitleLineWithButton>
            <CardBox
                form
                @submit.prevent="form.post(route('admin.products.store'))"
            >
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
                        <option selected="">Select category</option>
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
                        type="text"
                        placeholder="Enter price"
                        :error="form.errors.price"
                    >
                        <div
                            class="text-red-400 text-sm"
                            v-if="form.errors.price"
                        >
                            {{ form.errors.price }}
                        </div>
                    </FormControl>
                </FormField>
                <FormField
                    label="Price sale"
                    :class="{ 'text-red-400': form.errors.price_sale }"
                >
                    <FormControl
                        v-model="form.price_sale"
                        type="text"
                        placeholder="Enter price sale"
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
                <FormField
                    label="Images"
                    :class="{ 'text-red-400': form.errors.images }"
                >
                    <SelectMultipleimages
                        v-model:images="form.images"
                        @update:modelValue="handleFiles"
                    />
                </FormField>
                <FormField label="Display">
                    <input
                        v-model="form.status"
                        type="checkbox"
                        :true-value="'active'"
                        :false-value="'inactive'"
                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500"
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
