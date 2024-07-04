import { createWebHistory, createRouter } from 'vue-router'
import Home from '../pages/Home.vue'
import ProductList from '../pages/ProductList.vue'
import ProductDetail from '../pages/ProductDetail.vue';
import Cart from '../pages/Cart.vue';
import Transaction from '../pages/Transaction.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Blog from '../pages/Blog.vue';
import BlogDetail from '../pages/BlogDetail.vue';


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
    {
        name: 'Blog',
        path: '/blog',
        component: Blog,
    },
    {
        path: '/blog/posts/:postId',
        name: 'PostDetails',
        component: BlogDetail,
        props: true
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
