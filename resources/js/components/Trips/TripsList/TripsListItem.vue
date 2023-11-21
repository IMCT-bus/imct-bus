<script setup lang="ts">
import { CheckmarkCircleOutline, EyeOff, LinkOutline } from '@vicons/ionicons5';

import CarNumber from '@/components/ui/CarNumber.vue';

import { formatDateLong } from '@/utils/lib';

type TripsListItemProps = {
  trip: Resources.TripResource;
  type: 'passenger' | 'admin';
};

const props = defineProps<TripsListItemProps>();
const date = formatDateLong(props.trip.date);

</script>

<template>
  <n-list-item>
    <n-thing class="trip-item">
      <template #header class="header">
        <span class="date">({{ trip.route.starts_at }}) </span>
        <span>{{ trip.route.name }} </span>
      </template>
      <template #description>
        <template v-if="type === 'admin'">
          <div v-if="trip.is_published" class="status">
            <n-icon :component="CheckmarkCircleOutline" size="20px" color="green" />
            <span>Опубликован</span>
          </div>
          <div class="status" v-else>
            <n-icon :component="EyeOff" size="20px" />
            <span>Скрыт</span>
          </div>
        </template>
        <span class="date">{{ date }}</span>
        <CarNumber v-if="trip.car_number" :car-number="trip.car_number" />
        <p v-else>Гос. номер появится позже</p>
        <n-space v-if="trip.link" align="center">
          <n-icon :component="LinkOutline" size="20px" />
          <n-el tag="a" :href="trip.link" target="_blank" :style="{ color: 'var(--info-color)' }"> Локатор </n-el>
        </n-space>
        <p v-else>Ссылка на локатор появится позже</p>
        <slot name="desc"></slot>
      </template>
      <slot name="default"></slot>
      <template #action>
        <div class="actions">
          <slot name="actions"></slot>
        </div>
      </template>
    </n-thing>
  </n-list-item>
</template>

<style scoped lang="scss">
.trip-item {
  * {
    margin-block: 0.5rem;
  }
}

.status {
  @include row;
  align-items: center;
}

.actions {
  @include row;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 1rem;

  @include phone {
    @include stack;
  }
}
</style>
