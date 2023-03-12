import '@/bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import piniaPluginPersistedState from 'pinia-plugin-persistedstate';
import router from '@/router';

import DefaultLayout from '@/layouts/default.vue';

const app = createApp(DefaultLayout);
app.use(router);

const pinia = createPinia();
pinia.use(piniaPluginPersistedState);
app.use(pinia);

// @ts-ignore
Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
  const name = path.split('/');
  name.shift();

  app.component(
    name.map((item: string) => item.charAt(0).toUpperCase() + item.slice(1)).join(''),
    // @ts-ignore
    definition.default,
  );
});

app.mount('#app');
