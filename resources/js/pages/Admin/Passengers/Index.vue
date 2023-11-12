<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import AppLayout from '@/layouts/AppLayout.vue';

import { Close } from '@vicons/ionicons5';
import { getErrorStatus } from '@/utils/validation';

type PassengersPageProps = {
  passengers: Models.Passenger[];
};

defineProps<PassengersPageProps>();

const form = useForm({
  full_name: '',
  pass: '',
});

function onSubmit() {
  form.post(route('admin.passengers.store'), {
    onSuccess: () => form.reset(),
  });
}

function onDeleteClick(id: number) {
  router.delete(route('admin.passengers.destroy', id))
}
</script>

<template>
  <AppLayout title="Управление пропусками">
    <n-form @submit.prevent="onSubmit">
      <div class="container">
        <n-form-item label="Номер пропуска" required :feedback="form.errors.pass" :validation-status="getErrorStatus(form.errors.pass)">
          <n-input v-model:value="form.pass" inputmode="numeric" placeholder="5432" />
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
          <n-button type="error" quaternary @click="onDeleteClick(passenger.id)">
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
  @include row;
  align-items: center;
  column-gap: 1rem;

  * {
    flex-grow: 1;
  }

  @include phone {
    align-items: stretch;
    flex-direction: column;
  }
}
</style>
