<template>
    <!-- Start block -->
    <section class="bg-gray-50 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div
                class="bg-white relative shadow-md sm:rounded-lg overflow-hidden"
            >
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
                >
                    <div class="flex-1 flex items-center space-x-2">
                        <h5>
                            <span class="text-gray-500"
                                >Danh sách sản phẩm</span
                            >
                        </h5>
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t"
                >
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only"
                                >Tìm kiếm</label
                            >
                            <div class="relative w-full">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                >
                                    <svg
                                        aria-hidden="true"
                                        class="w-5 h-5 text-gray-500"
                                        fill="currentColor"
                                        viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="simple-search"
                                    placeholder="Search for products"
                                    required=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                />
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
                    >
                        <button
                            id="filterDropdownButton"
                            data-dropdown-toggle="filterDropdown"
                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                            type="button"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true"
                                class="h-4 w-4 mr-1.5 -ml-1 text-gray-400"
                                viewbox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Tùy chọn bộ lọc
                            <svg
                                class="-mr-1 ml-1.5 w-5 h-5"
                                fill="currentColor"
                                viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true"
                            >
                                <path
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                />
                            </svg>
                        </button>
                        <div
                            id="filterDropdown"
                            class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 right-0"
                        >
                            <div class="flex items-center justify-between pt-2">
                                <h6
                                    class="text-sm font-medium text-black"
                                >
                                    Bộ lọc
                                </h6>
                                <div class="flex items-center space-x-3">
                                    <a
                                        href="#"
                                        class="flex items-center text-sm font-medium text-primary-600 hover:underline"
                                        >Xoá hết</a
                                    >
                                </div>
                            </div>
                            <div
                                id="accordion-flush"
                                data-accordion="collapse"
                                data-active-classes="text-black"
                                data-inactive-classes="text-gray-500"
                            >
                                <!-- Category -->
                                <h2 id="category-heading">
                                    <button
                                        type="button"
                                        class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-50"
                                        data-accordion-target="#category-body"
                                        aria-expanded="false"
                                        aria-controls="category-body"
                                    >
                                        <span>Danh mục</span>
                                        <svg
                                            aria-hidden="true"
                                            data-accordion-icon=""
                                            class="w-5 h-5 rotate-180 shrink-0"
                                            fill="currentColor"
                                            viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            />
                                        </svg>
                                    </button>
                                </h2>
                                <div
                                    id="category-body"
                                    class="hidden"
                                    aria-labelledby="category-heading"
                                >
                                    <div
                                        class="py-2 font-light border-b border-gray-200"
                                    >
                                        <ul class="space-y-2">
                                            <li
                                                class="flex items-center"
                                                v-for="(
                                                    category, id
                                                ) in categories"
                                                :key="id"
                                            >
                                                <input
                                                    type="checkbox"
                                                    :value="id"
                                                    @change="
                                                        toggleCategorySelection(
                                                            id
                                                        )
                                                    "
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2"
                                                />
                                                <label
                                                    for="apple"
                                                    class="ml-2 text-sm font-medium text-gray-900"
                                                    >{{ category.name }} ({{
                                                        category.count
                                                    }})</label
                                                >
                                            </li>
                                            <a
                                                href="#"
                                                class="flex items-center text-sm font-medium text-primary-600 hover:underline"
                                                >Xem tất cả</a
                                            >
                                        </ul>
                                    </div>
                                </div>
                                <!-- Price -->
                                <h2 id="price-heading">
                                    <button
                                        type="button"
                                        class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 hover:bg-gray-50"
                                        data-accordion-target="#price-body"
                                        aria-expanded="false"
                                        aria-controls="price-body"
                                    >
                                        <span>Giá</span>
                                        <svg
                                            aria-hidden="true"
                                            data-accordion-icon=""
                                            class="w-5 h-5 rotate-180 shrink-0"
                                            fill="currentColor"
                                            viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            />
                                        </svg>
                                    </button>
                                </h2>
                                <div
                                    id="price-body"
                                    class="hidden"
                                    aria-labelledby="price-heading"
                                >
                                    <div
                                        class="flex items-center py-2 space-x-3 font-light border-b border-gray-200"
                                    >
                                        <select
                                            id="price-from"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        >
                                            <option disabled="" selected="">
                                                Từ
                                            </option>
                                            <option>$500</option>
                                            <option>$2500</option>
                                            <option>$5000</option></select
                                        ><select
                                            id="price-to"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        >
                                            <option disabled="" selected="">
                                                To
                                            </option>
                                            <option>$500</option>
                                            <option>$2500</option>
                                            <option>$5000</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Rating -->
                                <h2 id="rating-heading">
                                    <button
                                        type="button"
                                        class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 hover:bg-gray-50"
                                        data-accordion-target="#rating-body"
                                        aria-expanded="false"
                                        aria-controls="rating-body"
                                    >
                                        <span>Đánh giá</span>
                                        <svg
                                            aria-hidden="true"
                                            data-accordion-icon=""
                                            class="w-5 h-5 rotate-180 shrink-0"
                                            fill="currentColor"
                                            viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            />
                                        </svg>
                                    </button>
                                </h2>
                                <div
                                    id="rating-body"
                                    class="hidden"
                                    aria-labelledby="rating-heading"
                                >
                                    <div
                                        class="py-2 space-y-2 font-light border-b border-gray-200"
                                    >
                                        <div class="flex items-center">
                                            <input
                                                id="five-stars"
                                                type="radio"
                                                value=""
                                                name="rating"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-2"
                                            />
                                            <label
                                                for="five-stars"
                                                class="flex items-center ml-2"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input
                                                id="four-stars"
                                                type="radio"
                                                value=""
                                                name="rating"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-2"
                                            />
                                            <label
                                                for="four-stars"
                                                class="flex items-center ml-2"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input
                                                id="three-stars"
                                                type="radio"
                                                value=""
                                                name="rating"
                                                checked=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-2"
                                            />
                                            <label
                                                for="three-stars"
                                                class="flex items-center ml-2"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input
                                                id="two-stars"
                                                type="radio"
                                                value=""
                                                name="rating"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-2"
                                            />
                                            <label
                                                for="two-stars"
                                                class="flex items-center ml-2"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input
                                                id="one-star"
                                                type="radio"
                                                value=""
                                                name="rating"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-2"
                                            />
                                            <label
                                                for="one-star"
                                                class="flex items-center ml-2"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-gray-300"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex-shrink-0 flex flex-col items-start md:flex-row md:items-center lg:justify-end space-y-3 md:space-y-0 md:space-x-3"
                        >
                            <button
                                type="button"
                                id="createProductButton"
                                data-modal-target="createProductModal"
                                data-modal-toggle="createProductModal"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none"
                            >
                                <svg
                                    class="h-3.5 w-3.5 mr-1.5 -ml-1"
                                    fill="currentColor"
                                    viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true"
                                >
                                    <path
                                        clip-rule="evenodd"
                                        fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    />
                                </svg>
                                Thêm sản phẩm
                            </button>
                        </div>
                    </div>
                </div>

                <!-- List -->
                <div class="overflow-x-auto">
                    <table
                        class="w-full text-sm text-left text-gray-500"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50"
                        >
                            <tr>
                                <th scope="col" class="p-4">Tên</th>
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
                                v-for="product in paginatedProducts"
                                :key="product.id"
                                :product="product"
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
                                                            product.total_number
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
                                        <span
                                            class="text-gray-500 ml-1"
                                        >
                                            ({{
                                                Math.round(
                                                    product.total_rating /
                                                        product.total_number
                                                )
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
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    <div class="flex items-center space-x-4">
                                        <button
                                            type="button"
                                            @click="showEditModal(product)"
                                            data-drawer-target="drawer-update-product"
                                            data-drawer-show="drawer-update-product"
                                            aria-controls="drawer-update-product"
                                            class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-2 -ml-0.5"
                                                viewbox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
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
                                            Sửa
                                        </button>
                                        <button
                                            type="button"
                                            data-drawer-target="drawer-read-product-advanced"
                                            data-drawer-show="drawer-read-product-advanced"
                                            aria-controls="drawer-read-product-advanced"
                                            @click="showDetailsModal(product)"
                                            class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 24 24"
                                                fill="currentColor"
                                                class="w-4 h-4 mr-2 -ml-0.5"
                                            >
                                                <path
                                                    d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                                                />
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                                />
                                            </svg>
                                            Chi tiết
                                        </button>
                                        <button
                                            type="button"
                                            @click="showDeleteModal(product)"
                                            data-modal-target="delete-modal"
                                            data-modal-toggle="delete-modal"
                                            class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-2 -ml-0.5"
                                                viewbox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            Xoá
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- pagiantion -->
                <nav
                    class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation"
                >
                    <span
                        class="text-sm font-normal text-gray-500"
                    >
                        Đang hiển thị
                        <span
                            class="font-semibold text-gray-900"
                            >{{ startIndex + 1 }}-{{ endIndex }}</span
                        >
                        của
                        <span
                            class="font-semibold text-gray-900"
                        >
                            {{ sortedProducts.length }} kết quả.</span
                        >
                    </span>
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
                </nav>
            </div>
        </div>
    </section>
    <!-- Add Drawer -->
    <AddModal />
    <!-- Infor Drawer -->
    <InforModal :product="selectedProduct" />
    <!-- Preview Drawer -->
    <EditModal :product="selectedProduct" />
    <!-- Delete Drawer -->
    <DeleteModal :product="selectedProduct" />
</template>

<script>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import DeleteModal from "./ProductDelete.vue";
import EditModal from "./ProductEdit.vue";
import InforModal from "./ProductInfor.vue";
import AddModal from "./ProductAdd.vue";
import { useToast } from "vue-toastification";

import axios from "axios";
import { ref, computed } from "vue";
import Paginate from "vuejs-paginate-next";

export default {
    components: {
        AddModal,
        DeleteModal,
        EditModal,
        InforModal,
        Paginate,
    },
    data() {
        return {
            products: [],
            categories: [],
            selectedCategories: [],
            priceRanges: [
                { min: 0, max: 20000 },
                { min: 20000, max: 50000 },
                { min: 50000, max: 150000 },
            ],
            filteredPriceRange: null,
            sortOption: "popularity",
            filteredRating: null,
            currentPage: 1,
            itemsPerPage: 6,
            selectedProduct: null,
        };
    },
    methods: {
        fetchProducts() {
            axios
                .get("/api/products")
                .then((response) => {
                    this.products = response.data;
                    this.countProductsByCategory();
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the products!",
                        error
                    );
                });
        },
        fetchProductsByCategory() {
            const url = `/api/products/by-category?categories=${this.selectedCategories.join(
                ","
            )}`;
            console.log("Fetching products by category with URL:", url);
            axios
                .get(url)
                .then((response) => {
                    this.products = response.data;
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the products by category!",
                        error
                    );
                });
        },
        countProductsByCategory() {
            const categoryCounts = {};

            this.products.forEach((product) => {
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

            this.categories = categoryCounts;
        },
        sortProducts() {
            this.currentPage = 1;
        },
        toggleCategorySelection(categoryId) {
            if (this.selectedCategories.includes(categoryId)) {
                this.selectedCategories = this.selectedCategories.filter(
                    (id) => id !== categoryId
                );
            } else {
                this.selectedCategories.push(categoryId);
            }
            this.fetchProductsByCategory();
        },
        filterByRating(rating) {
            this.filteredRating = rating;
        },
        filterByPriceRange(range) {
            if (
                this.filteredPriceRange &&
                this.filteredPriceRange.min === range.min &&
                this.filteredPriceRange.max === range.max
            ) {
                this.filteredPriceRange = null;
            } else {
                this.filteredPriceRange = range;
            }
        },
        getRatingCount(rating) {
            return this.products.filter(
                (product) =>
                    product.total_number / product.total_rating >= rating
            ).length;
        },
        getProductsCountInPriceRange(min, max) {
            return this.products.filter(
                (product) => product.price >= min && product.price <= max
            ).length;
        },

        handlePageClick(pageNumber) {
            this.currentPage = pageNumber;
        },
        showDetailsModal(product) {
            this.selectedProduct = product;
        },
        formatCurrency(value) {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
        showEditModal(product) {
            this.selectedProduct = product;
        },
        showDeleteModal(product) {
            this.selectedProduct = product;
        },
    },
    computed: {
        //Sort and filter
        sortedProducts() {
            let sorted = [...this.products];
            if (this.sortOption === "rating") {
                sorted.sort((a, b) => {
                    const ratingA = a.total_number / a.total_rating;
                    const ratingB = b.total_number / b.total_rating;
                    return ratingB - ratingA;
                });
            } else if (this.sortOption === "date") {
                sorted.sort(
                    (a, b) => new Date(b.updated_at) - new Date(a.updated_at)
                );
            } else if (this.sortOption === "price") {
                sorted.sort((a, b) => a.price_sale - b.price_sale);
            } else if (this.sortOption === "price-desc") {
                sorted.sort((a, b) => b.price_sale - a.price_sale);
            }

            if (this.filteredRating !== null) {
                sorted = sorted.filter(
                    (product) =>
                        product.total_number / product.total_rating >=
                        this.filteredRating
                );
            }
            if (this.filteredPriceRange) {
                sorted = sorted.filter(
                    (product) =>
                        product.price >= this.filteredPriceRange.min &&
                        product.price <= this.filteredPriceRange.max
                );
            }

            return sorted;
        },
        // Pagination
        paginatedProducts() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.sortedProducts.slice(start, end);
        },
        pageCount() {
            return Math.ceil(this.sortedProducts.length / this.itemsPerPage);
        },
        startIndex() {
            return (this.currentPage - 1) * this.itemsPerPage;
        },
        endIndex() {
            return Math.min(
                this.startIndex + this.itemsPerPage,
                this.sortedProducts.length
            );
        },
    },
    mounted() {
        onMounted(() => {
            initFlowbite();
        });
        this.fetchProducts();
    },
};
</script>
