<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { NConfigProvider, NLayout, NLayoutContent, darkTheme } from 'naive-ui';

defineProps(['title']);
</script>

<template>
  <Head :title="title" />
  <n-config-provider>
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
