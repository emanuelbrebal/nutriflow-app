<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLayout from './AppLayout.vue';
</script>

<template>
  <AppLayout>
    <template #user-greeting>
      Olá, Nutricionista
    </template>

    <template #navigation-links>
      <Link :href="route('nutritionist.my-patients')" class="block hover:text-gray-200">Meus Pacientes</Link>
      <a href="#" class="block hover:text-gray-200">Gerenciar Cardápios</a>
      <a href="#" class="block hover:text-gray-200">Análises</a>
    </template>

    <slot />
  </AppLayout>
</template>