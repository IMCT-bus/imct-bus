<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';

type TripsShowProps = {
  trip: any
};

defineProps<TripsShowProps>();
</script>

<template>
  <AppLayout title="Список пассажиров">
    <pre>{{ trip }}</pre>
  </AppLayout>
</template>

