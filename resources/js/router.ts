import type { RouteRecordRaw } from 'vue-router';
import { createRouter, createWebHistory } from 'vue-router';

import IndexPage from '@/pages/index.vue';
import NotFoundPage from '@/pages/404.vue';
import AuthLoginPage from '@/pages/auth/index.vue';
import { RouteList } from '@/enums';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    name: RouteList.Index,
    component: IndexPage,
  },
  {
    path: '/auth',
    children: [
      {
        path: '',
        name: RouteList.AuthLogin,
        component: AuthLoginPage,
      },
    ],
  },
  {
    path: '/:pathMatch(.*)*',
    name: RouteList.NotFound,
    component: NotFoundPage,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
