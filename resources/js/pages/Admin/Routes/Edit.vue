<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

type EditPageProps = {
  route: Resources.RouteResource;
};

const props = defineProps<EditPageProps>();

const form = useForm<Resources.RouteResource>({ ...props.route });

function onSubmit() {
  form
    .transform((form) => Object.assign(form, { starts_at: form.stops[0].arrives_at }))
    .put(route('admin.routes.update', props.route.id), {
      onSuccess: () => {
        form.reset();
      },
    });
}
</script>

<template>
  <AppLayout title="Редактирование маршрута">
    <RouteForm :form="form" :on-submit="onSubmit"/>
  </AppLayout>
</template>

<style lang="scss"></style>
