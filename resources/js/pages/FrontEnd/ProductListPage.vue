<template>
    <GuestLayout>
        <div class="bg-white">
            <div>
                <!-- Mobile filter dialog -->
                <TransitionRoot as="template" :show="mobileFiltersOpen">
                    <Dialog
                        class="relative z-40 lg:hidden"
                        @close="mobileFiltersOpen = false"
                    >
                        <TransitionChild
                            as="template"
                            enter="transition-opacity ease-linear duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="transition-opacity ease-linear duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="fixed inset-0 bg-black bg-opacity-25" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-40 flex">
                            <TransitionChild
                                as="template"
                                enter="transition ease-in-out duration-300 transform"
                                enter-from="translate-x-full"
                                enter-to="translate-x-0"
                                leave="transition ease-in-out duration-300 transform"
                                leave-from="translate-x-0"
                                leave-to="translate-x-full"
                            >
                                <DialogPanel
                                    class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"
                                >
                                    <div
                                        class="flex items-center justify-between px-4"
                                    >
                                        <h2
                                            class="text-lg font-medium text-gray-900"
                                        >
                                            Filters
                                        </h2>
                                        <button
                                            type="button"
                                            class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                            @click="mobileFiltersOpen = false"
                                        >
                                            <span class="sr-only"
                                                >Close menu</span
                                            >
                                            <XMarkIcon
                                                class="h-6 w-6"
                                                aria-hidden="true"
                                            />
                                        </button>
                                    </div>

                                    <!-- Filters -->
                                    <div class="mt-4 border-t border-gray-200">
                                        <Disclosure
                                            as="div"
                                            class="border-t border-gray-200 px-4 py-6"
                                            v-slot="{ open }"
                                        >
                                            <h3 class="-mx-2 -my-3 flow-root">
                                                <DisclosureButton
                                                    class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                                >
                                                    <span
                                                        class="font-medium text-gray-900"
                                                        >Category</span
                                                    >
                                                    <span
                                                        class="ml-6 flex items-center"
                                                    >
                                                        <PlusIcon
                                                            v-if="!open"
                                                            class="h-5 w-5"
                                                            aria-hidden="true"
                                                        />
                                                        <MinusIcon
                                                            v-else
                                                            class="h-5 w-5"
                                                            aria-hidden="true"
                                                        />
                                                    </span>
                                                </DisclosureButton>
                                            </h3>
                                            <DisclosurePanel class="pt-6">
                                                <div class="space-y-6">
                                                    <div
                                                        v-for="(
                                                            category, id
                                                        ) in categories"
                                                        :key="id"
                                                        class="flex items-center"
                                                    >
                                                        <input
                                                            :value="id"
                                                            @change="
                                                                toggleCategorySelection(
                                                                    id
                                                                )
                                                            "
                                                            type="checkbox"
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                        />
                                                        <label
                                                            class="ml-3 min-w-0 flex-1 text-gray-500"
                                                            >{{
                                                                category.name
                                                            }}
                                                            <small>{{
                                                                category.count
                                                            }}</small></label
                                                        >
                                                    </div>
                                                </div>
                                            </DisclosurePanel>
                                        </Disclosure>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </Dialog>
                </TransitionRoot>

                <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div
                        class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24"
                    >
                        <Title
                            class="text-4xl font-bold tracking-tight text-gray-900"
                        />

                        <div class="flex items-center">
                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                            >
                                <div>
                                    <MenuButton
                                        class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                    >
                                        Sort
                                        <ChevronDownIcon
                                            class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                            aria-hidden="true"
                                        />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <div class="py-1">
                                            <MenuItem
                                                v-for="option in sortOptions"
                                                v-slot="{ active }"
                                                v-model="sortOption"
                                                @change="sortProducts"
                                            >
                                                <a
                                                    :value="option.value"
                                                    :class="[
                                                        option.current
                                                            ? 'font-medium text-gray-900'
                                                            : 'text-gray-500',
                                                        active
                                                            ? 'bg-gray-100'
                                                            : '',
                                                        'block px-4 py-2 text-sm',
                                                    ]"
                                                    >{{ option.name }}</a
                                                >
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>

                            <button
                                type="button"
                                class="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7"
                            >
                                <span class="sr-only">View grid</span>
                                <Squares2X2Icon
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                />
                            </button>
                            <button
                                type="button"
                                class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                                @click="mobileFiltersOpen = true"
                            >
                                <span class="sr-only">Filters</span>
                                <FunnelIcon
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                />
                            </button>
                        </div>
                    </div>

                    <section
                        aria-labelledby="products-heading"
                        class="pb-24 pt-6"
                    >
                        <h2 id="products-heading" class="sr-only">Products</h2>

                        <div
                            class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4"
                        >
                            <!-- Filters -->
                            <div class="hidden lg:block">
                                <Disclosure
                                    as="div"
                                    class="border-b border-gray-200 py-6"
                                    v-slot="{ open }"
                                >
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >Category</span
                                            >
                                            <span
                                                class="ml-6 flex items-center"
                                            >
                                                <PlusIcon
                                                    v-if="!open"
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                                <MinusIcon
                                                    v-else
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div
                                                v-for="(
                                                    category, id
                                                ) in categories"
                                                :key="id"
                                                class="flex items-center"
                                            >
                                                <input
                                                    type="checkbox"
                                                    :value="id"
                                                    @change="
                                                        toggleCategorySelection(
                                                            id
                                                        )
                                                    "
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                />
                                                <label
                                                    class="ml-3 text-sm text-gray-600"
                                                    >{{
                                                        category.name
                                                    }}
                                                    (<small>{{
                                                        category.count
                                                    }}</small
                                                    >)
                                                </label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                                <Disclosure
                                    as="div"
                                    class="border-b border-gray-200 py-6"
                                    v-slot="{ open }"
                                >
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >Price</span
                                            >
                                            <span
                                                class="ml-6 flex items-center"
                                            >
                                                <PlusIcon
                                                    v-if="!open"
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                                <MinusIcon
                                                    v-else
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div
                                                v-for="(
                                                    range, index
                                                ) in priceRanges"
                                                :key="index"
                                                class="flex items-center"
                                            >
                                                <input
                                                    type="checkbox"
                                                    :value="id"
                                                    @change="
                                                        filterByPriceRange(
                                                            range
                                                        )
                                                    "
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                />
                                                <label
                                                    class="ml-3 text-sm text-gray-600"
                                                >
                                                    {{ range.min }} — ${{
                                                        range.max
                                                    }}
                                                    đ
                                                    <small>{{
                                                        getProductsCountInPriceRange(
                                                            range.min,
                                                            range.max
                                                        )
                                                    }}</small>
                                                </label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                                <Disclosure
                                    as="div"
                                    class="border-b border-gray-200 py-6"
                                    v-slot="{ open }"
                                >
                                    <h3 class="-my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >Rating</span
                                            >
                                            <span
                                                class="ml-6 flex items-center"
                                            >
                                                <PlusIcon
                                                    v-if="!open"
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                                <MinusIcon
                                                    v-else
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div class="flex items-center">
                                                <input
                                                    type="checkbox"
                                                    :value="id"
                                                    @change="
                                                        filterByRating(4.5)
                                                    "
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                />
                                                <label
                                                    class="ml-3 text-sm text-gray-600"
                                                >
                                                    Tuyệt vời(4.5+)
                                                    <small>{{
                                                        getRatingCount(4.5)
                                                    }}</small>
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input
                                                    type="checkbox"
                                                    :value="id"
                                                    @change="filterByRating(4)"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                />
                                                <label
                                                    class="ml-3 text-sm text-gray-600"
                                                >
                                                    Rất tốt(4+)
                                                    <small>{{
                                                        getRatingCount(4)
                                                    }}</small>
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input
                                                    type="checkbox"
                                                    :value="id"
                                                    @change="
                                                        filterByRating(3.5)
                                                    "
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                />
                                                <label
                                                    class="ml-3 text-sm text-gray-600"
                                                >
                                                    Tốt(3.5+)
                                                    <small>{{
                                                        getRatingCount(3.5)
                                                    }}</small>
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input
                                                    type="checkbox"
                                                    :value="id"
                                                    @change="filterByRating(3)"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                />
                                                <label
                                                    class="ml-3 text-sm text-gray-600"
                                                >
                                                    Tạm(3+)
                                                    <b
                                                        class="ml-20 float-right"
                                                        >{{
                                                            getRatingCount(3)
                                                        }}</b
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>

                            <!-- Product grid -->
                            <div class="lg:col-span-3">
                                <!-- products -->
                                <div
                                    class="grid md:grid-cols-3 grid-cols-2 gap-6"
                                >
                                    <div
                                        v-for="product in paginatedProducts"
                                        :key="product.id"
                                        class="bg-gray-200 rounded-xl cursor-pointer hover:scale-[1.03] transition-all relative overflow-hidden"
                                    >
                                        <div class="p-6">
                                            <div
                                                class="bg-gray-100 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16px"
                                                    class="fill-gray-800 inline-block"
                                                    viewBox="0 0 64 64"
                                                >
                                                    <path
                                                        d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                        data-original="#000000"
                                                    ></path>
                                                </svg>
                                            </div>

                                            <div
                                                class="w-2/3 h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8"
                                            >
                                                <img
                                                    :src="product.thumbnail"
                                                    alt="Product 1"
                                                    class="h-full w-full object-contain"
                                                />
                                            </div>
                                        </div>

                                        <div
                                            class="text-center bg-gray-100 p-4"
                                        >
                                            <h3
                                                class="text-lg font-bold text-gray-800"
                                            >
                                                {{ product.name }}
                                            </h3>
                                            <!-- rating -->
                                            <div
                                                class="flex justify-center space-x-1 mt-3"
                                            >
                                                <svg
                                                    class="w-4 fill-[#facc15]"
                                                    viewBox="0 0 14 13"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                                    />
                                                </svg>

                                                <svg
                                                    class="w-4 fill-[#CED5D8]"
                                                    viewBox="0 0 14 13"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                                    />
                                                </svg>

                                                <h5
                                                    class="text-gray-400 ml-2 font-bold"
                                                >
                                                    (1,889)
                                                </h5>
                                            </div>

                                            <!-- price -->
                                            <h4
                                                class="text-lg text-gray-800 font-bold"
                                            >
                                                {{
                                                    product.price_sale ||
                                                    product.price
                                                }}đ
                                                <strike
                                                    class="text-gray-400 ml-2 font-medium"
                                                    v-if="product.price_sale"
                                                    >{{
                                                        product.price
                                                    }}đ</strike
                                                >
                                            </h4>
                                            <!--  add to cart -->
                                            <button
                                                type="button"
                                                class="w-full flex items-center justify-center gap-3 mt-4 px-6 py-3 bg-yellow-400 text-base text-gray-800 font-semibold rounded-xl"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20px"
                                                    height="20px"
                                                    viewBox="0 0 512 512"
                                                >
                                                    <path
                                                        d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                                                        data-original="#000000"
                                                    ></path>
                                                </svg>
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Paginate -->
                                <Paginate
                                    v-if="sortedProducts.length > itemsPerPage"
                                    :page-count="pageCount"
                                    :click-handler="handlePageClick"
                                    :container-class="'pagination'"
                                    :page-class="'page-item'"
                                    :page-link-class="'page-link'"
                                    :prev-text="'«'"
                                    :next-text="'»'"
                                ></Paginate>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </GuestLayout>
