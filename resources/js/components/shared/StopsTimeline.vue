<script setup lang="ts">
import { LocationSharp } from '@vicons/ionicons5';

type StopsTimelineProps = {
  stops: Resources.StopResource[];
};

defineProps<StopsTimelineProps>();
</script>

<template>
  <n-timeline>
    <n-timeline-item v-for="stop in stops" :content="stop.arrives_at ?? ''" :key="stop.name">
      <template #header>
        <n-space align="start" class="stop-link-container">
          <n-icon :component="LocationSharp" color="#0168F9" size="16px" v-if="stop.link" />
          <a v-if="stop.link" :href="stop.link" target="_blank" class="stop-link">{{ stop.name }}</a>
          <span v-else class="stop-link">{{ stop.name }}</span>
        </n-space>
      </template>
    </n-timeline-item>
  </n-timeline>
</template>

<style scoped lang="scss">

.stop-link {
  font-weight: 400;
  font-size: 1rem;
  color: currentColor;
}
</style>
