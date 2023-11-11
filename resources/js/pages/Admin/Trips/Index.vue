<script setup lang="ts">
import {router} from '@inertiajs/vue3';
import route from 'ziggy-js';
import { CreateOutline } from '@vicons/ionicons5';

import AppLayout from '@/layouts/AppLayout.vue';
import TripsList from '@/components/Trips/TripsList/TripsList.vue';

type IndexProps = {
  trips: Resources.TripResource[];
};
defineProps<IndexProps>();
</script>

<template>
  <AppLayout title="Список рейсов">
    <div class="actions">
      <n-button type="primary" @click="router.visit(route('admin.trips.create'))">
        <template #icon>
          <n-icon :component="CreateOutline" size="20px" />
        </template>
        Добавить рейс
      </n-button>
    </div>
    <TripsList :trips="trips" />
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
