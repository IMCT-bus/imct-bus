<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import TripForm, { TripFormType } from '@/components/Trips/TripForm.vue';
import route from 'ziggy-js';

type CreateTripPageProps = {
  routes: Resources.RouteResource[];
};
defineProps<CreateTripPageProps>();

const form = useForm<TripFormType>({
  date: Date.now(),
  car_number: '',
  link: '',
  seats: 10,
  route_id: null,
  is_published: false,
});

const onSubmit = () => {
  // form.post(route('admin.trips.store'), { onSuccess: () => form.reset() });
};
</script>

<template>
  <AppLayout title="Добавление рейса">
    <TripForm :routes="routes" :form="form" :on-submit="onSubmit" />
  </AppLayout>
</template>

<style lang="scss"></style>
