import '@/bootstrap';

import { createApp } from 'vue';
import router from '@/router';

import DefaultLayout from '@/layouts/default.vue';

const app = createApp(DefaultLayout);
app.use(router);

// @ts-ignore
Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

app.mount('#app');
