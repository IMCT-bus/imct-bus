<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import route from 'ziggy-js';

import { FormRules } from 'naive-ui';

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
  login: [{ required: true, message: 'Пожалуйста, введите логин.', trigger: 'blur' }],
  password: [{ required: true, message: 'Пожалуйста, введите пароль.', trigger: 'blur' }],
};

const onSubmit = () => {
  form.post(route('admin.login.store'));
};
</script>
<template>
  <AppLayout title="Вход">
    <n-space vertical justify="center" class="form-container">
      <n-card>
        <n-form @submit.prevent="onSubmit" :rules="rules" :model="form">
          <n-form-item label="Логин" path="login" :feedback="form.errors.login" :validation-status="getErrorStatus(form.errors.login)">
            <n-input v-model:value="form.login" placeholder="root" maxlength="20" :input-props="{ autocomplete: 'off', name: 'login' }" />
          </n-form-item>
          <n-form-item
            label="Пароль"
            path="password"
            :feedback="form.errors.password || form.errors?.loginError"
            :validation-status="getErrorStatus(form.errors.password || getErrorStatus(form.errors?.loginError))"
          >
            <n-input
              v-model:value="form.password"
              placeholder="********"
              type="password"
              minlength="8"
              maxlength="30"
              @update-value="form.clearErrors('loginError')"
              :input-props="{ autocomplete: 'off', name: 'password' }"
            />
          </n-form-item>
          <n-space justify="end">
            <n-button type="primary" attr-type="submit" :disabled="form.processing">Войти</n-button>
          </n-space>
        </n-form>
      </n-card>
    </n-space>
  </AppLayout>
</template>

<style scoped lang="scss">
.form-container {
  min-height: 600px;
  margin: auto;
  max-width: 500px;
}
</style>
