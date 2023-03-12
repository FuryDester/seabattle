import type { InternalAxiosRequestConfig } from 'axios';
import axios from 'axios';
import { getCookie } from 'typescript-cookie';

export const axiosInstance = axios.create({
  withCredentials: true,
  baseURL: '/api',
});
axiosInstance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const setCSRFToken = () => {
  return axiosInstance.get('/csrf-cookie');
};

const token: HTMLMetaElement | null = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  axiosInstance.defaults.headers.common[axiosInstance.defaults.xsrfHeaderName!] = token.content;
} else {
  await setCSRFToken();
}

const onRequest = (config: InternalAxiosRequestConfig): InternalAxiosRequestConfig<any> | Promise<InternalAxiosRequestConfig<any>> => {
  if (!config) {
    return config;
  }

  const { method } = config;
  if (
    ['post', 'update', 'put', 'delete', 'get'].includes(method!.toLowerCase())
    && !axiosInstance.defaults.headers.common[axiosInstance.defaults.xsrfHeaderName!]
    && !getCookie(axiosInstance.defaults.xsrfCookieName!)
  ) {
    return setCSRFToken().then(() => config);
  }

  return config;
};

axiosInstance.interceptors.request.use(onRequest, (error) => console.log(error));
