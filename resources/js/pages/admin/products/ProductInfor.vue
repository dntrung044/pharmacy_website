<template>
    <div
        id="drawer-read-product-advanced"
        class="overflow-y-auto fixed top-0 left-0 z-40 p-4 w-full max-w-lg h-screen bg-white transition-transform -translate-x-full"
        tabindex="-1"
        aria-labelledby="drawer-label"
        aria-hidden="true"
    >
        <div v-if="product">
            <div>
                <h4
                    id="read-drawer-label"
                    class="mb-1.5 leading-none text-xl font-semibold text-gray-900"
                >
                    {{ product.name }}
                </h4>
                <h5
                    class="mb-5 text-xl font-bold text-gray-900"
                >
                    <span class="new_price">{{ product.price_sale }}</span>
                    <span class="old_price">{{ product.price }}</span>
                </h5>
            </div>
            <button
                type="button"
                @click="$emit('close')"
                data-drawer-dismiss="drawer-read-product-advanced"
                aria-controls="drawer-read-product-advanced"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center"
            >
                <svg
                    aria-hidden="true"
                    class="w-5 h-5"
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
                <span class="sr-only">Close menu</span>
            </button>
            <div class="grid grid-cols-3 gap-4 mb-4 sm:mb-5">
                <div
                    class="p-2 w-auto bg-gray-100 rounded-lg"
                    v-for="image in product.images"
                    :key="image.id"
                    @change="previewFiles($event)"
                >
                    <img :src="image.url" :alt="image.name" />
                </div>
            </div>
            <dl class="sm:mb-5">
                <dt
                    class="mb-2 font-semibold leading-none text-gray-900"
                >
                    Details
                </dt>
                <dd
                    class="mb-4 font-light text-gray-500 sm:mb-5"
                >
                    {{ product.description }}
                </dd>
            </dl>
            <dl class="grid grid-cols-2 gap-4 mb-4">
                <div
                    class="col-span-2 p-3 bg-gray-100 rounded-lg border border-gray-200 sm:col-span-1"
                >
                    <dt
                        class="mb-2 font-semibold leading-none text-gray-900"
                    >
                        Category
                    </dt>
                    <dd
                        class="flex items-center text-gray-500"
                    >
                        <svg
                            class="w-4 h-4 mr-1.5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        {{ product.category.name }}
                    </dd>
                </div>
                <div
                    class="col-span-2 p-3 bg-gray-100 rounded-lg border border-gray-200 sm:col-span-1"
                >
                    <dt
                        class="mb-2 font-semibold leading-none text-gray-900"
                    >
                        <!-- {{ product.size.name }} -->
                    </dt>
                    <dd
                        class="flex items-center space-x-2 font-light text-gray-500"
                    ></dd>
                </div>
            </dl>
            <div
                class="flex bottom-0 left-0 justify-center pb-4 space-x-4 w-full"
            >
                <button
                    type="button"
                    class="text-white w-full inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                >
                    <svg
                        aria-hidden="true"
                        class="mr-1 -ml-1 w-5 h-5"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                        />
                        <path
                            fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Edit
                </button>
                <button
                    type="button"
                    class="inline-flex w-full items-center text-white justify-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5 mr-1.5 -ml-1"
                        fill="currentColor"
                        viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        />
                    </svg>
                    Delete
                </button>
            </div>
        </div>
        <div v-else>
            <p>Loading...</p>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
};
</script>
