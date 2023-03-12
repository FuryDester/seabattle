<script setup lang="ts">
import { useUserStore } from '@/stores/user';
import { useRouter } from 'vue-router';
import type { Ref } from 'vue';
import { ref } from 'vue';
import { RouteList } from '@/enums';

const userStore = useUserStore();
const router = useRouter();

if (userStore.isAuthorized) {
  router.push({ name: RouteList.Index });
}

const errorString: Ref<HTMLElement | null> = ref(null);

const emailModel = ref<string>(userStore.getEmail);
const passwordModel = ref<string>('');
const rememberModel = ref(false);

const onLoginSubmit = async () => {
  userStore.authorize(emailModel.value, passwordModel.value, rememberModel.value).then((result) => {
    if (!result) {
      const error = userStore.getAuthErrorData;
      (errorString.value as HTMLElement).innerText = error?.description || '';

      return;
    }

    router.push({ name: RouteList.Index });
  });
};

const trySaveEmail = () => {
  userStore.setEmail(emailModel.value);
};
</script>

<template>
  <div>
    <h1>Login page</h1>
    <form
      class="form"
      @submit.prevent="onLoginSubmit"
    >
      <label for="email">Email: </label>
      <input
        id="email"
        v-model="emailModel"
        class="input"
        type="text"
        name="email"
        @input="trySaveEmail"
      >

      <label for="password">Password: </label>
      <input
        id="password"
        v-model="passwordModel"
        class="input"
        type="password"
        name="password"
      >

      <label for="remember">Remember me: </label>
      <input
        id="remember"
        v-model="rememberModel"
        type="checkbox"
        name="remember"
      >

      <button
        class="submit-button"
        type="submit"
      >
        Try login
      </button>
    </form>
    <h2 ref="errorString" />
  </div>
</template>

<style scoped lang="scss">
.input {
  display: block;
  margin-bottom: 10px;
}

.submit-button {
  display: block;
}

.error {
  color: orangered;
}
</style>
