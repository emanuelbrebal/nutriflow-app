<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Button } from "@/components/ui/button"
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { route } from 'ziggy-js';

const form = useForm({
  email: '',
  password: '',
});

const submit = () => {
  form.post(route('login.post'), {
    onError: () => form.reset('password'),
  });
};

defineOptions({
  layout: AuthLayout,
});
</script>

<template>
  <div class="min-h-[50vh] flex flex-col justify-center">
    <h2 class="text-2xl font-bold mb-8 text-center">Acessar conta</h2>

    <form class="space-y-4" @submit.prevent="submit">

      <div>
        <Label class="mb-2" for="email">E-mail</Label>
        <Input id="email" type="email" placeholder="seu@email.com" v-model="form.email" autocomplete="username" />
        <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
          {{ form.errors.email }}
        </div>
      </div>

      <div>
        <Label class="mb-2" for="password">Senha</Label>
        <Input id="password" type="password" placeholder="********" v-model="form.password"
          autocomplete="current-password" />
        <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
          {{ form.errors.password }}
        </div>
      </div>

      <Button class="w-full mt-4" type="submit" :disabled="form.processing">
        <span v-if="form.processing">Entrando...</span>
        <span v-else>Entrar</span>
      </Button>
    </form>

    <p class="mt-6 text-sm text-gray-500 text-center">
      Não tem conta?
      <Link :href="route('register.redirect')" class="font-bold text-green-500 hover:underline">
      Cadastre-se
      </Link>
    </p>
  </div>
</template>