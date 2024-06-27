import { createWebHistory, createRouter } from 'vue-router'
import index from '../pages/Index.vue'
import ProductList from '../pages/ProductList.vue'
import ProductDetail from '../pages/ProductDetail.vue';
import Cart from '../pages/Cart.vue';
import Transaction from '../pages/Transaction.vue';

const routes = [
    {
        name: 'index',
        path: '/',
        component: index,

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
        path: '/shop-cart',
        component: Cart,
    },
    {
        name: 'Transaction',
        path: '/shop-checkout',
        component: Transaction,
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
