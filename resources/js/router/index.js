import { createWebHistory, createRouter } from 'vue-router'
import index from '../pages/Index.vue'
import ProductList from '../pages/ProductList.vue'
import ProductDetail from '../pages/ProductDetail.vue';

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

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
