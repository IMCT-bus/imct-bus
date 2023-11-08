<script setup lang="ts">
import { getRange } from '@/utils/lib';
import { getErrorStatus } from '@/utils/validation';
import { useForm } from '@inertiajs/vue3';
import { Add } from '@vicons/ionicons5';
import { FormItemRule } from 'naive-ui';
import route from 'ziggy-js';

type RouteForm = {
  name: string;
  stops: {
    name: string;
    arrives_at: string | null;
    link?: string;
  }[];
};

const EMPTY_STOP = {
  name: '',
  arrives_at: '08:00',
  link: '',
} as const;

const form = useForm<RouteForm>({
  name: '',
  stops: [EMPTY_STOP],
});

function onSubmit() {
  form.post(route('admin.routes.store'), {
    onSuccess: () => {
      form.reset();
    },
  });
}

const addStop = () => {
  form.stops.push(EMPTY_STOP);
};

const nameRule: FormItemRule = {
  required: true,
  message: 'Введите название маршрута',
  trigger: 'blur',
};

const stopNameRule: FormItemRule = {
  required: true,
  message: 'Введите название остановки',
  trigger: 'blur',
};

const arrivesAtRule: FormItemRule = {
  required: true,
  message: 'Введите время прибытия',
  trigger: 'blur',
};
</script>

<template>
  <n-card>
    <n-form :model="form" @submit.prevent="onSubmit">
      <n-form-item
        label="Название маршрута"
        :rule="nameRule"
        path="name"
        :feedback="form.errors.name"
        :validation-status="getErrorStatus(form.errors.name)"
      >
        <n-input v-model:value="form.name" placeholder="Баляева — Кампус ДВФУ" />
      </n-form-item>
      <div v-for="(stop, idx) in form.stops">
        <p>Остановка №{{ idx + 1 }}</p>
        <div class="stop-container">
          <n-form-item
            :show-label="false"
            :path="`stops[${idx}].name`"
            :rule="stopNameRule"
            :feedback="form.errors[`stops.${idx}.name`]"
            :validation-status="getErrorStatus(form.errors[`stops.${idx}.name`])"
          >
            <n-input v-model:value="stop.name" placeholder="Название остановки" />
          </n-form-item>
          <n-form-item
            :show-label="false"
            :feedback="form.errors[`stops.${idx}.link`]"
            :validation-status="getErrorStatus(form.errors[`stops.${idx}.link`])"
          >
            <n-input v-model:value="stop.link" placeholder="Ссылка на 2GIS" />
          </n-form-item>
          <n-form-item
            :show-label="false"
            :path="`stops[${idx}].arrives_at`"
            :rule="arrivesAtRule"
            :feedback="form.errors[`stops.${idx}.arrives_at`]"
            :validation-status="getErrorStatus(form.errors[`stops.${idx}.arrives_at`])"
          >
            <n-time-picker
              v-model:formatted-value="stop.arrives_at"
              placeholder="Время прибытия"
              value-format="hh:mm"
              :default-value="0"
              format="hh:mm"
              :hours="getRange(6, 22)"
            />
          </n-form-item>
        </div>
      </div>
      <div class="button-container">
        <n-button @click="addStop">
          <template #icon>
            <n-icon :component="Add"></n-icon>
          </template>
          Добавить остановку
        </n-button>
      </div>
      <div class="button-container">
        <n-button type="primary" attr-type="submit"> Сохранить </n-button>
      </div>
    </n-form>
  </n-card>
</template>

<style scoped lang="scss">
.stop-container {
  display: grid;
  width: 100%;
  grid-template-columns: 2fr 2fr 1fr;
  gap: 1rem;

  @include phone {
    row-gap: 0;
    grid-template-columns: 1fr 1fr;
    & > *:first-child {
      grid-column: 1 / 3;
    }
  }
  .n-time-picker {
    flex-grow: 1;
  }
}

.button-container {
  @include row;
  justify-content: flex-end;
  margin-top: 0.5rem;

  @include phone {
    & > *:first-child {
      flex-grow: 1;
    }
  }
}
</style>
