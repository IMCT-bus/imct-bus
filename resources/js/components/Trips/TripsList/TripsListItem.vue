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
        <span>{{ trip.route.name }} </span>
        <span class="date"> ({{ trip.route.starts_at }})</span>
      </template>
      <template #description>
        <template v-if="type === 'admin'">
          <n-space align="center" v-if="trip.is_published">
            <n-icon :component="CheckmarkCircleOutline" size="20px" color="green" />
            <span>Опубликован</span>
          </n-space>
          <n-space align="center" v-else>
            <n-icon :component="EyeOff" size="20px" />
            <span>Скрыт</span>
          </n-space>
        </template>
        <span class="date">{{ date }}</span>
        <CarNumber v-if="trip.car_number" :car-number="trip.car_number" />
        <p v-else>Гос. номер появится позже</p>
        <n-space v-if="trip.link" align="center">
          <n-icon :component="LinkOutline" size="20px" />
          <n-el tag="a" :href="trip.link" target="_blank" :style="{ color: 'var(--info-color)' }"> Локатор </n-el>
        </n-space>
        <p v-else>Ссылка на локатор появится позже</p>
        <n-statistic class="seats">
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

.actions {
  @include row;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 1rem;
}
</style>
