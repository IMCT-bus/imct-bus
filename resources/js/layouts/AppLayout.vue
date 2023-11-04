<script setup lang="ts">
import { NConfigProvider, NLayout, NLayoutContent, darkTheme } from 'naive-ui';
</script>

<template>
  <n-config-provider :theme="darkTheme">
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
