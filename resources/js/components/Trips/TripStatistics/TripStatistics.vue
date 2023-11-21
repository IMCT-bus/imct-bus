<script setup lang="ts">
import { ref, toRefs, h } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import route from 'ziggy-js';

import { DataTableColumn, NButton, NIcon, useDialog } from 'naive-ui';
import { CloseSharp } from '@vicons/ionicons5';

import { formatDateShort } from '@/utils/lib';

type TripStatisticsProps = {
  trip: Resources.TripResource;
};

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

const props = defineProps<TripStatisticsProps>();
const { trip } = toRefs(props);

const dialog = useDialog();

function getColumns({ action }: { action: (data: TripStatistics) => void }): DataTableColumn<TripStatistics>[] {
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
      render: (rowData) =>
        h(
          NButton,
          {
            text: true,
            onClick: () => action(rowData),
          },
          { default: () => h(NIcon, { color: 'red', size: '20px', component: CloseSharp }) },
        ),
    },
  ];
}

function getStop(id: number): { label: string; stop: Resources.StopResource | null } {
  const stop = trip.value.route.stops.find((v) => v.id === id);
  return { label: `${stop?.name} ${stop?.arrives_at}`, stop: stop ?? null };
}

const columns = getColumns({
  action: (data: TripStatistics) => {
    dialog.warning({
      title: 'Подтвердите удаление',
      content: `Удалить ${data.full_name} с рейса ${formatDateShort(trip.value.date)} (${trip.value.route.starts_at}) ${trip.value.route.name}?`,
      positiveText: 'Да',
      style: {
        width: '640px',
      },
      onPositiveClick: () => {
        router.delete(route('admin.trips.destroyRegistration', data.registrationId), {
          onSuccess: () => router.visit(usePage().url),
        });
      },
    });
  },
});

const data = ref<TripStatistics[]>(
  trip.value.registrations.map((reg, idx) => {
    const stopData = getStop(reg.stop_id);
    return {
      no: idx + 1,
      key: reg.id,
      full_name: reg.passenger?.full_name ?? 'Ошибка',
      pass: reg.passenger?.pass ?? 'Ошибка',
      stop: stopData.label,
      stopPosition: stopData.stop?.position ?? 9999,
      telegram: reg.telegram.startsWith('@') ? reg.telegram : `@${reg.telegram}`,
      registrationId: reg.id,
    };
  }),
);
</script>

<template>
  <n-data-table :columns="columns" :data="data"> </n-data-table>
</template>
