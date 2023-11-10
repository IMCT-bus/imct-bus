<script setup lang="ts">
import TripsListItem from './TripsListItem.vue';

type TripsListProps = {
  trips: Resources.TripResource[];
};

defineProps<TripsListProps>();

function onEditClick() {
  console.log();
}

function onDeleteClick() {
  console.log();
}
</script>

<template>
  <n-list>
    <TripsListItem v-for="trip in trips" :key="trip.uuid" :trip="trip" :on-edit="onEditClick" :on-delete="onDeleteClick" />
  </n-list>
</template>

<style lang="scss"></style>
