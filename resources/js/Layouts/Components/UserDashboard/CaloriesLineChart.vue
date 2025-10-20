<script setup lang="ts">
import { LineChart } from "@/components/ui/chart-line"

//apagar quando tiver valores no banco de dados
function getRandom(min: number, max: number): number {
    return parseFloat(((Math.random() * (max - min)) + min).toFixed(2));
}

// passar os valores do backend
const chartData = [];

for (let i = 1; i <= 7; i++) {
    const cals = getRandom(300, 5000);

    chartData.push({
        "day": `Dia ${i}`,
        "Calorias": cals,
        "Meta": 2000,
    });
}
</script>

<template>
    <section class="w-full">
        <h3 class="text-lg font-medium mb-4">Acompanhamento de Calorias Semanal</h3>
        <LineChart :data="chartData" class="h-[250px] w-full" index="day"
            :categories="['Calorias', 'Meta']" :colors="[
                '#22C55E',
                '#0f5227'
            ]" :y-formatter="(tick: number | Date) => {
        return typeof tick === 'number'
            ? tick.toString()
            : ''
    }" :show-x-axis="true" :show-y-axis="true" :show-grid-line="true" />
    </section>
</template>