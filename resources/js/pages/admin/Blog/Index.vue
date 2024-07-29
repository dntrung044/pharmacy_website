<script setup>
import { ref, defineProps } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
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
    posts: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});
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
        formDelete.delete(route("admin.blog.destroy", id));
        closeDeleteModal();
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="List Post" />
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiMenu" title="List Post" main>
                <BaseButton
                    :route-name="route('admin.blog.create')"
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
                <form @submit.prevent="form.get(route('admin.blog.index'))">
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
                                    <Sort label="Tiêu đề" attribute="name" />
                                </th>
                                <th scope="col" class="p-4">Mô tả</th>
                                <th scope="col" class="p-4">Danh mục</th>
                                <th scope="col" class="p-4">Người đăng</th>
                                <th scope="col" class="p-4">Cập nhập</th>
                                <th scope="col" class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="post in posts.data"
                                :key="post.id"
                                class="border-b hover:bg-gray-100"
                            >
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    <div class="flex items-center mr-3">
                                        {{ post.title }}
                                    </div>
                                </td>

                                <td>
                                    <span
                                        class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded"
                                        >{{ post.description }}</span
                                    >
                                </td>
                                <td>
                                    <span
                                        class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded"
                                        >{{ post.category.name }}</span
                                    >
                                </td>
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    {{ post.user.name }}
                                </td>
                                <td
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    {{
                                        new Date(
                                            post.updated_at
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
                                                    'admin.blog.edit',
                                                    post.id
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
                                            @click="openDeleteModal(post.id)"
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
                    <Pagination :data="posts" />
                </div>
            </CardBox>
        </SectionMain>
    </AuthenticatedLayout>
</template>
