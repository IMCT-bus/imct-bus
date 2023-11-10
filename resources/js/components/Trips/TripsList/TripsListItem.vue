<script setup lang="ts">
import { format } from 'date-fns';
import { ru } from 'date-fns/locale';

type TripsListItemProps = {
  trip: Resources.TripResource;
  onEdit: (...args: any[]) => void;
  onDelete: (...args: any[]) => void;
};

const props = defineProps<TripsListItemProps>();
const date = format(new Date(props.trip.date), 'EEEE, d MMMM', { locale: ru });
</script>

<template>
  <n-list-item>
    <n-thing>
      <template #header class="header">
        <span>{{ trip.route.name }} </span>
        <span class="date"> ({{ trip.route.starts_at }})</span>
      </template>
      <template #description>
        <span class="date">{{ date }}</span>
      </template>
      <template #action>
        <div class="actions">
          <n-button size="small" ghost type="info">Редактировать</n-button>
          <n-button size="small">Удалить</n-button>
        </div>
      </template>
    </n-thing>
  </n-list-item>
</template>

<style scoped lang="scss">
.actions {
  @include row;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 1rem;
}
.date {
  font-weight: 500;
  font-size: 1rem;
}
</style>
