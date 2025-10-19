<script setup lang="ts">
import AppLayout from './AppLayout.vue';
</script>

<template>
  <AppLayout>
    <template #user-greeting>
      Olá, Usuário
    </template>

    <template #navigation-links>
      <a href="#" class="block hover:text-gray-200">Meu Painel</a>
      <a href="#" class="block hover:text-gray-200">Minhas Refeições</a>
      <a href="#" class="block hover:text-gray-200">Progressos</a>
      <a href="#" class="block hover:text-gray-200">Análises</a>
    </template>
    
    <slot />
  </AppLayout>
</template>