import Home from '../pages/HomePage.vue'
import ProductList from '../pages/ProductListPage.vue'
import ProductDetail from '../pages/ProductDetailPage.vue'
import Cart from '../pages/CartPage.vue'
import Transaction from '../pages/TransactionPage.vue'
import Login from '../pages/LoginPage.vue'
import Register from '../pages/RegisterPage.vue'
import Blog from '../pages/BlogPage.vue'
import BlogDetail from '../pages/BlogDetailPage.vue'

const user = [
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
export default user;
