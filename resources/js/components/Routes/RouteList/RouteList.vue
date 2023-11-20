<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

import RouteListItem from './RouteListItem.vue';
import { useDialog } from 'naive-ui';
import { ro } from 'date-fns/locale';

type RouteListProps = {
  routes: Resources.RouteResource[];
};

defineProps<RouteListProps>();

const dialog = useDialog();

function onEditClick(id: number) {
  router.visit(route('admin.routes.edit', id));
}

function onDeleteClick(routeData: Resources.RouteResource) {
  dialog.warning({
    title: 'Подтвердите удаление',
    content: `Удалить маршрут ${routeData.name} (${routeData.starts_at})?`,
    positiveText: 'Да',
    onPositiveClick: () => router.delete(route('admin.routes.destroy', routeData.id)),
  });
}
</script>

<template>
  <n-list>
    <RouteListItem v-for="route in routes" :route-item="route" :on-edit="onEditClick" :on-delete="onDeleteClick" />
  </n-list>
</template>
