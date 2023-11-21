import { MaskOptions } from 'maska';
import { FormItemRule } from 'naive-ui';
import { computed } from 'vue';

export const getErrorStatus = computed(() => {
  return (val?: string) => (val ? 'error' : undefined);
});

export const requiredRule: FormItemRule = {
  required: true,
  message: 'Поле обязательно для заполнения.',
  trigger: 'blur',
};

export const passMask: MaskOptions = {
  mask: '####',
};
