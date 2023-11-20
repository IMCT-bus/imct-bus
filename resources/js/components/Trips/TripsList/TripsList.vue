<script setup lang="ts">
import StopsTimeline from '@/components/shared/StopsTimeline.vue';
import TripsListItem from './TripsListItem.vue';
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';
import SeatsBlock from '@/components/ui/SeatsBlock.vue';

type TripsListProps = {
  trips: Resources.TripResource[];
};

defineProps<TripsListProps>();

function onRegisterClick(uuid: string) {
  router.visit(route('trips.showRegister', uuid));
}
</script>

<template>
  <n-list class="trips-list">
    <TripsListItem v-for="trip in trips" :key="trip.uuid" :trip="trip" type="passenger">
      <n-collapse>
        <n-collapse-item title="Полный маршрут">
          <StopsTimeline :stops="trip.route.stops" />
        </n-collapse-item>
      </n-collapse>
      <template #desc>
        <SeatsBlock :allow-negative="false" :remaining-seats="trip.remaining_seats" :seats="trip.seats"/>
      </template>
      <template #actions>
        <n-button type="primary" @click="onRegisterClick(trip.uuid)" :disabled="trip.remaining_seats <= 0">Зарегистрироваться</n-button>
      </template>
    </TripsListItem>
  </n-list>
</template>

<style scoped lang="scss">
.trips-list {
  margin-bottom: 3rem;
}
</style>
