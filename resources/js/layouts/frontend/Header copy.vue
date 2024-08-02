<template>
    <header class="shadow bg-[#CDA566] text-white">
        <div
            class="relative flex max-w-screen-xl flex-col overflow-hidden px-4 py-4 sm:mx-auto sm:flex-row"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-8 h-8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"
                />
            </svg>

            <input type="checkbox" class="peer hidden" id="navbar-open" />
            <label
                class="absolute right-4 top-5 cursor-pointer sm:hidden"
                for="navbar-open"
            >
                <span class="sr-only">Toggle menu</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </label>
            <nav
                aria-labelledby="header-navigation"
                class="peer-checked:mt-8 peer-checked:max-h-32 flex max-h-0 w-full flex-col items-center justify-between overflow-hidden transition-all sm:ml-24 sm:max-h-full sm:flex-row sm:items-start text-white"
            >
                <h2 class="sr-only" id="header-navigation">
                    Header navigation
                </h2>
                <ul class="flex flex-col items-center sm:flex-row">
                    <li class="font-bold sm:mr-12">
                        <Link :href="route('frontend.home')">Home</Link>
                    </li>
                    <li class="text-white sm:mr-12">
                        <Link :href="route('frontend.shop')">Shop</Link>
                    </li>
                    <li class="text-white sm:mr-12">
                        <Link :href="route('frontend.shop')">About</Link>
                    </li>
                    <li class="text-white sm:mr-12">
                        <Link :href="route('frontend.blog')">Blog</Link>
                    </li>
                </ul>
                <ul class="mt-4 flex sm:mt-0">
                    <li
                        class="ml-6 flex h-8 w-8 cursor-pointer items-center justify-center text-gray-600 hover:text-black hover:shadow"
                    >
                        <Link :href="route('frontend.cart')">
                            <div
                                class="flex min-h-screen items-center justify-center"
                            >
                                <div class="relative scale-75">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-8 w-8 text-white"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"
                                        />
                                    </svg>
                                    <span
                                        class="absolute -top-2 left-6 rounded-full bg-white p-0.5 px-2 text-black"
                                        >12</span
                                    >
                                </div>
                            </div>
                        </Link>
                    </li>
                    <li
                        class="ml-6 flex h-8 w-8 cursor-pointer items-center justify-center rounded-xl border text-gray-600 hover:text-black hover:shadow"
                    >
                        <Link :href="route('login')">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-white"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                />
                            </svg>
                        </Link>
                    </li>
                    <li
                        class="ml-6 flex h-8 w-8 cursor-pointer items-center justify-center rounded-xl border text-gray-600 hover:text-black hover:shadow"
                    >
                        <Link :href="route('profile.edit')">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-white"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                />
                            </svg>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>
