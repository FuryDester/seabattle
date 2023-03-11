import '@/bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from '@/router';

import DefaultLayout from '@/layouts/default.vue';

const app = createApp(DefaultLayout);
app.use(router);
app.use(createPinia());

// @ts-ignore
Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
    // @ts-ignore
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

app.mount('#app');