</template>
<script setup>
import axios from "axios";
import { ref, computed, onMounted } from "vue";
import GuestLayout from "../../Layouts/GuestLayout.vue";
import Title from "../../Layouts/Frontend/Title.vue";
import Paginate from "vuejs-paginate-next";
import { useCartStore } from "../../Stores/useCartStore";
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import {
    ChevronDownIcon,
    FunnelIcon,
    MinusIcon,
    PlusIcon,
    Squares2X2Icon,
} from "@heroicons/vue/20/solid";

const sortOptions = [
    { name: "Most Popular", value: "popularity", current: true },
    { name: "Best Rating", value: "rating", current: false },
    { name: "Newest", value: "date", current: false },
    { name: "Price: Low to High", value: "price", current: false },
    { name: "Price: High to Low", value: "desc", current: false },
];
const filters = [
    {
        id: "size",
        name: "Size",
        options: [
            { value: "2l", label: "2L", checked: false },
            { value: "6l", label: "6L", checked: false },
            { value: "12l", label: "12L", checked: false },
            { value: "18l", label: "18L", checked: false },
            { value: "20l", label: "20L", checked: false },
            { value: "40l", label: "40L", checked: true },
        ],
    },
];

const mobileFiltersOpen = ref(false);
const products = ref([]);
const categories = ref([]);
const selectedCategories = ref([]);
const priceRanges = [
    { min: 0, max: 20000 },
    { min: 20000, max: 50000 },
    { min: 50000, max: 150000 },
];
const filteredPriceRange = ref(null);
const sortOption = ref("popularity");
const filteredRating = ref(null);
const currentPage = ref(1);
const itemsPerPage = ref(6);
const cartStore = useCartStore();

