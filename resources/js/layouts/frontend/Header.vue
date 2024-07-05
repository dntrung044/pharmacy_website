<template>
    <header class="header clearfix element_to_stick">
        <div class="layer"></div>
        <!-- Opacity Mask Menu Mobile -->
        <div class="container-fluid">
            <div id="logo">
                <a href="index.html">
                    <img
                        src="../../../img/logo.svg"
                        width="140"
                        height="35"
                        alt=""
                        class="logo_normal"
                    />
                    <img
                        src="../../../img/logo_sticky.svg"
                        width="140"
                        height="35"
                        alt=""
                        class="logo_sticky"
                    />
                </a>
            </div>
            <Cart></Cart>
            <nav class="main-menu">
                <div id="header_menu">
                    <a href="#0" class="open_close">
                        <i class="icon_close"></i><span>Menu</span>
                    </a>
                    <a href="/"
                        ><img
                            src="../../../img/logo.svg"
                            width="140"
                            height="35"
                            alt=""
                    /></a>
                </div>
                <ul>
                    <li class="submenu">
                        <router-link
                            :to="{ name: 'Home' }"
                            class="show-submenu"
                            style="text-decoration: none"
                            >Trang chủ</router-link
                        >
                    </li>
                    <li class="submenu">
                        <router-link
                            :to="{ name: 'Menu' }"
                            class="show-submenu"
                            style="text-decoration: none"
                            >Thực đơn</router-link
                        >
                    </li>
                    <li class="submenu">
                        <router-link
                            :to="{ name: 'Blog' }"
                            class="show-submenu"
                            style="text-decoration: none"
                            >Blog</router-link
                        >
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>
<script>
import Cart from "./Cart.vue";

export default {
    name: "Layout",
    components: {
        Cart,
    },
};
</script>
