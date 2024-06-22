import { createWebHistory, createRouter } from 'vue-router'
import index from '../pages/index.vue'

const routes = [
    {
        name: 'index',
        path: '/',
        component: index,

    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
