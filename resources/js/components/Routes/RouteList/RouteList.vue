<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

import RouteListItem from './RouteListItem.vue';

type RouteListProps = {
  routes: Resources.RouteResource[];
};

defineProps<RouteListProps>();

function onEditClick(id: number) {
  router.visit(route('admin.routes.edit', id));
}

function onDeleteClick(id: number) {
  router.delete(route('admin.routes.destroy', id));
}
</script>

<template>
  <n-list>
    <RouteListItem v-for="route in routes" :route-item="route" :on-edit="onEditClick" :on-delete="onDeleteClick"/>
  </n-list>
</template>
