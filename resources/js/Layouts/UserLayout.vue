<script setup lang="ts">
import { User } from '@/types';
import AppLayout from './AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Route } from 'ziggy-js';

const page = usePage();
const user = computed(() => page.props.auth.user as User);
const patient = computed(() => user.value?.patient);
const activeProtocol = computed(() => patient.value?.active_protocol);
const meals = computed(() => activeProtocol.value?.meals || []);

</script>

<template>
  <AppLayout>
    <template #user-greeting>
      <div class="flex flex-col gap-2">
        <span>
          Olá, {{ user.name }}
        </span>
       
        <span class="text-gray-400">
          {{ user.account_type_label }}
          •
          {{ user.plan_label }}
        </span>

        <span>
          Código: <span class="font-bold"> {{ user.user_code }}</span>
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