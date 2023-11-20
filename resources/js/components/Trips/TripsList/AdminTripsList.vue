<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

import TripsListItem from './TripsListItem.vue';
import { useDialog } from 'naive-ui';
import { formatDateShort } from '@/utils/lib';

type AdminTripsListProps = {
  trips: Resources.TripResource[];
};

defineProps<AdminTripsListProps>();

const dialog = useDialog();

function onEditClick(uuid: string) {
  router.visit(route('admin.trips.edit', uuid));
}

function onDeleteClick(trip: Resources.TripResource) {
  dialog.warning({
    title: 'Подтвердите удаление',
    content: `Удалить рейс ${formatDateShort(trip.date)} (${trip.route.starts_at}) ${trip.route.name} ?`,
    positiveText: 'Да',
    onPositiveClick: () => router.delete(route('admin.trips.destroy', trip.uuid)),
  });
}
</script>

<template>
  <n-list>
    <TripsListItem v-for="trip in trips" :key="trip.uuid" :trip="trip" type="admin">
      <template #actions>
        <n-button size="small" class="more-btn" @click="router.visit(route('admin.trips.show', trip.uuid))">
          {{ trip.registrations_count }} / {{ trip.seats }}
        </n-button>
        <n-button size="small" ghost type="info" @click="onEditClick(trip.uuid)">Редактировать</n-button>
        <n-button size="small" @click="onDeleteClick(trip)">Удалить</n-button>
      </template>
    </TripsListItem>
  </n-list>
</template>

<style scoped lang="scss">
.more-btn {
  width: 5.5rem;
}
</style>
