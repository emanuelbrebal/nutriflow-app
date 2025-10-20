<script setup>
import UserLayout from '@/Layouts/UserLayout.vue'

import { Head, Link } from '@inertiajs/vue3'

defineOptions({
    layout: UserLayout
});

import PatientOnboardingForm from '@/Layouts/Components/MyProfile/PatientOnboardingForm.vue';
import NutritionistInfoCard from '@/Layouts/Components/MyProfile/NutritionistInfoCard.vue';

</script>

<template>

    <Head title="Nutriflow - Seu Dashboard">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <section id="main" class="w-full flex justify-center py-12">
        <article id="left-page" class="max-w-2xl w-full flex flex-col gap-8">
            <h1 class="text-3xl font-bold text-center">
                Quase lá, {nome do paciente}!
            </h1>
            <NutritionistInfoCard />
            <PatientOnboardingForm />
        </article>


    </section>
</template>