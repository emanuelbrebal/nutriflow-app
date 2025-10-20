<script setup lang="ts">
import { Progress } from '@/components/ui/progress'
import { Label } from '@/components/ui/label'
</script>

<template>
    <p class="font-medium">
        Progresso de hoje:
    </p>
    <div class="flex flex-col gap-4 w-[90%] justify-evenly rounded border-2 shadow-xl p-8 h-fit">

        <div class="flex justify-between">
            <Label for="calories">Calorias</Label>
            <Label>900 kcal / 2700kcal </Label>
        </div>
        <Progress :model-value="33" id="calories" :style="{ '--primary': '#22C55E' }" />

        <div class="flex justify-between">
            <Label for="carbs">Carboidratos</Label>
            <Label>40g / 80g</Label>
        </div>
        <Progress :model-value="50" id="carbs" :style="{ '--primary': '#F97316' }" />

        <div class="flex justify-between">
            <Label for="fat">Gorduras</Label>
            <Label>8g / 25 g</Label>
        </div>
        <Progress :model-value="22" id="fat" :style="{ '--primary': '#FACC15' }" />

        <div class="flex justify-between">
            <Label for="proteins">Proteínas</Label>
            <Label>60g / 88g</Label>
        </div>
        <Progress :model-value="55" id="proteins" :style="{ '--primary': '#E11D48' }" />

        <div class="flex justify-between">
            <Label for="water">Água</Label>
            <Label>1.8L / 2.6L</Label>
        </div>
        <Progress :model-value="77" id="water" :style="{ '--primary': '#3B82F6' }" />

    </div>
</template>