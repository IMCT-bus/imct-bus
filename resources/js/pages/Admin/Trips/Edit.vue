<script setup lang="ts">
import TripForm, { TripFormType } from '@/components/Trips/TripForm.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

type EditTripPageProps = {
  trip: Resources.TripResource;
  routes: Resources.RouteResource[];
};

const props = defineProps<EditTripPageProps>();

const form = useForm<TripFormType>({
  ...props.trip,
  date: (new Date(props.trip.date)).getTime(),
  route_id: props.trip.route.id
});

function onSubmit() {
  form.put(route('admin.trips.update', props.trip.uuid), {
    onSuccess: () => form.reset(),
  });
}
</script>

<template>
  <AppLayout title="Редактирование рейса">
    <TripForm :form="form" :on-submit="onSubmit" :routes="routes"/>
  </AppLayout>
</template>

<style lang="scss"></style>
