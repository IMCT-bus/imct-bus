<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

import TripsListItem from './TripsListItem.vue';

type TripsListProps = {
  trips: Resources.TripResource[];
};

defineProps<TripsListProps>();

function onEditClick(uuid: string) {
  router.visit(route('admin.trips.edit', uuid));
}

function onDeleteClick(uuid: string) {
  router.delete(route('admin.trips.destroy', uuid));
}
</script>

<template>
  <n-list>
    <TripsListItem v-for="trip in trips" :key="trip.uuid" :trip="trip" :on-edit="onEditClick" :on-delete="onDeleteClick" />
  </n-list>
</template>

<style lang="scss"></style>
