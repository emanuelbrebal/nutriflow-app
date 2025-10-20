<script setup lang="ts">
// Importações de componentes de UI
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import Textarea from "@/components/ui/textarea/Textarea.vue";

import ProfessionalLayout from '@/Layouts/ProfessionalLayout.vue';
import Metrics from '@/Layouts/Components/Nutritionist/NewEvaluation/Metrics.vue';
defineOptions({
  layout: ProfessionalLayout
});

const data_atual = new Date();

const dia = data_atual.getDay();
const mes = data_atual.getMonth() + 1;
const ano = data_atual.getFullYear();

const data_de_hoje = `${dia}/${mes}/${ano}`

</script>

<template>
  <div class="p-4 md:p-6 h-full">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold">Registrar Nova Avaliação</h1>
      <Button>Salvar Avaliação</Button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <main class="lg:col-span-2 space-y-4 ">
        <Card>
          <CardHeader>
            <CardTitle>Informações Básicas</CardTitle>
          </CardHeader>
          <CardContent class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-2">
              <Label for="assessment_date">Data da Avaliação</Label>
              <Input id="assessment_date" type="date" :value="data_de_hoje" />
            </div>
            <div class="space-y-2">
              <Label for="weight">Peso (kg)</Label>
              <Input id="weight" type="number" step="0.1" value="70.5" />
            </div>
            <div class="space-y-2">
              <Label for="height">Altura (cm)</Label>
              <Input id="height" type="number" value="175" />
            </div>
          </CardContent>
        </Card>
        <Metrics />
      </main>

      <aside class="lg:col-span-1 grid gap-4">
        <Card class="sticky top-6">
          <CardHeader>
            <CardTitle>Resultados (Calculado)</CardTitle>
          </CardHeader>
          <CardContent class="space-y-4">
            <div class="flex justify-between items-baseline">
              <span class="text-gray-600">IMC:</span>
              <span class="text-2xl font-bold">22.9</span>
            </div>
            <div class="flex justify-between items-baseline">
              <span class="text-gray-600">% de Gordura:</span>
              <span class="text-2xl font-bold text-blue-600">21.5%</span>
            </div>
            <div class="flex justify-between items-baseline">
              <span class="text-gray-600">Massa Gorda (kg):</span>
              <span class="text-2xl font-bold">15.1 kg</span>
            </div>
            <div class="flex justify-between items-baseline">
              <span class="text-gray-600">Massa Magra (kg):</span>
              <span class="text-2xl font-bold text-green-600">55.4 kg</span>
            </div>
            <div class="flex justify-between items-baseline">
              <span class="text-gray-600">TMB (kcal):</span>
              <span class="text-2xl font-bold">1650 kcal</span>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader>
            <CardTitle>Observações</CardTitle>
          </CardHeader>
          <CardContent>
            <Textarea placeholder="Digite as observações da consulta..."
              value="Paciente relata boa adesão à dieta. Sentiu melhora na disposição. Aumentar foco em hidratação." />
          </CardContent>
        </Card>
      </aside>

    </div>
  </div>
</template>