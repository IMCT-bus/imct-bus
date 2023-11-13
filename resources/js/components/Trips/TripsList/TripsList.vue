<script setup lang="ts">
import StopsTimeline from '@/components/shared/StopsTimeline.vue';
import TripsListItem from './TripsListItem.vue';
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

type TripsListProps = {
  trips: Resources.TripResource[];
};

defineProps<TripsListProps>();

function onRegisterClick(uuid: string) {
  router.visit(route('trips.showRegister', uuid));
}
</script>

<template>
  <n-list>
    <TripsListItem v-for="trip in trips" :key="trip.uuid" :trip="trip" type="passenger">
      <template #desc>
        <n-statistic label="Свободных мест" class="seats">
          <template #prefix>
            <n-icon>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24">
                <path
                  d="M5.35 5.64c-.9-.64-1.12-1.88-.49-2.79c.63-.9 1.88-1.12 2.79-.49c.9.64 1.12 1.88.49 2.79c-.64.9-1.88 1.12-2.79.49zM16 19H8.93c-1.48 0-2.74-1.08-2.96-2.54L4 7H2l1.99 9.76A5.01 5.01 0 0 0 8.94 21H16v-2zm.23-4h-4.88l-1.03-4.1c1.58.89 3.28 1.54 5.15 1.22V9.99c-1.63.31-3.44-.27-4.69-1.25L9.14 7.47c-.23-.18-.49-.3-.76-.38a2.21 2.21 0 0 0-.99-.06h-.02a2.268 2.268 0 0 0-1.84 2.61l1.35 5.92A3.008 3.008 0 0 0 9.83 18h6.85l3.82 3l1.5-1.5l-5.77-4.5z"
                  fill="currentColor"
                ></path>
              </svg>
            </n-icon>
          </template>
          <span>{{ trip.remaining_seats }}</span>
          <template #suffix>
            <span>/ {{ trip.seats }}</span>
          </template>
        </n-statistic>
      </template>
      <n-collapse>
        <n-collapse-item title="Полный маршрут">
          <StopsTimeline :stops="trip.route.stops" />
        </n-collapse-item>
      </n-collapse>
      <template #actions>
        <n-button type="primary" @click="onRegisterClick(trip.uuid)" :disabled="trip.remaining_seats <= 0">Зарегистрироваться</n-button>
      </template>
    </TripsListItem>
  </n-list>
</template>

<style scoped lang="scss">
.seats {
  .n-icon {
    margin: 0;
    svg {
      margin: 0;
    }

    &:hover {
      animation: rot 1s infinite;
    }
  }
  span {
    font-size: 1.25rem;
  }
}

@keyframes rot {
  0% {
    transform: rotateY(0deg);
  }
  50% {
    transform: rotateY(180deg);
  }

  100% {
    transform: rotateY(360deg);
  }
}
</style>
