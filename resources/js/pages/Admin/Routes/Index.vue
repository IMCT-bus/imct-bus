<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import RouteList from '@/components/Routes/RouteList/RouteList.vue';

import { CreateOutline } from '@vicons/ionicons5';
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

type RoutesIndexProps = {
  routes: Resources.RouteResource[];
};

defineProps<RoutesIndexProps>();
</script>

<template>
  <AppLayout title="Список маршрутов">
    <div class="actions">
      <n-button type="primary" @click="router.visit(route('admin.routes.create'))">
        <template #icon>
          <n-icon :component="CreateOutline" size="20px"/>
        </template>
        Добавить маршрут
      </n-button>
    </div>
    <RouteList :routes="routes" />
  </AppLayout>
</template>

<style scoped lang="scss">
.actions {
  @include row;
  justify-content: flex-end;

  margin-bottom: 1rem;

  @include phone {
    * {
      flex-grow: 1;
    }
  }
}
</style>
