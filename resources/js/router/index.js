import { createWebHistory, createRouter } from 'vue-router'
import Home from '../pages/Home.vue'
import ProductList from '../pages/ProductList.vue'
import ProductDetail from '../pages/ProductDetail.vue';
import Cart from '../pages/Cart.vue';
import Transaction from '../pages/Transaction.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home,

    },
    {
        name: 'Menu',
        path: '/menu',
        component: ProductList,
    },
    {
        path: '/menu/:id',
        name: 'product-detail',
        component: ProductDetail,
        props: true
    },
    {
        name: 'Cart',
        path: '/cart',
        component: Cart,
    },
    {
        name: 'Transaction',
        path: '/checkout',
        component: Transaction,
    },
    {
        name: 'Login',
        path: '/login',
        component: Login,
    },
    {
        name: 'Register',
        path: '/register',
        component: Register,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
