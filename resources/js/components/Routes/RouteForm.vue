<script setup lang="ts">
import { computed } from 'vue';
import { InertiaForm } from '@inertiajs/vue3';
import { nanoid } from 'nanoid';

import { getRange } from '@/utils/lib';
import { getErrorStatus } from '@/utils/validation';
import { EMPTY_STOP } from '@/utils/constants';

import { Add, Close } from '@vicons/ionicons5';
import { FormItemRule } from 'naive-ui';

type RouteFormProps = {
  form: InertiaForm<RouteFormType>;
  onSubmit: (...args: any[]) => void
};

export type RouteFormType = {
  name: string;
  stops: (typeof EMPTY_STOP)[];
};

const { form } = defineProps<RouteFormProps>();
const formErrors = computed(() => form.errors as Record<string, string>);

const addStop = () => {
  form.stops.push({
    ...EMPTY_STOP,
    id: nanoid(),
  });
};

const removeStop = (stopIndex: number) => {
  if (stopIndex > form.stops.length) return;
  form.stops.splice(stopIndex, 1);
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
      <div v-for="(stop, idx) in form.stops" :key="stop.id">
        <div class="flex-container">
          <p>Остановка №{{ idx + 1 }}</p>
          <n-button ghost type="error" size="tiny" @click="removeStop(idx)" v-if="form.stops.length > 1">
            <n-icon :component="Close" />
          </n-button>
        </div>
        <div class="stop-container">
          <n-form-item
            :show-label="false"
            :path="`stops[${idx}].name`"
            :rule="stopNameRule"
            :feedback="formErrors[`stops.${idx}.name`]"
            :validation-status="getErrorStatus(formErrors[`stops.${idx}.name`])"
          >
            <n-input v-model:value="stop.name" placeholder="Название остановки" />
          </n-form-item>
          <n-form-item
            :show-label="false"
            :feedback="formErrors[`stops.${idx}.link`]"
            :validation-status="getErrorStatus(formErrors[`stops.${idx}.link`])"
          >
            <n-input v-model:value="stop.link" placeholder="Ссылка на 2GIS" />
          </n-form-item>
          <n-form-item
            :show-label="false"
            :path="`stops[${idx}].arrives_at`"
            :rule="arrivesAtRule"
            :feedback="formErrors[`stops.${idx}.arrives_at`]"
            :validation-status="getErrorStatus(formErrors[`stops.${idx}.arrives_at`])"
          >
            <n-time-picker
              v-model:formatted-value="stop.arrives_at"
              placeholder="Время прибытия"
              value-format="HH:mm"
              :default-value="0"
              format="hh:mm"
              :use12-hours="false"
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
  @include row;
  column-gap: 1rem;
  width: 100%;
  & * {
    flex-grow: 1;
  }

  @include phone {
    flex-wrap: wrap;
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
