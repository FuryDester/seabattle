import { createRouter, createWebHistory } from 'vue-router';

import IndexPage from '@/pages/index.vue';
import NotFoundPage from '@/pages/404.vue';

const routes = [
    {
        path: '/',
        name: 'index',
        component: IndexPage,
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: NotFoundPage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
