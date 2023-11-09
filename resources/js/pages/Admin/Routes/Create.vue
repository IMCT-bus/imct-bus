<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import AppLayout from '@/layouts/AppLayout.vue';
import RouteForm from '@/components/Routes/RouteForm.vue';
import type { RouteFormType } from '@/components/Routes/RouteForm.vue';

import { EMPTY_STOP } from '@/utils/constants';

const form = useForm<RouteFormType>({
  name: '',
  stops: [EMPTY_STOP],
});

function onSubmit() {
  form
    .transform((form) => Object.assign(form, { starts_at: form.stops[0].arrives_at }))
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