const fetchProducts = () => {
    axios
        .get("/api/products")
        .then((response) => {
            products.value = response.data;
            countProductsByCategory();
        })
        .catch((error) => {
            console.error("There was an error fetching the products!", error);
        });
};

const fetchProductsByCategory = () => {
    const url = `/api/by-category?categories=${selectedCategories.value.join(
        ","
    )}`;
    console.log("Fetching products by category with URL:", url);
    axios
        .get(url)
        .then((response) => {
            products.value = response.data;
        })
        .catch((error) => {
            console.error(
                "There was an error fetching the products by category!",
                error
            );
        });
};

const countProductsByCategory = () => {
    const categoryCounts = {};

    products.value.forEach((product) => {
        const category = product.category;
        if (category) {
            if (categoryCounts[category.id]) {
                categoryCounts[category.id].count++;
            } else {
                categoryCounts[category.id] = {
                    name: category.name,
                    count: 1,
                };
            }
        }
    });

    categories.value = categoryCounts;
};

const sortProducts = () => {
    currentPage.value = 1;
};

const toggleCategorySelection = (categoryId) => {
    if (selectedCategories.value.includes(categoryId)) {
        selectedCategories.value = selectedCategories.value.filter(
            (id) => id !== categoryId
        );
    } else {
        selectedCategories.value.push(categoryId);
    }
    fetchProductsByCategory(); // Call API when checkbox is selected
};

