<script setup lang="ts">
import AppLayout from './AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const user = computed(() => page.props.auth.user);

</script>

<template>
  <AppLayout>
    <template #user-greeting>
      <div class="flex flex-col gap-2" v-if="user">
        <span>
          Olá, {{ user.name }}
        </span>
        <span class="text-gray-400">
          {{ user.account_type_label }}
          •
          {{ user.plan_label }}
        </span>

      </div>
    </template>

    <template #navigation-links>
      <Link :href="route('user.my-dashboard')" class="block hover:text-gray-200">Meu Painel</Link>
      <Link :href="route('user.my-meals')" class="block hover:text-gray-200">Minhas Refeições</Link>
      <Link :href="route('user.progresses')" class="block hover:text-gray-200">Progressos</Link>
      <Link :href="route('user.analysis')" class="block hover:text-gray-200">Análises</Link>
    </template>
    <slot />
  </AppLayout>
</template>