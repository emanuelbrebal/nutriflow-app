<script setup lang="ts">
import AppLayout from './AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Route } from 'ziggy-js';
</script>

<template>
  <AppLayout>
    <template #user-greeting>
      Olá, Usuário
    </template>

    <template #navigation-links>
      <Link :href="route('user.my-dashboard')" class="block hover:text-gray-200">Meu Painel</Link>
      <a href="#" class="block hover:text-gray-200">Minhas Refeições</a>
      <a href="#" class="block hover:text-gray-200">Progressos</a>
      <a href="#" class="block hover:text-gray-200">Análises</a>
    </template>
    
    <slot />
  </AppLayout>
</template>