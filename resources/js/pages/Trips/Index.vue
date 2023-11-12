<script setup lang="ts">
import TripsList from '@/components/Trips/TripsList/TripsList.vue';
import AppLayout from '@/layouts/AppLayout.vue';

type TripsIndexProps = {
  trips: Resources.TripResource[];
};

defineProps<TripsIndexProps>();
</script>

<template>
  <AppLayout title="Список рейсов">
    <TripsList :trips="trips"/>
  </AppLayout>
</template>

<style scoped lang="scss">
</style>