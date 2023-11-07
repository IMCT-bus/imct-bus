<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { NConfigProvider, NLayout, NLayoutContent, NThemeEditor, darkTheme } from 'naive-ui';

const themeOverrides = {
  common: {
    primaryColor: '#F97B22',
    primaryColorHover: '#F97B22',
  },
};
defineProps(['title']);

console.log(usePage())
</script>

<template>
  <Head :title="title" />
  <n-config-provider :theme-overrides="themeOverrides" inline-theme-disabled>
    <NLayout>
      <NLayoutContent class="layout-container">
        <slot></slot>
      </NLayoutContent>
    </NLayout>
  </n-config-provider>
</template>

<style scoped lang="scss">
.layout-container {
  min-height: 100vh;
  max-width: 70rem;
  margin: auto;
  padding: 0.25rem;
}
</style>
