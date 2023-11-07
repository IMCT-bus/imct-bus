<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import { NSpace, NCard, NForm, NFormItem, NInput, NButton, FormRules } from 'naive-ui';

import AppLayout from '@/layouts/AppLayout.vue';

import { getErrorStatus } from '@/utils/validation';

type LoginForm = {
  login: string;
  password: string;
};
const form = useForm<LoginForm>({
  login: '',
  password: '',
});

const rules: FormRules = {
  login: [{ required: true, message: 'Пожалуйста, введите логин', trigger: 'blur' }],
  password: [{ required: true, message: 'Пожалуйста, введите пароль', trigger: 'blur' }],
};

const onSubmit = () => {
  form.post(route('admin.login.store'));
};
</script>
<template>
  <AppLayout title="Вход">
    <NSpace vertical justify="center" class="form-container">
      <NCard>
        <NForm @submit.prevent="onSubmit" :rules="rules" :model="form">
          <NFormItem label="Логин" path="login" :feedback="form.errors.login" :validation-status="getErrorStatus(form.errors.login)">
            <NInput v-model:value="form.login" placeholder="root" :input-props="{ autocomplete: 'off', name: 'login' }" />
          </NFormItem>
          <NFormItem label="Пароль" path="password" :feedback="form.errors.password || form.errors?.loginError" :validation-status="getErrorStatus(form.errors.password || getErrorStatus(form.errors?.loginError))">
            <NInput
              v-model:value="form.password"
              placeholder="********"
              type="password"
              minlength="8"
              maxlength="16"
              @update-value="form.clearErrors('loginError')"
              :input-props="{ autocomplete: 'off', name: 'password' }"
            />
          </NFormItem>
          <NSpace justify="end">
            <NButton type="primary" attr-type="submit" :disabled="form.processing">Войти</NButton>
          </NSpace>
        </NForm>
      </NCard>
    </NSpace>
  </AppLayout>
</template>

<style scoped lang="scss">
.form-container {
  height: 100vh;
  margin: auto;
  max-width: 500px;
}
</style>
