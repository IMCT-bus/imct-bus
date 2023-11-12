<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import { GlobalThemeOverrides, NConfigProvider, DropdownOption, ruRU, dateRuRU } from 'naive-ui';

import { BusSharp, MenuSharp } from '@vicons/ionicons5';
import { getLinkNode } from '@/utils/link-node';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

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

const page = usePage();

const links: DropdownOption[] = [
  {
    label: getLinkNode('admin.trips.index', 'Список рейсов (Админ)'),
    key: 'trips',
    show: page.props.loggedIn,
  },
  {
    label: getLinkNode('admin.routes.index', 'Список маршрутов'),
    key: 'routes',
    show: page.props.loggedIn,
  },
  {
    label: getLinkNode('admin.passengers.index', 'Управление пропусками'),
    key: 'passengers',
    show: page.props.loggedIn
  },
  {
    label: 'Выход',
    props: {
      onClick: () => router.visit(route('admin.logout')),
      style: {
        color: 'red',
      },
    },
    show: page.props.loggedIn,
  },
];
</script>

<template>
  <Head :title="title" />
  <n-config-provider :theme-overrides="themeOverrides" inline-theme-disabled :locale="ruRU" :date-locale="dateRuRU">
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
              <n-dropdown :options="links" trigger="click">
                <n-button>
                  <n-icon :component="MenuSharp" size="32px" />
                </n-button>
              </n-dropdown>
            </n-space>
          </template>
        </n-page-header>
        <main class="main-content">
          <slot></slot>
        </main>
      </n-layout-content>
    </n-layout>
  </n-config-provider>
</template>

<style scoped lang="scss">
.layout-container {
  min-height: 100vh;
  max-width: 70rem;
  margin: auto;
  padding: 0.75rem;

  .main-content {
    margin-top: 2rem;
  }
}
</style>
