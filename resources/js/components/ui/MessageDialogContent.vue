<script setup lang="ts">
import { formatDateShort } from '@/utils/lib';

type MessageDialogContentProps = {
  trip: Resources.TripResource;
  stop: Resources.StopResource;
};

defineProps<MessageDialogContentProps>();
</script>

<template>
  <div class="container">
    <p>Вы успешно зарегистрировались на рейс</p>
    <div class="bold">
      <p>{{ formatDateShort(trip.date) }} ({{ trip.route.starts_at }})</p>
      <p>{{ trip.route.name }}</p>
    </div>
    <p>Ждем вас на остановке</p>
    <p class="bold">
      {{ stop.name }} <span v-if="stop.arrives_at && stop.arrives_at.length > 0">в {{ stop.arrives_at }}</span>
    </p>
  </div>
</template>

<style scoped lang="scss">
.container {
  @include stack;
  flex-direction: column;
  gap: 0.25rem;

  .bold {
    font-weight: 500;
  }
}
</style>
