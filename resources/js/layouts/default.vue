<script setup lang="ts">
import { useUserStore } from '@/stores/user';
import { useRoute } from 'vue-router';
import { computed, ref } from 'vue';
import { RouteList } from '@/enums';

const userStore = useUserStore();
const route = useRoute();

const errorModel = ref<string>('');

const result = userStore.getUserInfo();
if (!result) {
  const error = userStore.getUserInfoErrorData!;
  errorModel.value = error.description;
}

const isLoginRoute = computed((): boolean => route.name === RouteList.AuthLogin);
</script>

<template>
  <div>
    <h2>{{ errorModel }}</h2>
    <header class="header">
      <div class="auth-data">
        <template
          v-if="userStore.isAuthorized"
        >
          <span>Здравствуйте, {{ userStore.getFullName }}</span>
          <button @click="userStore.logout()">
            Выйти
          </button>
        </template>
        <router-link
          v-else-if="!isLoginRoute"
          :to="{ name: RouteList.AuthLogin }"
        >
          Авторизация
        </router-link>
      </div>
    </header>
    <router-view />
  </div>
</template>

<style scoped lang="scss">
.header {
  position: absolute;

  height: 50px;
  width: 100%;
}

.auth-data {
  display: block;

  width: 100px;

  margin-left: auto;
}
</style>
