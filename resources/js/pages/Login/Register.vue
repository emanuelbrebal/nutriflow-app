<script setup lang="ts">
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select";
import { useForm, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

interface Option {
    value: string;
    label: string;
}

defineProps<{
  accountTypes: Option[]
}>();

defineOptions({
  layout: AuthLayout,
});

const form = useForm({
  account_type: '',
  name: '',
  email: '',
  password: '',
});

const submit = () => {
  form.post(route('register.post'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <div>
    <h2 class="text-2xl font-bold mb-2">Crie sua conta</h2>
    <p class="text-gray-500 mb-6 text-sm">
      Preencha os dados básicos para acessar a plataforma.
    </p>

    <form class="space-y-4" @submit.prevent="submit">

      <div>
        <Label class="mb-2 block" for="account_type">Eu sou...</Label>
        <Select v-model="form.account_type">
          <SelectTrigger id="account_type">
            <SelectValue placeholder="Selecione seu perfil" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem v-for="type in accountTypes" :key="type.value" :value="type.value">
              {{ type.label }}
            </SelectItem>
          </SelectContent>
        </Select>
        <div v-if="form.errors.account_type" class="text-red-500 text-sm mt-1">
          {{ form.errors.account_type }}
        </div>
      </div>

      <div>
        <Label class="mb-2 block" for="name">Nome completo</Label>
        <Input id="name" type="text" placeholder="Digite seu nome" v-model="form.name" />
        <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
          {{ form.errors.name }}
        </div>
      </div>

      <div>
        <Label class="mb-2 block" for="email">E-mail</Label>
        <Input id="email" type="email" placeholder="seu@email.com" v-model="form.email" />
        <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
          {{ form.errors.email }}
        </div>
      </div>

      <div>
        <Label class="mb-2 block" for="password">Senha</Label>
        <Input id="password" type="password" placeholder="••••••••" v-model="form.password" />
        <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
          {{ form.errors.password }}
        </div>
      </div>

      <Button class="w-full mt-4" type="submit" :disabled="form.processing">
        {{ form.processing ? 'Criando conta...' : 'Continuar' }}
      </Button>
    </form>

    <p class="mt-6 text-sm text-gray-500 text-center">
      Já tem conta?
      <Link :href="route('login.redirect')" class="text-green-600 hover:underline font-semibold">Faça login</Link>
    </p>

    <p class="mt-4 text-xs text-gray-400 text-center px-4">
      Ao continuar, você concorda com nossos <a href="#" class="underline">termos de uso</a> e <a href="#"
        class="underline">política de privacidade</a>.
    </p>
  </div>
</template>