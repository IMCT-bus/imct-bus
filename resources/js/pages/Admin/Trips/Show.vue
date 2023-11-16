<script setup lang="ts">
import TripStatistics from '@/components/Trips/TripStatistics.vue';
import TripsListItem from '@/components/Trips/TripsList/TripsListItem.vue';
import AppLayout from '@/layouts/AppLayout.vue';

type TripsShowProps = {
  trip: Resources.TripResource;
};

defineProps<TripsShowProps>();
</script>

<template>
  <AppLayout title="Список пассажиров">
    <n-list>
      <TripsListItem :trip="trip" type="admin" />
    </n-list>
    <TripStatistics :trip="trip"/>
  </AppLayout>
</template>
