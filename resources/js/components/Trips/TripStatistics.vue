<script setup lang="ts">
import { ref, toRefs, onBeforeMount, h } from 'vue';
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

import { DataTableColumn, NButton, NIcon } from 'naive-ui';
import { CloseSharp } from '@vicons/ionicons5';
import { BaseTransitionPropsValidators } from 'vue';
import { usePage } from '@inertiajs/vue3';

type TripStatisticsProps = {
  trip: Resources.TripResource;
};

const props = defineProps<TripStatisticsProps>();
const { trip } = toRefs(props);

type TripStatistics = {
  no: number;
  key: number;
  full_name: string;
  pass: string;
  stop: string;
  stopPosition: number;
  telegram: string;
  registrationId: number;
};

function getColumns({ action }: { action: (id: number) => void }): DataTableColumn<TripStatistics>[] {
  return [
    { title: '№', key: 'no' },
    {
      title: 'ФИО',
      key: 'full_name',
      sorter: {
        compare: (a, b) => a.full_name.localeCompare(b.full_name),
        multiple: 2,
      },
    },
    { title: 'Пропуск', key: 'pass', sorter: 'default' },
    {
      title: 'Остановка',
      key: 'stop',
      sorter: {
        compare: (a, b) => a.stopPosition - b.stopPosition,
        multiple: 1,
      },
      filterOptions: trip.value.route.stops.map((v) => ({
        label: v.name,
        value: v.name,
      })),
      // @ts-ignore
      filter(value: string, row: TripStatistics) {
        return !!~row.stop.indexOf(value);
      },
    },
    {
      title: 'Telegram',
      key: 'telegram',
      render: (rowData) => h('a', { href: `https://web.telegram.org/k/#${rowData.telegram}` }, rowData.telegram),
    },
    {
      title: '',
      key: 'destroy',
      render: (rowData, rowIndex) =>
        h(
          NButton,
          {
            text: true,
            onClick: () => action(rowData.registrationId),
          },
          {default: () => h(NIcon, {color: 'red', size: '20px', component: CloseSharp})}
        ), 
    },
  ];
}

function getStop(id: number): { label: string; stop: Resources.StopResource | null } {
  const stop = trip.value.route.stops.find((v) => v.id === id);
  return { label: `${stop?.name} ${stop?.arrives_at}`, stop: stop ?? null };
}

const columns = getColumns({
  action: (id: number) => {
    router.delete(route('admin.trips.destroyRegistration', id), {
      preserveState: true,
    });
  },
});


const data = ref<TripStatistics[]>(trip.value.registrations.map((reg, idx) => {
    const stopData = getStop(reg.stop_id);
    return {
      no: idx + 1,
      key: reg.id,
      full_name: reg.passenger.full_name,
      pass: reg.passenger.pass,
      stop: stopData.label,
      stopPosition: stopData.stop?.position ?? 9999,
      telegram: `@${reg.telegram}`,
      registrationId: reg.id,
    };
  }));
</script>

<template>
  <n-data-table :columns="columns" :data="data"> </n-data-table>
</template>
