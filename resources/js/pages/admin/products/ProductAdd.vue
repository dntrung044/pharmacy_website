<template>
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900">
            Add a new product
        </h2>
        <!-- Modal body -->
        <form @submit.prevent="InsertProduct">
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Product Name</label
                    >
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="product.name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Type product name"
                        required=""
                    />
                </div>
                <div>
                    <label
                        for="category"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Category</label
                    ><select
                        v-model="product.category_id"
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
                </div>
                <div>
                    <label
                        for="price"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Price</label
                    >
                    <input
                        type="number"
                        v-model="product.price"
                        name="price"
                        id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="20.0000 đ"
                        required=""
                    />
                </div>
                <div>
                    <label
                        for="price_sale"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Price sale</label
                    >
                    <input
                        type="number"
                        v-model="product.price_sale"
                        name="price_sale"
                        id="price_sale"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="20.0000 đ"
                        required=""
                    />
                </div>
                <div class="sm:col-span-2 mb-6">
                    <label
                        for="description"
                        class="block mb-2 text-sm font-medium text-gray-900"
                        >Description</label
                    >

                    <QuillEditor
                        v-model:content="product.description"
                        contentType="html"
                        theme="snow"
                    />
                </div>
            </div>

            <div class="mb-4">
                <span
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Product Images</span
                >
                <div class="card">
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
                        <template #empty>
                            <span>SVG, PNG, JPG or GIF (MAX. 800x400px).</span>
                        </template>
                    </FileUpload>
                </div>
            </div>
            <div class="flex items-center mb-4">
                <input
                    id="status"
                    v-model="product.status"
                    type="checkbox"
                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2"
                />
                <label
                    for="status"
                    class="ml-2 text-sm text-gray-500"
                    >Display</label
                >
            </div>
            <div
                class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4"
            >
                <button
                    type="submit"
                    class="w-full sm:w-auto justify-center text-white inline-flex bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                >
                    Add product
                </button>
                <button
                    data-modal-toggle="createProductModal"
                    type="button"
                    class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                >
                    <svg
                        class="mr-1 -ml-1 w-5 h-5"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Huỷ
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import axios from "axios";
import { ref } from "vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import FileUpload from "primevue/fileupload";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";

export default {
    components: {
        FileUpload,
        QuillEditor,
        Toast,
    },
    data() {
        return {
            categories: [],
            product: {
                name: "",
                description: "",
                category_id: "",
                price: 0,
                price_sale: 0,
                status: false,
                images: [],
            },
        };
    },
    mounted() {
        this.fetchCategories();
    },
    methods: {
        fetchCategories() {
            axios
                .get("/api/product_categories")
                .then((response) => {
                    this.categories = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching categories", error);
                });
        },
        handleFiles(event) {
            this.product.images = Array.from(event.target.files);
        },
        async InsertProduct() {
            const formData = new FormData();
            formData.append("name", this.product.name);
            formData.append("description", this.product.description);
            formData.append("category_id", this.product.category_id);
            formData.append("price", this.product.price);
            formData.append("price_sale", this.product.price_sale);
            formData.append("status", this.product.status);

            this.product.images.forEach((file) => {
                formData.append("images[]", file);
            });

            try {
                const response = await axios.post("/api/products", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.$toast.success("Product created successfully");
                this.product = {
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
                this.$toast.error("Failed to create product");
            }
        },
    },
};
</script>
