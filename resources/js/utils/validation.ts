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

export const fullNameMask: MaskOptions = {
  mask: 'Nn N.N.',
  tokens: {
    N: {
      pattern: /[А-Яа-я]/,
      transform: (char: string) => char.toUpperCase(),
    },
    n: {
      pattern: /[а-я]/,
      multiple: true,
    },
  },
};

export const carNumberMask: MaskOptions = {
  mask: 'F ### FF',
  tokens: {
    F: {
      pattern: /[А-Яа-я]/,
      transform: (char: string) => char.toUpperCase(),
    },
  },
};
