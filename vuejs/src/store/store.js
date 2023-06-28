import { createPinia } from 'pinia';

export const pinia = createPinia();

export const useAuthStore = pinia.store(({ state }) => {
  const user = state({ isLoggedIn: false, name: '' });

  return {
    get isLoggedIn() {
      return user.isLoggedIn;
    },
    get userName() {
      return user.name;
    },
    login(name) {
      user.isLoggedIn = true;
      user.name = name;
    },
    logout() {
      user.isLoggedIn = false;
      user.name = '';
    },
  };
});