<script setup lang="ts">
import PlansLayout from '@/Layouts/PlansLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter
} from '@/components/ui/card';
import { Check } from 'lucide-vue-next'; 

defineOptions({
  layout: PlansLayout,
});

const featuresBasico = [
  'Criação de dieta personalizada',
  'Registro de refeições',
  'Acompanhamento básico',
];

const featuresIntermediario = [
  'Todos recursos do Básico',
  'Análise avançada de refeições',
  'Relatórios semanais',
  'Dicas personalizadas',
];

const featuresPremium = [
  'Todos recursos do Intermediário',
  'Consultoria nutricional online',
  'Acesso a insights avançados',
  'Monitoramento diário personalizado',
];

function goBack() {
  if (window.history.length > 2) {
   window.history.back();
  } else {
    router.visit(route('dashboard')); 
  }
}
</script>

<template>
  <section class="w-full p-6 md:p-8">
    
    <header class="relative w-full text-center mb-12">
      <Button 
        @click.prevent="goBack" 
        variant="outline" 
        class="absolute left-0 top-0"
      >
        Voltar
      </Button>

      <h1 class="text-3xl font-bold">
        Nossos Planos
      </h1>
      <p class="text-lg text-gray-600 mt-2">
        Escolha o plano que melhor se adapta aos seus objetivos e 
        desbloqueie todo o potencial do Nutriflow.
      </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

      <Card class="flex flex-col">
        <CardHeader class="text-center">
          <CardTitle class="text-xl font-semibold">Básico</CardTitle>
          <CardDescription>
            Ideal para começar sua jornada nutricional.
          </CardDescription>
        </CardHeader>
        <CardContent class="flex-1">
          <p class="text-center text-4xl font-bold mb-6">Gratuito</p>
          <ul class="space-y-2">
            <li v-for="feature in featuresBasico" :key="feature" class="flex items-center gap-2">
              <Check class="w-5 h-5 text-green-500" />
              <span class="text-gray-700">{{ feature }}</span>
            </li>
          </ul>
        </CardContent>
        <CardFooter>
          <Button as-child class="w-full">
            <Link :href="route('register.redirect')">Começar Gratuitamente</Link>
          </Button>
        </CardFooter>
      </Card>

      <Card class="flex flex-col border-2 border-green-500 shadow-lg">
        <CardHeader class="text-center">
          <CardTitle class="text-xl font-semibold">Intermediário</CardTitle>
          <CardDescription>
            Para quem quer resultados mais detalhados.
          </CardDescription>
        </CardHeader>
        <CardContent class="flex-1">
          <p class="text-center text-4xl font-bold mb-6">
            R$49<span class="text-lg font-normal text-gray-600">/mês</span>
          </p>
          <ul class="space-y-2">
            <li v-for="feature in featuresIntermediario" :key="feature" class="flex items-center gap-2">
              <Check class="w-5 h-5 text-green-500" />
              <span class="text-gray-700">{{ feature }}</span>
            </li>
          </ul>
        </CardContent>
        <CardFooter>
          <Button as-child class="w-full bg-green-500 hover:bg-green-600">
            <Link :href="route('payment.redirect', { plan: 'intermediario' })">Assinar Plano</Link>
          </Button>
        </CardFooter>
      </Card>

      <Card class="flex flex-col">
        <CardHeader class="text-center">
          <CardTitle class="text-xl font-semibold">Premium</CardTitle>
          <CardDescription>
            O plano completo para transformar sua alimentação.
          </CardDescription>
        </CardHeader>
        <CardContent class="flex-1">
          <p class="text-center text-4xl font-bold mb-6">
            R$79<span class="text-lg font-normal text-gray-600">/mês</span>
          </p>
          <ul class="space-y-2">
            <li v-for="feature in featuresPremium" :key="feature" class="flex items-center gap-2">
              <Check class="w-5 h-5 text-green-500" />
              <span class="text-gray-700">{{ feature }}</span>
            </li>
          </ul>
        </CardContent>
        <CardFooter>
          <Button as-child class="w-full">
            <Link :href="route('payment.redirect', { plan: 'premium' })">Assinar Plano</Link>
          </Button>
        </CardFooter>
      </Card>
      
    </div>
  </section>
</template>