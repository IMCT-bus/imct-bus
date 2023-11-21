<script setup lang="ts">
import { InertiaForm } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';
import { SelectOption } from 'naive-ui';

import StopsTimeline from '@/components/shared/StopsTimeline.vue';
import FadeTransition from '@/components/shared/FadeTransition.vue';

import { getErrorStatus } from '@/utils/validation';
import { sub } from 'date-fns';
import { vMaska, MaskTokens, MaskOptions } from 'maska';

type TripFormProps = {
  routes: Resources.RouteResource[];
  form: InertiaForm<TripFormType>;
  onSubmit: (...args: any[]) => void;
};

export type TripFormType = Utility.Overwrite<
  Models.Trip,
  {
    date: number;
    uuid?: string;
    route_id: number | null;
  }
>;

const props = defineProps<TripFormProps>();

const selectRouteOptions: SelectOption[] = props.routes?.map((route) => ({
  label: `${route.name} (${route.starts_at})`,
  value: route.id,
}));

const carNumberMaskOptions: MaskOptions = reactive({
  mask: 'F ### FF',
  tokens: {
    F: {
      pattern: /[А-Яа-я]/,
      transform: (char: string) => char.toUpperCase(),
    },
  },
});

const stops = computed(() => {
  if (!props.form.route_id) return null;

  return props.routes?.find((v) => v.id === props.form.route_id)?.stops;
});

function disablePreviousDate(timestamp: number) {
  return timestamp < sub(Date.now(), { days: 1 }).getTime();
}
</script>

<template>
  <n-form @submit.prevent="onSubmit" :model="form">
    <div class="grid-container">
      <n-form-item label="Дата" required :feedback="form.errors.date" :validation-status="getErrorStatus(form.errors.date)">
        <n-date-picker v-model:value="form.date" format="PPP" :is-date-disabled="disablePreviousDate" type="date" clearable :actions="null" />
      </n-form-item>
      <n-form-item label="Гос. номер" :feedback="form.errors.car_number" :validation-status="getErrorStatus(form.errors.car_number)">
        <n-input v-model:value="form.car_number" v-maska:[carNumberMaskOptions] placeholder="В 232 ИН" />
      </n-form-item>
      <n-form-item label="Ссылка на локатор" :feedback="form.errors.link" :validation-status="getErrorStatus(form.errors.link)">
        <n-input v-model:value="form.link" placeholder="Ссылка" />
      </n-form-item>
      <n-form-item label="Количество мест" required path="seats" :feedback="form.errors.seats" :validation-status="getErrorStatus(form.errors.seats)">
        <n-input-number v-model:value="form.seats" clearable :default-value="10" min="2" max="100" />
      </n-form-item>
    </div>
    <n-form-item label="Маршрут" path="route_id" required :feedback="form.errors.route_id" :validation-status="getErrorStatus(form.errors.route_id)">
      <n-select v-model:value="form.route_id" :options="selectRouteOptions" />
    </n-form-item>
    <FadeTransition>
      <StopsTimeline v-if="stops" :stops="stops" />
    </FadeTransition>
    <n-space align="center" justify="end">
      <n-switch v-model:value="form.is_published" size="large" :round="false">
        <template #checked> Опубликован </template>
        <template #unchecked> Скрыт </template>
      </n-switch>
      <n-button type="primary" attr-type="submit">Сохранить</n-button>
    </n-space>
  </n-form>
</template>

<style scoped lang="scss">
.n-date-picker,
.n-input-number {
  flex-grow: 1;
}

.grid-container {
  display: grid;
  column-gap: 1rem;
  grid-template-columns: repeat(2, 1fr);

  @include phone {
    grid-template-columns: 1fr;
  }
}
</style>
