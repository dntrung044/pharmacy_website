import { createRouter, createWebHistory } from 'vue-router';
import userRoutes from './user';
import adminRoutes from './admin';

const routes = [
    ...userRoutes,
    ...adminRoutes
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;