const filterByRating = (rating) => {
    filteredRating.value = rating;
};

const filterByPriceRange = (range) => {
    if (
        filteredPriceRange.value &&
        filteredPriceRange.value.min === range.min &&
        filteredPriceRange.value.max === range.max
    ) {
        filteredPriceRange.value = null; // Uncheck the checkbox
    } else {
        filteredPriceRange.value = range;
    }
};

const getRatingCount = (rating) => {
    return products.value.filter(
        (product) => product.total_number / product.total_rating >= rating
    ).length;
};

const getProductsCountInPriceRange = (min, max) => {
    return products.value.filter(
        (product) => product.price >= min && product.price <= max
    ).length;
};

const handlePageClick = (pageNumber) => {
    currentPage.value = pageNumber;
};

const sortedProducts = computed(() => {
    let sorted = [...products.value];
    if (sortOption.value === "rating") {
        sorted.sort((a, b) => {
            const ratingA = a.total_number / a.total_rating;
            const ratingB = b.total_number / b.total_rating;
            return ratingB - ratingA;
        });
    } else if (sortOption.value === "date") {
        sorted.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));
    } else if (sortOption.value === "price") {
        sorted.sort((a, b) => a.price_sale - b.price_sale);
    } else if (sortOption.value === "price-desc") {
        sorted.sort((a, b) => b.price_sale - a.price_sale);
    }

    if (filteredRating.value !== null) {
        sorted = sorted.filter(
            (product) =>
                product.total_number / product.total_rating >=
                filteredRating.value
        );
    }
    if (filteredPriceRange.value) {
        sorted = sorted.filter(
            (product) =>
                product.price >= filteredPriceRange.value.min &&
                product.price <= filteredPriceRange.value.max
        );
    }

    return sorted;
});

const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return sortedProducts.value.slice(start, end);
});

const pageCount = computed(() => {
    return Math.ceil(sortedProducts.value.length / itemsPerPage.value);
});

const startIndex = computed(() => {
    return (currentPage.value - 1) * itemsPerPage.value;
});

const endIndex = computed(() => {
    return Math.min(
        startIndex.value + itemsPerPage.value,
        sortedProducts.value.length
    );
});

const formatCurrency = (value) => {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(value);
};

const addToCart = (product) => {
    cartStore.addToCart(product);
};

onMounted(fetchProducts);
</script>

<style scope>
.no-underline {
    text-decoration: none;
}
</style>
