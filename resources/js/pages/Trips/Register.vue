<script setup lang="ts">
import { computed, h } from 'vue';
import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import { AtSharp } from '@vicons/ionicons5';
import { vMaska } from 'maska';
import { useDialog } from 'naive-ui';

import AppLayout from '@/layouts/AppLayout.vue';
import StopsTimeline from '@/components/shared/StopsTimeline.vue';
import MessageDialogContent from '@/components/ui/MessageDialogContent.vue';

import { fullNameMask, getErrorStatus, passMask } from '@/utils/validation';
import { formatDateLong } from '@/utils/lib';
import { usePage } from '@inertiajs/vue3';

type TripRegisterProps = {
  trip: Resources.TripResource;
};

type TripRegisterForm = {
  full_name: string;
  pass: string;
  telegram: string;
  stop_id: number | null;
  over_18: boolean;
};

const props = defineProps<TripRegisterProps>();

const form = useForm<TripRegisterForm>({
  full_name: '',
  pass: '',
  telegram: '',
  stop_id: null,
  over_18: false,
});

const page = usePage();
const dialog = useDialog();

function onSubmit() {
  form.post(route('trips.register', props.trip.uuid), {
    preserveScroll: true,
    onSuccess: () =>
      dialog.success({
        title: 'Успешно',
        content: () =>
          h(MessageDialogContent, {
            trip: props.trip,
            stop: props.trip.route.stops.find((v) => v.id === form.stop_id)!,
          }),
        style: {
          paddingInline: '.5rem',
        },
      }),
  });
}

function getStopOptions() {
  let stops = props.trip.route.stops;

  if (stops.slice(1).every((stop) => stop.arrives_at === '')) {
    stops = stops.filter((stop) => stop.arrives_at !== '');
  }

  return stops.map((stop) => ({
    label: `${stop.name} ${stop.arrives_at ? `(${stop.arrives_at})` : ''}`,
    value: stop.id,
  }));
}

const formIsValid = computed(() => {
  return form.full_name.length > 4 && form.pass.length === 4 && form.telegram.length > 4 && form.stop_id !== null && form.over_18;
});

const isRegistrationClosed = computed(() => {
  return page.props.errors.registrationClosedError || page.props.errors.transactionError;
});

const date = formatDateLong(props.trip.date);
</script>

<template>
  <AppLayout title="Регистрация на рейс">
    <n-thing :title="trip.route.name" class="trip-data">
      <template #header>
        <span>{{ trip.route.name }} </span>
        <span class="date"> ({{ trip.route.starts_at }})</span>
      </template>
      <template #description>
        <span class="date">{{ date }}</span>
      </template>
      <StopsTimeline :stops="trip.route.stops" />
      <n-divider />
    </n-thing>
    <n-form @submit.prevent="onSubmit">
      <div class="container">
        <n-form-item label="ФИО" :feedback="form.errors.full_name" :validation-status="getErrorStatus(form.errors.full_name)" required>
          <n-input
            v-model:value="form.full_name"
            v-maska:[fullNameMask]
            :input-props="{
              autocomplete: 'name',
            }"
            placeholder="Иванов И.И."
            autofocus
          />
        </n-form-item>
        <n-form-item
          label="Номер пропуска"
          :feedback="form.errors.pass || $page.props.errors.wrongPassengerDataError || $page.props.errors.alreadyRegisteredError"
          :validation-status="
            getErrorStatus(form.errors.pass || $page.props.errors.wrongPassengerDataError || $page.props.errors.alreadyRegisteredError)
          "
          required
        >
          <n-input
            v-model:value="form.pass"
            v-maska:[passMask]
            :input-props="{
              inputmode: 'numeric',
            }"
            maxlength="4"
            placeholder="3006"
          />
        </n-form-item>
        <n-form-item label="Telegram для связи" :feedback="form.errors.telegram" :validation-status="getErrorStatus(form.errors.telegram)">
          <n-input
            v-model:value="form.telegram"
            required
            placeholder="username"
            :input-props="{
              autocomplete: 'username',
            }"
          >
            <template #prefix>
              <n-icon :component="AtSharp" />
            </template>
          </n-input>
        </n-form-item>
        <n-form-item label="Остановка" :feedback="form.errors.stop_id" :validation-status="getErrorStatus(form.errors.stop_id)" required>
          <n-select v-model:value="form.stop_id" :options="getStopOptions()" />
        </n-form-item>
      </div>

      <div class="actions">
        <n-form-item :show-label="false" :feedback="form.errors.over_18" :validation-status="getErrorStatus(form.errors.over_18)">
          <n-checkbox v-model:checked="form.over_18"> Подтверждаю, что мне есть 18 лет</n-checkbox>
        </n-form-item>
        <n-form-item :show-label="false" :feedback="isRegistrationClosed" :validation-status="getErrorStatus(isRegistrationClosed)">
          <n-button :disabled="!formIsValid || isRegistrationClosed !== undefined" :loading="form.processing" type="primary" attr-type="submit"
            >Зарегистрироваться</n-button
          >
        </n-form-item>
      </div>
    </n-form>
  </AppLayout>
</template>

<style scoped lang="scss">
.trip-data {
  margin-bottom: 1rem;
  @include phone {
    margin-bottom: 0.5rem;
  }
}

.container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  column-gap: 1rem;

  @include phone {
    grid-template-columns: 1fr;
  }
}

.actions {
  @include row;
  justify-content: space-between;
  margin-bottom: 4rem;
  .n-button {
    flex-grow: 1;
  }

  @include phone {
    flex-direction: column;
    * {
      flex-grow: 1;
    }
  }
}
</style>
