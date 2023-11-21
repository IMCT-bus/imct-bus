<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import AppLayout from '@/layouts/AppLayout.vue';

import { Close } from '@vicons/ionicons5';
import { getErrorStatus } from '@/utils/validation';
import { useDialog } from 'naive-ui';

type PassengersPageProps = {
  passengers: Models.Passenger[];
};

defineProps<PassengersPageProps>();

const form = useForm({
  full_name: '',
  pass: '',
});

const dialog = useDialog();

function onSubmit() {
  form.post(route('admin.passengers.store'), {
    onSuccess: () => form.reset(),
  });
}

function onDeleteClick(passenger: Models.Passenger) {
  dialog.warning({
    title: 'Подтвердите удаление',
    content: `Удалить пропуск №${passenger.pass} — ${passenger.full_name}?`,
    positiveText: 'Дa',
    onPositiveClick: () => router.delete(route('admin.passengers.destroy', passenger.id)),
  });
}
</script>

<template>
  <AppLayout title="Управление пропусками">
    <n-form @submit.prevent="onSubmit">
      <div class="container">
        <n-form-item label="Номер пропуска" required :feedback="form.errors.pass" :validation-status="getErrorStatus(form.errors.pass)">
          <n-input v-model:value="form.pass" inputmode="numeric" maxlength="4" placeholder="5432" />
        </n-form-item>
        <n-form-item label="ФИО" required :feedback="form.errors.full_name" :validation-status="getErrorStatus(form.errors.full_name)">
          <n-input v-model:value="form.full_name" placeholder="Иванов И.И." />
        </n-form-item>
        <div>
          <n-button type="primary" attr-type="submit" class="add-button" :disabled="form.processing">Добавить</n-button>
        </div>
      </div>
    </n-form>
    <n-list hoverable>
      <n-list-item v-for="passenger in passengers" class="passenger-data">
        <n-space justify="space-between" align="center">
          <p>{{ passenger.pass }}</p>
          <p class="name">{{ passenger.full_name }}</p>
          <n-button type="error" quaternary @click="onDeleteClick(passenger)">
            <template #icon>
              <n-icon :component="Close" size="20px" />
            </template>
          </n-button>
        </n-space>
      </n-list-item>
    </n-list>
  </AppLayout>
</template>

<style scoped lang="scss">
.add-button {
  width: 100%;
}

.passenger-data {
  font-size: 0.9rem;
  padding: 12px 12px !important;
}
.container {
  display: grid;
  grid-template-columns: repeat(2, 1fr) 250px;
  align-items: center;
  column-gap: 1rem;

  @include phone {
    grid-template-columns: 1fr;
  }
}
</style>
