<script setup lang="ts">
import PlansLayout from '@/Layouts/PlansLayout.vue';
import { Button } from '@/components/ui/button';
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select";
import { Check } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
defineOptions({
  layout: PlansLayout,
});

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
    
    <header class="relative w-full text-center mb-10">
      <Button 
        @click.prevent="goBack" 
        variant="outline" 
        class="absolute left-0 top-0"
      >
        Voltar
      </Button>
      <h1 class="text-3xl font-bold">
        Finalizar Pagamento
      </h1>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      
      <main class="lg:col-span-2">
        <form>
          <Card>
            <CardHeader>
              <CardTitle>Informações de Pagamento</CardTitle>
              <CardDescription>
                Pagamento seguro fornecido por nosso parceiro.
              </CardDescription>
            </CardHeader>
            <CardContent class="space-y-5">
              
              <div class="space-y-2">
                <Label for="cpf">CPF</Label>
                <Input id="cpf" placeholder="000.000.000-00" />
              </div>

              <div class="space-y-2">
                <Label for="cardholder_name">Nome no Cartão</Label>
                <Input id="cardholder_name" placeholder="Como escrito no cartão" />
              </div>

              <div class="space-y-2">
                <Label for="card_number">Número do Cartão</Label>
                <Input id="card_number" placeholder="0000 0000 0000 0000" />
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <div class="space-y-2">
                  <Label for="expiry_month">Mês (MM)</Label>
                  <Select>
                    <SelectTrigger id="expiry_month">
                      <SelectValue placeholder="Mês" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="01">01</SelectItem>
                      <SelectItem value="02">02</SelectItem>
                      <SelectItem value="03">03</SelectItem>
                      <SelectItem value="04">04</SelectItem>
                      <SelectItem value="05">05</SelectItem>
                      <SelectItem value="06">06</SelectItem>
                      <SelectItem value="07">07</SelectItem>
                      <SelectItem value="08">08</SelectItem>
                      <SelectItem value="09">09</SelectItem>
                      <SelectItem value="10">10</SelectItem>
                      <SelectItem value="11">11</SelectItem>
                      <SelectItem value="12">12</SelectItem>
                    </SelectContent>
                  </Select>
                </div>

                <div class="space-y-2">
                  <Label for="expiry_year">Ano (AAAA)</Label>
                  <Select>
                    <SelectTrigger id="expiry_year">
                      <SelectValue placeholder="Ano" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="2025">2025</SelectItem>
                      <SelectItem value="2026">2026</SelectItem>
                      <SelectItem value="2027">2027</SelectItem>
                      <SelectItem value="2028">2028</SelectItem>
                      <SelectItem value="2029">2029</SelectItem>
                    </SelectContent>
                  </Select>
                </div>

                <div class="space-y-2">
                  <Label for="cvc">CVC</Label>
                  <Input id="cvc" placeholder="123" />
                </div>
              </div>
            </CardContent>
          </Card>
        </form>
      </main>

      <aside class="lg:col-span-1">
        <Card class="sticky top-8">
          <CardHeader>
            <CardTitle>Resumo do Pedido</CardTitle>
          </CardHeader>
          <CardContent>
            <div class="flex justify-between items-center mb-4">
              <span class="text-lg">Plano Intermediário</span>
              <span class="text-xl font-bold">R$ 49</span>
            </div>
            <p class="text-sm text-gray-600 mb-4">Cobrança mensal</p>
            
            <hr class="mb-4" />

            <ul class="space-y-2 mb-6">
              <li class="flex items-center gap-2">
                <Check class="w-5 h-5 text-green-500" />
                <span class="text-gray-700 text-sm">Todos recursos do Básico</span>
              </li>
              <li class="flex items-center gap-2">
                <Check class="w-5 h-5 text-green-500" />
                <span class="text-gray-700 text-sm">Análise avançada de refeições</span>
              </li>
              <li class="flex items-center gap-2">
                <Check class="w-5 h-5 text-green-500" />
                <span class="text-gray-700 text-sm">Relatórios semanais</span>
              </li>
            </ul>

            <div class="flex justify-between items-center text-2xl font-bold">
              <span>Total:</span>
              <span>R$ 49</span>
            </div>
          </CardContent>
          <CardFooter>
            <Button class="w-full">
              Confirmar e Pagar R$ 49
            </Button>
          </CardFooter>
        </Card>
      </aside>

    </div>
  </section>
</template>