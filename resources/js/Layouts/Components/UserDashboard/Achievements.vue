<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

</script>

<template>
    <div class="gap-4 justify-evenly rounded border-1 shadow-xl p-6 h-full w-full">
        <div class="flex flex-row justify-between items-center mb-6">
            <h3 class="font-medium text-gray-700">
                Objetivo do protocolo atual: Perda de peso
            </h3>
            <div class="flex items-center gap-2">
                <h3 class="font-medium text-gray-700">
                    Nutricionista responsável: Nome
                </h3>
                <Avatar class="w-8 h-8 justify-self-center">
                    <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
                    <AvatarFallback>CN</AvatarFallback>
                </Avatar>
            </div>
        </div>

        <div class="flex flex-row justify-around">

            <Card
                class="w-[160px] h-[160px] bg-white border-t-fuchsia-600 border-t-8 flex flex-col justify-center text-center p-4">
                <div>
                    <CardTitle class="text-3xl font-bold text-gray-800">1850</CardTitle>
                    <CardDescription class="text-sm">Calorias Hoje</CardDescription>
                    <p class="text-xs text-gray-500 mt-1">Meta: 2200 kcal</p>
                </div>
                <CardFooter class="flex flex-col items-center p-0 mt-2">
                    <span class="text-xs font-medium text-green-600">+5% vs ontem</span>
                    <span class="text-xs font-medium text-red-600">-10% vs meta</span>
                </CardFooter>
            </Card>

            <Card class="w-[160px] h-[160px] bg-green-400 text-white p-4 flex flex-col justify-center text-center">
                <CardTitle class="text-4xl font-bold">80%</CardTitle>
                <CardDescription class="text-white/90">Meta Atingida</CardDescription>
                <CardFooter class="p-0 mt-2 text-xs text-white/70 justify-center">
                    Nesta semana
                </CardFooter>
            </Card>

            <Card class="w-[160px] h-[160px] bg-green-400 text-white p-4 flex flex-col justify-center text-center">
                <CardTitle class="text-4xl font-bold">
                    12
                </CardTitle>
                <CardDescription class="text-white/90">
                    Sequência
                </CardDescription>
            </Card>

            <Card class="w-[160px] h-[160px] bg-green-400 text-white p-4 flex flex-col justify-center text-center">
                <CardTitle class="text-4xl font-bold">
                    -2.5kg
                </CardTitle>
                <CardDescription class="text-white/90">
                    Progresso
                </CardDescription>
                <CardFooter class="p-0 mt-2 text-xs text-white/70 justify-center">
                    Neste mês
                </CardFooter>
            </Card>

            <Card class="w-[280px] h-[160px] bg-[#F6FF74] p-4">
                <CardTitle class="text-sm font-bold text-gray-800 mb-2">
                    Comentários do Nutricionista
                </CardTitle>
                <CardContent class="p-0 text-sm text-gray-700 flex flex-col gap-1">
                    <p>Bom trabalho!</p>
                    <p>Continue assim!</p>
                    <p>Melhore nisso...</p>
                </CardContent>
            </Card>

        </div>
    </div>
</template>