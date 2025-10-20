<script setup lang="ts">
import { LineChart } from "@/components/ui/chart-line"

//apagar quando tiver valores no banco de dados
function getRandom(min: number, max: number): number {
    return parseFloat(((Math.random() * (max - min)) + min).toFixed(2));
}

// passar os valores do backend
const chartData = [];

for (let i = 1; i <= 7; i++) {
    const carbs = getRandom(25, 45);
    const fat = getRandom(15, 30);
    const protein = getRandom(45, 65);

    chartData.push({
        "day": `Dia ${i}`,
        "Carboidratos": carbs,
        "Gorduras": fat,
        "Proteínas": protein,
    });
}
</script>

<template>
    <section class="w-full">
        <h3 class="text-lg font-medium mb-4">Acompanhamento de Macronutrientes Semanal</h3>
        <LineChart :data="chartData" class="h-[250px] w-full" index="day"
            :categories="['Carboidratos', 'Gorduras', 'Proteínas']" :colors="[
                '#F97316',
                '#FACC15',
                '#E11D48',
            ]" :y-formatter="(tick: number | Date) => {
        return typeof tick === 'number'
            ? tick.toString()
            : ''
    }" :show-x-axis="true" :show-y-axis="true" :show-grid-line="true" />
    </section>
</template>