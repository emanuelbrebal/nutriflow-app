<script setup lang="ts">
import PlansCards from '@/Layouts/Components/Plans/PlansCards.vue';
import PlansLayout from '@/Layouts/PlansLayout.vue';
import { Link } from '@inertiajs/vue3';
defineOptions({
    layout: PlansLayout,
});
</script>

<template>
    <section class="w-full">
        <Link :href="route('login.redirect')"> Voltar </Link>
        <PlansCards />
    </section>
</template>