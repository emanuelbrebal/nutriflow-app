<script setup lang="ts">
import UserLayout from '@/Layouts/UserLayout.vue'
import { Head } from '@inertiajs/vue3'
import { defineProps } from 'vue';

import NutritionistOnboardingForm from '@/Layouts/Components/MyProfile/NutritionistOnboardingForm.vue';

defineOptions({
    layout: UserLayout
});

const props = defineProps({
    user: Object
});

</script>

<template>

    <Head title="Nutriflow - Seu Dashboard">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <section id="main" class="w-full flex justify-center py-12">
        <article id="left-page" class="max-w-2xl w-full flex flex-col gap-8">
            <h1 class="text-3xl font-bold text-center">
                Quase lá, {{ props.user?.name }}!
            </h1>
            <NutritionistOnboardingForm v-if="!user?.nutritionist" />
        </article>
    </section>
</template>