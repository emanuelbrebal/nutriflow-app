<script setup lang="ts">
// Importações de componentes de UI
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardHeader, CardTitle, CardContent, CardFooter, CardDescription } from '@/components/ui/card';
import { Progress } from '@/components/ui/progress';
import { Separator } from '@/components/ui/separator';
import { Alert, AlertDescription } from '@/components/ui/alert';
import { PlusCircle, Search, Trash2 } from 'lucide-vue-next';

import ProfessionalLayout from '@/Layouts/ProfessionalLayout.vue';

defineOptions({
  layout: ProfessionalLayout
});

</script>

<template>
  <div class="p-4 md:p-6">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold">Criar Protocolo de Dieta</h1>
        <p class="text-lg text-gray-600">para: <span class="font-medium">Ana Silva</span></p>
      </div>
      <Button size="lg">
        <PlusCircle class="w-4 h-4 mr-2" />
        Salvar e Publicar Protocolo
      </Button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

      <main class="lg:col-span-2 space-y-6">

        <Card>
          <CardContent class="p-4">
            <Label for="protocol_name" class="text-base font-medium">Nome do Protocolo</Label>
            <Input id="protocol_name" type="text" value="Dieta de Reeducação - Semana 1-4" class="mt-2 text-base" />
          </CardContent>
        </Card>

        <Card>
          <CardHeader class="flex flex-row items-center justify-between">
            <CardTitle>Café da Manhã (08:00)</CardTitle>
            <span class="text-sm font-medium text-gray-600">350 kcal</span>
          </CardHeader>
          <CardContent class="space-y-4">
            
            <div class="border rounded-lg p-3">
              <Label class="text-xs font-semibold uppercase text-gray-500">Opção 1</Label>
              <div class="flex justify-between items-center mt-2">
                <span>Ovos mexidos (2 unidades)</span>
                <span class="text-sm text-gray-700">140 kcal</span>
              </div>
              <div class="flex justify-between items-center mt-1">
                <span>Pão integral (2 fatias)</span>
                <span class="text-sm text-gray-700">150 kcal</span>
              </div>
            </div>
            
            <div class="border rounded-lg p-3">
              <Label class="text-xs font-semibold uppercase text-gray-500">Opção 2 (Substituição)</Label>
              <div class="flex justify-between items-center mt-2">
                <span>Iogurte Natural (1 pote) + Aveia (30g)</span>
                <span class="text-sm text-gray-700">180 kcal</span>
              </div>
            </div>

          </CardContent>
          <CardFooter class="justify-between">
            <Button variant="outline">
              <PlusCircle class="w-4 h-4 mr-2" />
              Adicionar Alimento
            </Button>
            <Button variant="ghost" size="icon" class="text-red-500">
              <Trash2 class="w-4 h-4" />
            </Button>
          </CardFooter>
        </Card>

        <Card>
          <CardHeader class="flex flex-row items-center justify-between">
            <CardTitle>Almoço (12:30)</CardTitle>
            <span class="text-sm font-medium text-gray-600">650 kcal</span>
          </CardHeader>
          <CardContent class="space-y-4">
            <div class="border rounded-lg p-3">
              <Label class="text-xs font-semibold uppercase text-gray-500">Opção Única</Label>
              <div class="flex justify-between items-center mt-2">
                <span>Peito de Frango Grelhado</span>
                <span class="text-sm text-gray-700">150g</span>
              </div>
              <div class="flex justify-between items-center mt-1">
                <span>Arroz Branco, cozido</span>
                <span class="text-sm text-gray-700">100g</span>
              </div>
              <div class="flex justify-between items-center mt-1">
                <span>Feijão Carioca, cozido</span>
                <span class="text-sm text-gray-700">70g</span>
              </div>
              <div class="flex justify-between items-center mt-1">
                <span>Salada de folhas e tomate</span>
                <span class="text-sm text-gray-700">À vontade</span>
              </div>
            </div>
          </CardContent>
          <CardFooter class="justify-between">
            <Button variant="outline">
              <PlusCircle class="w-4 h-4 mr-2" />
              Adicionar Alimento
            </Button>
            <Button variant="ghost" size="icon" class="text-red-500">
              <Trash2 class="w-4 h-4" />
            </Button>
          </CardFooter>
        </Card>

        <Button variant="secondary" class="w-full">
          <PlusCircle class="w-4 h-4 mr-2" />
          Adicionar Nova Refeição
        </Button>

      </main>

      <aside class="lg:col-span-1">
        <div class="sticky top-6 space-y-6">
          
          <Card>
            <CardHeader>
              <CardTitle>Metas de Ana Silva</CardTitle>
              <CardDescription>Baseado na avaliação de 20/10/2025</CardDescription>
            </CardHeader>
            <CardContent class="space-y-3">
              <div class="flex justify-between text-lg">
                <span>Gasto Energético Total (GET):</span>
                <span class="font-bold">2000 kcal</span>
              </div>
              <Separator />
              <div class="flex justify-between"><span>Proteínas (2.0g/kg):</span> <span class="font-medium">140g</span></div>
              <div class="flex justify-between"><span>Carboidratos (40%):</span> <span class="font-medium">200g</span></div>
              <div class="flex justify-between"><span>Gorduras (30%):</span> <span class="font-medium">67g</span></div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Totais deste Protocolo</CardTitle>
              <CardDescription>Atualizado em tempo real</CardDescription>
            </CardHeader>
            <CardContent class="space-y-4">
              
              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">Calorias</span>
                  <span class="font-bold text-lg text-blue-600">1950 / 2000 kcal</span>
                </div>
                <Progress :model-value="97.5" />
              </div>
              
              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">Proteínas</span>
                  <span class="font-bold text-rose-600">138 / 140g</span>
                </div>
                <Progress :model-value="98.5" :style="{ '--primary': '#E11D48' }" />
              </div>

              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">Carboidratos</span>
                  <span class="font-bold text-orange-600">195 / 200g</span>
                </div>
                <Progress :model-value="97.5" :style="{ '--primary': '#F97316' }" />
              </div>

              <div>
                <div class="flex justify-between mb-1">
                  <span class="font-medium">Gorduras</span>
                  <span class="font-bold text-amber-600">65 / 67g</span>
                </div>
                <Progress :model-value="97" :style="{ '--primary': '#FACC15' }" />
              </div>

            </CardContent>
          </Card>
          
          <Alert>
            <Search class="w-4 h-4" />
            <AlertDescription>
              Ação <span class="font-bold">[+ Adicionar Alimento]</span> abriria um modal de busca na base de alimentos.
            </AlertDescription>
          </Alert>

        </div>
      </aside>

    </div>
  </div>
</template>