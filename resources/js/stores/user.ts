import { defineStore } from 'pinia';
import type { UserStore } from '@/interfaces/stores/user-store';
import { axiosInstance } from '@/bootstrap';
import type { ApiError } from '@/interfaces/ApiError';
import type { AxiosError } from 'axios';

const defaultState: UserStore = {
  authorized: false,
  login: '',
  email: '',
  firstname: '',
  surname: '',
  patronymic: '',

  errors: {
    auth: null,
    getInfo: null,
  },
};

export const useUserStore = defineStore('user', {
  state: () => ({ ...defaultState } as UserStore),
  getters: {
    isAuthorized(state): boolean {
      return state.authorized;
    },

    getLogin(state): string {
      return state.login;
    },

    getEmail(state): string {
      return state.email;
    },

    getFirstname(state): string {
      return state.firstname;
    },

    getSurname(state): string {
      return state.surname;
    },

    getPatronymic(state): string | undefined {
      return state.patronymic;
    },

    getFullName(state): string {
      return `${state.surname} ${state.firstname || ''}${state.firstname ? '.' : ''} ${state.patronymic || ''}${state.patronymic ? '.' : ''}`;
    },

    getAuthErrorData(state): ApiError | null {
      return state.errors.auth;
    },

    getUserInfoErrorData(state): ApiError | null {
      return state.errors.getInfo;
    },
  },
  actions: {
    reset() {
      Object.assign(this, defaultState);
    },

    setEmail(email: string = ''): boolean {
      if (!email) {
        this.email = '';

        return true;
      }

      if (email.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
        this.email = email;

        return true;
      }

      return false;
    },

    async authorize(email: string, password: string, remember: boolean = false): Promise<boolean> {
      try {
        const result = await axiosInstance.post('/auth', {
          email,
          password,
          remember,
        });

        Object.assign(this, result.data.data);
        this.errors.auth = null;
        this.authorized = true;

        return true;
      } catch (e) {
        const data = (e as AxiosError).response?.data as Record<string, unknown>;
        if (data?.success === false) {
          this.errors.auth = data.error as ApiError;
        }

        return false;
      }
    },

    async getUserInfo(): Promise<boolean> {
      const result = await axiosInstance.get('/auth/get-user-info');

      if (!result.data.success) {
        this.errors.getInfo = result.data.error;
        this.authorized = false;

        return false;
      }

      Object.assign(this, result.data.data);
      this.errors.getInfo = null;
      this.authorized = Boolean(this.login);

      return true;
    },

    async logout(): Promise<void> {
      await axiosInstance.post('/auth/logout');

      this.authorized = false;
    },
  },
  persist: {
    paths: ['email'],
  },
});
