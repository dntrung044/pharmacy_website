<script setup>
import { ref, onMounted } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { mdiMenu, mdiArrowLeftBoldOutline } from "@mdi/js";
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import FileUpload from "primevue/fileupload";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";

// Khai báo các biến và hàm
const categories = ref([]);
const product = ref({
    name: "",
    description: "",
    category_id: "",
    price: 0,
    price_sale: 0,
    status: false,
    images: [],
});

// Khai báo hàm toast
const toast = useToast();

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
});
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
const handleFiles = (event) => {
    product.value.images = Array.from(event.files);
};
const InsertProduct = async () => {
    const formData = new FormData();
    formData.append("name", form.value.name);
    formData.append("description", form.value.description);
    formData.append("category_id", form.value.category_id);
    formData.append("price", form.value.price);
    formData.append("price_sale", form.value.price_sale);
    formData.append("status", form.value.status);

    form.value.images.forEach((file) => {
        formData.append("images[]", file);
    });

    try {
        await axios.post("/api/products", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        toast.add({
            severity: "success",
            summary: "Success",
            detail: "Product created successfully",
        });
        product.value = {
            name: "",
            description: "",
            category_id: "",
            price: 0,
            price_sale: 0,
            status: false,
            images: [],
        };
    } catch (error) {
        console.error("Error adding product:", error);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: "Failed to create product",
        });
    }
};

onMounted(fetchCategories);
</script>

<template>
    <LayoutAuthenticated>
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
            <CardBox
                form
                @submit.prevent="
                    form.post(route('admin.products.update', props.products.id))
                "
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
                    label="Name"
                    :class="{ 'text-red-400': form.errors.name }"
                >
                    <select
                        v-model="form.category_id"
                        id="category"
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

                <FormField label="Display">
                    <Toast />
                    <FileUpload
                        name="images[]"
                        id="product.images"
                        ref="fileUpload"
                        url="/api/upload"
                        :multiple="true"
                        accept="image/*"
                        :maxFileSize="3000000"
                        @input="handleFiles"
                    >
                    </FileUpload>
                </FormField>

                <FormField label="Display">
                    <input
                        id="status"
                        v-model="product.status"
                        type="checkbox"
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
    </LayoutAuthenticated>
</template>
