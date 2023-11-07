<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { GlobalThemeOverrides, NConfigProvider, NLayout, NLayoutContent, NThemeEditor } from 'naive-ui';

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
defineProps(['title']);
</script>

<template>
  <Head :title="title" />
  <NThemeEditor>
    <n-config-provider :theme-overrides="themeOverrides" inline-theme-disabled>
      <NLayout>
        <NLayoutContent class="layout-container">
          <slot></slot>
        </NLayoutContent>
      </NLayout>
    </n-config-provider>
  </NThemeEditor>
</template>

<style scoped lang="scss">
.layout-container {
  min-height: 100vh;
  max-width: 70rem;
  margin: auto;
  padding: 0.75rem;
}
</style>
