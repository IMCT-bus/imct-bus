<script setup lang="ts">
import { AtSharp } from '@vicons/ionicons5';
import AppLayout from '@/layouts/AppLayout.vue';
import { SelectOption } from 'naive-ui';
import { format } from 'date-fns';
import { ru } from 'date-fns/locale';
import StopsTimeline from '@/components/shared/StopsTimeline.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { getErrorStatus } from '@/utils/validation';
import route from 'ziggy-js';

type TripRegisterProps = {
  trip: Resources.TripResource;
};

type TripRegisterForm = {
  full_name: string;
  pass: string;
  telegram: string;
  stop_id: number | null;
  over_18: boolean;
};

const props = defineProps<TripRegisterProps>();

const form = useForm<TripRegisterForm>({
  full_name: '',
  pass: '',
  telegram: '',
  stop_id: null,
  over_18: false,
});

function onSubmit() {
  // form.post(route('trips.register'));
}

const formIsValid = computed(() => {
  return form.full_name.length > 6 && form.pass.length === 4 && form.telegram.length > 4 && form.stop_id !== null && form.over_18;
});

const selectStopOptions: SelectOption[] = props.trip.route.stops
  .filter((stop) => stop.arrives_at != '')
  .map((stop) => ({
    label: `${stop.name} ${stop.arrives_at ? `(${stop.arrives_at})` : ''}`,
    value: stop.id,
  }));

const date = format(new Date(props.trip.date), 'EEEE, d MMMM', { locale: ru });
</script>

<template>
  <AppLayout title="Регистрация на рейс">
    <n-thing :title="trip.route.name" class="trip-data">
      <template #header>
        <span>{{ trip.route.name }} </span>
        <span class="date"> ({{ trip.route.starts_at }})</span>
      </template>
      <template #description>
        <span class="date">{{ date }}</span>
      </template>
      <StopsTimeline :stops="trip.route.stops" />
      <n-divider />
    </n-thing>
    <n-form>
      <div class="container">
        <n-form-item label="ФИО" :feedback="form.errors.full_name" :validation-status="getErrorStatus(form.errors.full_name)">
          <n-input v-model:value="form.full_name" placeholder="Иванов И.И." autofocus />
        </n-form-item>
        <n-form-item label="Номер пропуска" :feedback="form.errors.pass" :validation-status="getErrorStatus(form.errors.pass)">
          <n-input v-model:value="form.pass" inputmode="numeric" maxlength="4" placeholder="3006" />
        </n-form-item>
        <n-form-item label="Telegram для связи" :feedback="form.errors.telegram" :validation-status="getErrorStatus(form.errors.telegram)">
          <n-input v-model:value="form.telegram" placeholder="imctbus">
            <template #prefix>
              <n-icon :component="AtSharp" />
            </template>
          </n-input>
        </n-form-item>
        <n-form-item label="Остановка" :feedback="form.errors.stop_id" :validation-status="getErrorStatus(form.errors.stop_id)">
          <n-select v-model:value="form.stop_id" :options="selectStopOptions" />
        </n-form-item>
      </div>

      <div class="actions">
        <n-form-item :show-label="false" :feedback="form.errors.over_18" :validation-status="getErrorStatus(form.errors.over_18)">
          <n-checkbox v-model:checked="form.over_18"> Подтверждаю, что мне есть 18 лет</n-checkbox>
        </n-form-item>
        <n-button :disabled="!formIsValid" type="primary">Зарегистрироваться</n-button>
      </div>
    </n-form>
  </AppLayout>
</template>

<style scoped lang="scss">
.trip-data {
  margin-bottom: 1rem;
  @include phone {
    margin-bottom: 0.5rem;
  }
}

.container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  column-gap: 1rem;
  @include phone {
    grid-template-columns: 1fr;
  }
}

.actions {
  @include row;
  justify-content: space-between;
  margin-bottom: 4rem;
}
</style>
