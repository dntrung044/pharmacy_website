<template>
    <LayoutAuthenticated>
        <Head title="Update Post" />
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiMenu"
                title="Update Post"
                main
            >
                <BaseButton
                    :route-name="route('admin.blog.index')"
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
                    form.post(route('admin.blog.update', props.post.id))
                "
            >
                <FormField
                    label="Title"
                    :class="{ 'text-red-400': form.errors.title }"
                >
                    <FormControl
                        v-model="form.title"
                        type="text"
                        placeholder="Enter Title"
                        :error="form.errors.title"
                    >
                        <div
                            class="text-red-400 text-sm"
                            v-if="form.errors.title"
                        >
                            {{ form.errors.title }}
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
                    <FormControl
                        v-model="form.description"
                        type="textarea"
                        placeholder="Enter Description"
                        :error="form.errors.description"
                    >
                        <div
                            class="text-red-400 text-sm"
                            v-if="form.errors.description"
                        >
                            {{ form.errors.description }}
                        </div>
                    </FormControl>
                </FormField>
                <FormField
                    label="Content"
                    :class="{ 'text-red-400': form.errors.content }"
                >
                    <QuillEditor
                        v-model:content="form.content"
                        contentType="html"
                        theme="snow"
                        :error="form.errors.content"
                    />
                </FormField>

                <FormField
                    label="Images"
                    :class="{ 'text-red-400': form.errors.image }"
                >
                    <FormControl type="file" @change="handleFileChange">
                        <img
                            v-if="form.image"
                            :src="form.image"
                            class="w-80 h-60 object-cover rounded-lg ml-1 mt-3"
                        />
                        <div
                            class="text-red-400 text-sm"
                            v-if="form.errors.image"
                        >
                            {{ form.errors.image }}
                        </div>
                    </FormControl>
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
    </LayoutAuthenticated>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
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

const categories = ref([]);
const fetchCategories = () => {
    axios
        .get("/api/blog/categories")
        .then((response) => {
            categories.value = response.data;
        })
        .catch((error) => {
            console.error("Error fetching categories", error);
        });
};

const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    },
});

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.imageFile = file;
        form.image = URL.createObjectURL(file);
    } else {
        form.imageFile = null;
    }
};

const form = useForm({
    _method: "put",
    title: props.post.title,
    description: props.post.description,
    content: props.post.content,
    category_id: props.post.category_id,
    status: props.post.status,
    image: props.post.image,
    imageFile: null,
});

onMounted(fetchCategories);
</script>
