import { SelectRenderLabel } from 'naive-ui';
import { h } from 'vue';

export const renderLabel = (option: { date: string; details: string }) => {
  return h('div', [h('p', option.date), h('p', option.details)]);
};
