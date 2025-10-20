<script setup lang="ts">
import { LineChart } from "@/components/ui/chart-line"

//apagar quando tiver valores no banco de dados
function getRandom(min: number, max: number): number {
    return parseFloat(((Math.random() * (max - min)) + min).toFixed(2));
}

// passar os valores do backend
const chartData = [];

for (let i = 1; i <= 7; i++) {
    const water = getRandom(0, 2.8);

    chartData.push({
        "day": `Dia ${i}`,
        "Água": water,
    });
}
</script>

<template>
    <section class="w-full">
        <h3 class="text-lg font-medium mb-4">Acompanhamento de Água Semanal</h3>
        <LineChart :data="chartData" class="h-[250px] w-full" index="day"
            :categories="['Água']" :colors="[
                '#3B82F6',
            ]" :y-formatter="(tick: number | Date) => {
        return typeof tick === 'number'
            ? tick.toString()
            : ''
    }" :show-x-axis="true" :show-y-axis="true" :show-grid-line="true" />
    </section>
</template>