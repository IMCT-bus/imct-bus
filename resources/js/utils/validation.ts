import { computed } from 'vue';

export const getErrorStatus = computed(() => {
  return (val?: string) => (val ? 'error' : undefined);
});
