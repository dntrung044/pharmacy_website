import Home from '../pages/front/HomePage.vue'
import ProductList from '../pages/front/ProductListPage.vue'
import ProductDetail from '../pages/front/ProductDetailPage.vue'
import Cart from '../pages/front/CartPage.vue'
import Transaction from '../pages/front/TransactionPage.vue'
import Login from '../pages/front/LoginPage.vue'
import Register from '../pages/front/RegisterPage.vue'
import Blog from '../pages/front/BlogPage.vue'
import BlogDetail from '../pages/front/BlogDetailPage.vue'

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
