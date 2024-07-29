<script setup>
import { ref, defineProps } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import {
    mdiMenu,
    mdiPlus,
    mdiSquareEditOutline,
    mdiTrashCan,
    mdiAlertBoxOutline,
} from "@mdi/js";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import Pagination from "@/Components/Admin/Pagination.vue";
import Sort from "@/Components/Admin/Sort.vue";
import DeleteModal from "@/Components/Admin/DeleteModal.vue";

const props = defineProps({
    products: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const formatCurrency = (value) => {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(value);
};
const form = useForm({
    search: props.filters.search,
});

const formDelete = useForm({});

const isDeleteModalVisible = ref(false);
const productIdToDelete = ref(null);

const openDeleteModal = (id) => {
    productIdToDelete.value = id;
    isDeleteModalVisible.value = true;
};
const closeDeleteModal = () => {
    isDeleteModalVisible.value = false;
    productIdToDelete.value = null;
};
const confirmDelete = (id) => {
    if (id) {
        formDelete.delete(route("admin.products.destroy", id));
        closeDeleteModal();
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Products" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiMenu" title="Products" main>
                <BaseButton
                    :route-name="route('admin.products.create')"
                    :icon="mdiPlus"
                    label="Add"
                    color="info"
                    rounded-full
                    small
                />
            </SectionTitleLineWithButton>
            <NotificationBar
                :key="Date.now()"
                v-if="$page.props.flash && $page.props.flash.message"
                color="success"
                :icon="mdiAlertBoxOutline"
            >
                {{ $page.props.flash.message }}
            </NotificationBar>
            <CardBox class="mb-6" has-table>
                <form @submit.prevent="form.get(route('admin.products.index'))">
                    <div class="py-2 flex">
                        <div class="flex pl-4">
                            <input
                                type="search"
                                v-model="form.search"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Search"
                            />
                            <BaseButton
                                label="Search"
                                type="submit"
                                color="info"
                                class="ml-4 inline-flex items-center px-4 py-2"
                            />
                        </div>
                    </div>
                </form>
            </CardBox>
            <CardBox class="mb-6" has-table>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50"
                        >
                            <tr>
                                <th scope="col" class="p-4">
                                    <Sort label="Tên" attribute="name" />
                                </th>
                                <th scope="col" class="p-4">Danh mục</th>
                                <th scope="col" class="p-4">Đánh giá</th>
                                <th scope="col" class="p-4">Lượng bán</th>
                                <th scope="col" class="p-4">Giá</th>
                                <th scope="col" class="p-4">Cập nhập</th>
                                <th scope="col" class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="product in products.data"
                                :key="product.id"
                                class="border-b hover:bg-gray-100"
                            >
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    <div class="flex items-center mr-3">
                                        <!-- <img
                                            :src="product.image"
                                            alt="Product Image"
                                            class="h-8 w-auto mr-3"
                                        /> -->
                                        {{ product.name }}
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded"
                                        >{{ product.category.name }}</span
                                    >
                                </td>
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            v-for="n in 5"
                                            :key="n"
                                            aria-hidden="true"
                                            class="w-5 h-5"
                                            :class="{
                                                'text-yellow-400':
                                                    n <=
                                                    Math.round(
                                                        product.total_rating /
                                                            product.total_number
                                                    ),
                                                'text-gray-300':
                                                    n >
                                                    Math.round(
                                                        product.total_rating /
                                                            product.total_number ||
                                                            0
                                                    ),
                                            }"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                            />
                                        </svg>
                                        <span class="text-gray-500 ml-1">
                                            ({{
                                                Math.round(
                                                    product.total_rating /
                                                        product.total_number
                                                ) || 0
                                            }})
                                        </span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    {{ product.total_number }}
                                </td>
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    {{
                                        formatCurrency(
                                            product.price_sale || product.price
                                        )
                                    }}
                                </td>
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    {{
                                        new Date(
                                            product.updated_at
                                        ).toLocaleDateString()
                                    }}
                                </td>
                                <td
                                    class="before:hidden lg:w-1 whitespace-nowrap"
                                >
                                    <BaseButtons
                                        type="justify-start lg:justify-end"
                                        no-wrap
                                    >
                                        <BaseButton
                                            :route-name="
                                                route(
                                                    'admin.products.edit',
                                                    product.id
                                                )
                                            "
                                            color="warning"
                                            :icon="mdiSquareEditOutline"
                                            small
                                        />
                                        <BaseButton
                                            color="danger"
                                            :icon="mdiTrashCan"
                                            small
                                            @click="openDeleteModal(product.id)"
                                        />
                                        <!-- Delete Modal Component -->
                                        <DeleteModal
                                            :isVisible="isDeleteModalVisible"
                                            :productId="productIdToDelete"
                                            @close="closeDeleteModal"
                                            @delete="confirmDelete"
                                        />
                                    </BaseButtons>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="py-4">
                    <Pagination :data="products" />
                </div>
            </CardBox>
        </SectionMain>
    </AuthenticatedLayout>
</template>
