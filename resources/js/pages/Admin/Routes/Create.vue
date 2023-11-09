<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import AppLayout from '@/layouts/AppLayout.vue';
import RouteForm from '@/components/Routes/RouteForm.vue';

import { EMPTY_STOP } from '@/utils/constants';

const form = useForm<Resources.RouteResource>({
  id: Number.MAX_SAFE_INTEGER,
  name: '',
  starts_at: '',
  stops: [EMPTY_STOP],
});

function onSubmit() {
  form
    .transform((form) => Object.assign(form, {
      starts_at: form.stops[0].arrives_at,
      stops: form.stops.map((stop, idx) => ({
        ...stop,
        position: idx + 1
      }))
    }))
    .post(route('admin.routes.store'), {
      onSuccess: () => {
        form.reset();
      },
    });
}
</script>

<template>
  <AppLayout title="Добавление маршрута">
    <RouteForm :form="form" :on-submit="onSubmit" />
  </AppLayout>
</template>

<style scoped lang="scss"></style>
