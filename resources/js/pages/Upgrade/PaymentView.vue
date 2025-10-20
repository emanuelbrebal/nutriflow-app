<script setup lang="ts">
import PlansLayout from '@/Layouts/PlansLayout.vue';
defineOptions({
    layout: PlansLayout,
});

import Payment from '@/Layouts/Components/Plans/Payment.vue';

</script>

<template>
    <section class="">
        <Payment />
    </section>
</template>