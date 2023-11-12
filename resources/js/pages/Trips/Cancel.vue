<script setup lang="ts">
import { computed } from 'vue';

import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import { SelectOption } from 'naive-ui';

import AppLayout from '@/layouts/AppLayout.vue';

import { formatDateShort } from '@/utils/lib';
import { getErrorStatus } from '@/utils/validation';

type CancelRegisterPageProps = {
  trips: Resources.TripResource[];
};

type CancelFormType = {
  full_name: string;
  pass: string;
  trip_uuid: string | null;
};

const props = defineProps<CancelRegisterPageProps>();

const form = useForm<CancelFormType>({
  full_name: '',
  pass: '',
  trip_uuid: null,
});

function onSubmit() {
  form.post(route('trips.cancel'));
}

const formIsValid = computed(() => {
  return form.full_name.length > 5 && form.pass.length === 4 && form.trip_uuid;
});

const tripSelectOptions: SelectOption[] = props.trips.map((trip) => ({
  label: `${formatDateShort(trip.date)} — ${trip.route.name} — ${trip.route.starts_at}`,
  value: trip.uuid,
}));
</script>

<template>
  <AppLayout title="Отмена регистрации">
    <n-form @submit.prevent="onSubmit">
      <div class="container">
        <n-form-item label="ФИО" :feedback="form.errors.full_name" :validation-status="getErrorStatus(form.errors.full_name)" required>
          <n-input v-model:value="form.full_name" placeholder="Иванов И.И." />
        </n-form-item>
        <n-form-item label="Номер пропуска" :feedback="form.errors.pass" :validation-status="getErrorStatus(form.errors.pass)" required>
          <n-input v-model:value="form.pass" placeholder="5173" maxlength="4" inputmode="numeric" />
        </n-form-item>
        <n-form-item label="Рейс" :feedback="form.errors.trip_uuid" :validation-status="getErrorStatus(form.errors.trip_uuid)" required>
          <n-select v-model:value="form.trip_uuid" :options="tripSelectOptions" />
        </n-form-item>
      </div>
      <div class="actions">
        <n-button type="primary" attr-type="submit" :disabled="!formIsValid">Отменить</n-button>
      </div>
    </n-form>
  </AppLayout>
</template>

<style scoped lang="scss">
.container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  column-gap: 1rem;

  & *:last-child {
    grid-column: 1 / 3;
  }

  @include phone {
    grid-template-columns: 1fr;

    & *:last-child {
      grid-column: 1 / 2;
    }
  }
}
.actions {
  @include row;
  justify-content: flex-end;
}
</style>
