<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import { GlobalThemeOverrides, NConfigProvider, NThemeEditor, DropdownOption } from 'naive-ui';

import { BusSharp, MenuSharp } from '@vicons/ionicons5';
import { getLinkNode } from '@/utils/link-node';

defineProps(['title']);

const themeOverrides: GlobalThemeOverrides = {
  common: {
    primaryColor: '#F97B22',
    primaryColorHover: '#F97B22',
  },
  Card: {
    borderRadius: '10px',
    borderColor: '#D2D2D2FF',
  },
};

const links: DropdownOption[] = [
  {
    label: getLinkNode('admin.login.index', 'Вход'),
    key: 'login',
  },
  {
    label: getLinkNode('admin.login.index', 'Список рейсов'),
    key: 'trips',
  },
  {
    label: getLinkNode('admin.login.index', 'Отмена регистрации'),
    key: 'cancel',
  },
  {
    label: getLinkNode('admin.login.index', 'Список маршрутов'),
    key: 'routes',
  },
  { type: 'divider', key: 'd1' },
  {
    label: getLinkNode('admin.login.index', 'Выход'),
    key: 'routes',
  },
];
</script>

<template>
  <Head :title="title" />
  <NThemeEditor>
    <n-config-provider :theme-overrides="themeOverrides" inline-theme-disabled>
      <n-layout>
        <n-layout-content class="layout-container">
          <n-page-header :title="title">
            <template #avatar>
              <n-avatar :color="themeOverrides.common?.primaryColor">
                <n-icon :component="BusSharp" />
              </n-avatar>
            </template>
            <template #extra>
              <n-space align="center">
                <n-dropdown :options="links">
                  <n-button>
                    <n-icon :component="MenuSharp" size="32px" />
                  </n-button>
                </n-dropdown>
              </n-space>
            </template>
          </n-page-header>
          <slot></slot>
        </n-layout-content>
      </n-layout>
    </n-config-provider>
  </NThemeEditor>
</template>

<style scoped lang="scss">
.layout-container {
  border: 1px solid black;
  min-height: 100vh;
  max-width: 70rem;
  margin: auto;
  padding: 0.75rem;
}
</style>
