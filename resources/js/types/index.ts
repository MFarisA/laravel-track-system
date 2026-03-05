export * from './auth';

import type { Auth } from './auth';

export type Flash = {
    success?: string;
    error?: string;
    warning?: string;
    info?: string;
};

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    auth: Auth;
    flash: Flash;
    [key: string]: unknown;
};
