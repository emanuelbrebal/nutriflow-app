<script setup>
import UserLayout from '@/Layouts/UserLayout.vue'

import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3'

defineOptions({
  layout: UserLayout
});

import UserProgress from '@/Layouts/Components/UserDashboard/UserProgress.vue';
import MacroLineChart from '@/Layouts/Components/UserDashboard/MacroLineChart.vue';
import WaterLineChart from '@/Layouts/Components/UserDashboard/WaterLineChart.vue';
import Achievements from '@/Layouts/Components/UserDashboard/Achievements.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'

</script>

<template>

  <Head title="Nutriflow - Seu Dashboard">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>

  <section id="main" class="flex min-h-full w-full gap-6 mb-4">
    <article id="dashboard" class="w-full flex-col justify-between p-8 shadow bg-white rounded border">
      <h2 class="text-xl font-bold">Bem-vindo ao seu Painel!</h2>
      <div class="w-full flex justify-between p-4 gap-4 ">
        <Button class="bg-green-500 text-white w-[400px]"> Registrar Refeições</Button>
        <Button class="bg-blue-400 text-white  w-[400px]"> Registrar Água</Button>
      </div>

      <!-- upper-dashboard -->
      <section id="upper-dashboard" class="flex flex-row w-full justify-between gap-10 mt-8 ">
        <!-- dividir gráficos e progressos em tabs -->
        <Tabs default-value="macros" class="w-4/6">
          <TabsList>
            <TabsTrigger value="cals">
              Calorias
            </TabsTrigger>
            <TabsTrigger value="macros">
              Macronutrientes
            </TabsTrigger>
            <TabsTrigger value="water">
              Água
            </TabsTrigger>
          </TabsList>


          <TabsContent value="cals">
            <article id="line-chart">
              <!-- Calorias -->
            </article>
          </TabsContent>
          <TabsContent value="macros">
            <article id="line-chart">
              <MacroLineChart />
            </article>
          </TabsContent>
          <TabsContent value="water">
            <article id="line-chart">
              <WaterLineChart />
            </article>
          </TabsContent>

        </Tabs>
        <aside id="metrics" class="w-2/6">
          <UserProgress />
        </aside>
      </section>


      <!-- lower-dashboard -->
      <section id="lower-dashboard" class="flex justify-center items-center mt-12">
        <Achievements />
      </section>

    </article>
  </section>
</template>