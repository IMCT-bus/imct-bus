<script setup lang="ts">
import TripsList from '@/components/Trips/TripsList/TripsList.vue';
import TelegramLink from '@/components/ui/TelegramLink.vue';
import AppLayout from '@/layouts/AppLayout.vue';

type TripsIndexProps = {
  trips: Resources.TripResource[];
};

defineProps<TripsIndexProps>();
</script>

<template>
  <AppLayout title="Список рейсов">
    <TripsList :trips="trips" />
    <TelegramLink class="link" />
  </AppLayout>
</template>

<style scoped lang="scss">
.link {
  position: absolute;
  bottom: 15px;
  left: 0;
  right: 0;
}
</style>
