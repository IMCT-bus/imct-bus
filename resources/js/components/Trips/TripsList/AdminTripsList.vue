<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

import TripsListItem from './TripsListItem.vue';

type AdminTripsListProps = {
  trips: Resources.TripResource[];
};

defineProps<AdminTripsListProps>();

function onEditClick(uuid: string) {
  router.visit(route('admin.trips.edit', uuid));
}

function onDeleteClick(uuid: string) {
  router.delete(route('admin.trips.destroy', uuid));
}
</script>

<template>
  <n-list>
    <TripsListItem v-for="trip in trips" :key="trip.uuid" :trip="trip" type="admin">
      <template #actions>
        <n-button size="small" class="more-btn" @click="router.visit(route('admin.trips.show', trip.uuid))"
          >{{ trip.remaining_seats }} / {{ trip.seats }}</n-button
        >
        <n-button size="small" ghost type="info" @click="onEditClick(trip.uuid)">Редактировать</n-button>
        <n-button size="small" @click="onDeleteClick(trip.uuid)">Удалить</n-button>
      </template>
    </TripsListItem>
  </n-list>
</template>

<style scoped lang="scss">
.more-btn {
  width: 5.5rem;
}
</style>
