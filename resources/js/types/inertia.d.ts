import { Page, PageProps } from '@inertiajs/core';

declare module '@inertiajs/core' {
  export interface PageProps {
    errors: Record<string, string[]>;
    loggedIn: boolean;
  } 
}

declare module '@inertiajs/vue3' {
  export function usePage<T extends PageProps>(): Page<T>;
}
