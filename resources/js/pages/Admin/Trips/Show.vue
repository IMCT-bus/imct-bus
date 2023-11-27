<script setup lang="ts">
import TripStatistics from '@/components/Trips/TripStatistics/TripStatistics.vue';
import TripsListItem from '@/components/Trips/TripsList/TripsListItem.vue';
import SeatsBlock from '@/components/ui/SeatsBlock.vue';
import AppLayout from '@/layouts/AppLayout.vue';

type TripsShowProps = {
  trip: Resources.TripResource;
};

const props = defineProps<TripsShowProps>();
</script>

<template>
  <AppLayout title="Список пассажиров">
    <n-list>
      <TripsListItem :trip="trip" type="admin">
        <template #desc>
          <SeatsBlock :registered="trip.registrations_count" :seats="trip.seats" />
        </template>
      </TripsListItem>
    </n-list>
    <TripStatistics :trip="trip" />
  </AppLayout>
</template>
