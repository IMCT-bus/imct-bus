import { router, usePage } from '@inertiajs/vue3';
import { App, computed } from 'vue';

export default {
  install(app: App) {
    app.component('RouterLink', {
      useLink(props: unknown) {
        const href = props.to;
        const currentUrl = computed(() => usePage().url);
        return {
          route: computed(() => ({ href })),
          isActive: computed(() => currentUrl.value.startsWith(href)),
          isExactActive: computed(() => href === currentUrl),
          navigate(e) {
            if (e.shiftKey || e.metaKey || e.ctrlKey) return;
            e.preventDefault();
            router.visit(href);
          },
        };
      },
    });
  },
};
