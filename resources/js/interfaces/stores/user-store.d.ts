import type { ApiError } from '@/interfaces/ApiError';

export interface UserStore {
  authorized: boolean,
  login: string,
  email: string,
  firstname: string,
  surname: string,
  patronymic?: string,

  errors: {
    auth: ?ApiError,
    getInfo: ?ApiError,
  },
}
