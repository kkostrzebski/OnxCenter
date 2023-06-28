<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div>
    <h1>Strona domowa</h1>
    <div v-if="isLoggedIn">
      <p>Zalogowany jako: {{ userName }}</p>
      <button @click="logout">Wyloguj</button>
    </div>
    <div v-else>
      <form @submit.prevent="login">
        <label>
          Nazwa użytkownika:
          <input type="text" v-model="username" required />
        </label>
        <button type="submit">Zaloguj</button>
      </form>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../store/store';
import { ref, computed } from 'vue';

export default {
  setup() {
    const authStore = useAuthStore();
    const username = ref('');

    const login = () => {
      authStore.login(username.value);
      username.value = '';
    };

    const logout = () => {
      authStore.logout();
    };

    return {
      isLoggedIn: computed(() => authStore.isLoggedIn),
      userName: computed(() => authStore.userName),
      username,
      login,
      logout,
    };
  },
};
</script>