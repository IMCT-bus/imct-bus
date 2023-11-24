<script setup lang="ts">
import { ref } from 'vue';
import route from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';

import { Close, PencilSharp, SaveSharp } from '@vicons/ionicons5';

import { vMaska } from 'maska';
import { getErrorStatus, passMask, fullNameMask } from '@/utils/validation';
import { is } from 'date-fns/locale';

type PassengerListItemProps = {
  passenger: Models.Passenger;
  onDeleteClick: (passenger: Models.Passenger) => void;
};

const props = defineProps<PassengerListItemProps>();
const isEditing = ref(false);

const form = useForm<Pick<Models.Passenger, 'full_name' | 'pass'>>({
  pass: props.passenger.pass,
  full_name: props.passenger.full_name,
});

function onUpdateClick() {
  isEditing.value = true;
}

function onUpdateSave() {
  form.put(route('admin.passengers.update', props.passenger.id), {
    onSuccess: () => (isEditing.value = false),
  });
}
</script>
<template>
  <div class="item-container">
    <n-form-item v-if="isEditing" :show-label="false" :feedback="form.errors.pass" :validation-status="getErrorStatus(form.errors.pass)">
      <n-input
        v-model:value="form.pass"
        v-maska:[passMask]
        :input-props="{
          inputmode: 'numeric',
        }"
        maxlength="4"
        placeholder="5432"
      />
    </n-form-item>
    <p v-else>{{ passenger.pass }}</p>
    <n-form-item v-if="isEditing" :show-label="false" :feedback="form.errors.full_name" :validation-status="getErrorStatus(form.errors.full_name)">
      <n-input v-model:value="form.full_name" v-maska:[fullNameMask] placeholder="Иванов И.И." />
    </n-form-item>
    <p v-else class="name">{{ passenger.full_name }}</p>
    <div class="actions">
      <n-button type="info" quaternary @click="onUpdateSave" v-if="isEditing">
        <template #icon>
          <n-icon :component="SaveSharp" size="20px" />
        </template>
      </n-button>
      <n-button type="info" quaternary @click="onUpdateClick" v-else>
        <template #icon>
          <n-icon :component="PencilSharp" size="20px" />
        </template>
      </n-button>
      <n-button type="error" quaternary @click="onDeleteClick(passenger)">
        <template #icon>
          <n-icon :component="Close" size="20px" />
        </template>
      </n-button>
    </div>
  </div>
</template>

<style scoped lang="scss">
.item-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr) 250px;
  column-gap: 1rem;
  .actions {
    justify-self: center;
  }
}
</style>
