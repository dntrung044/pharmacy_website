import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../layouts/admin/master/Dashboard.vue';
import Home from '../pages/admin/Home.vue';

// Product components
import ProductsList from '../pages/admin/products/ProductsList.vue';

// User components
import UsersList from '../pages/admin/users/UsersList.vue';

// Transaction components
import TransactionsList from '../pages/admin/transactions/TransactionsList.vue';

// Coupon components
import CouponsList from '../pages/admin/coupons/CouponsList.vue';

// Blog components
import BlogsList from '../pages/admin/blogs/BlogsList.vue';

const admin = [
    {
        name: 'Dashboard',
        path: '/admin',
        component: Dashboard,
        redirect: '/admin/home',
        children: [
            {
                name: 'admin-home',
                path: 'home',
                component: Home
            },
            // Products
            {
                name: 'admin-products',
                path: 'products',
                component: ProductsList
            },

            // Users
            {
                name: 'users',
                path: 'users',
                component: UsersList
            },

            // Transactions
            {
                name: 'transactions',
                path: 'transactions',
                component: TransactionsList
            },

            // Coupons
            {
                name: 'coupons',
                path: 'coupons',
                component: CouponsList
            },
            // Blog
            {
                name: 'blogs',
                path: 'blogs',
                component: BlogsList
            },
        ]
    },
];

export default admin;
