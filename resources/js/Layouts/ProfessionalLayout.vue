<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from './AppLayout.vue';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user)
</script>

<template>
  <AppLayout>
    <template #user-greeting>
      Olá, {{ user.name }}
    </template>

    <template #navigation-links>
      <Link :href="route('nutritionist.my-patients')" class="block hover:text-gray-200">Meus Pacientes</Link>
      <a href="#" class="block hover:text-gray-200">Gerenciar Cardápios</a>
    </template>

    <slot />
  </AppLayout>
</template>