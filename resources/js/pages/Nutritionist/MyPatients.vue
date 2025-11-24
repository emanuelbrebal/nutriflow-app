<script setup lang="ts">
import ProfessionalLayout from '@/Layouts/ProfessionalLayout.vue'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

// UI Components
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input'
import { Search, Info } from "lucide-vue-next"
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger
} from '@/components/ui/tooltip'

import Planner from '@/Layouts/Components/Nutritionist/MyPatients/Planner.vue';
import PatientsListTable from './MyPatientsComponents/PatientsListTable.vue';


defineOptions({
  layout: ProfessionalLayout
});

defineProps<{
    patients: any[]
}>();

</script>

<template>

  <Head title="Nutriflow - Meus Pacientes">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>

  <section class="flex flex-col lg:flex-row min-h-full w-full gap-6 mb-4 p-4 md:p-0">
    
    <article id="my-patients" class="w-full lg:w-3/5 p-6 md:p-8 shadow-sm bg-white rounded-xl border border-gray-100">
      
      <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-2">Bem-vindo ao painel de seus pacientes!</h2>
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <span class="font-medium">Seus pacientes vinculados</span>
            <TooltipProvider>
            <Tooltip>
                <TooltipTrigger>
                    <Info class="w-4 h-4 text-gray-400 hover:text-gray-600 cursor-help" />
                </TooltipTrigger>
                <TooltipContent>
                <p class="text-center max-w-xs text-xs">
                    Gerencie seus pacientes nesta aba.
                    <br>
                    Acompanhe protocolos, avaliações e status.
                </p>
                </TooltipContent>
            </Tooltip>
            </TooltipProvider>
        </div>
      </div>

      <div class="flex flex-col gap-4 mb-6">
          <Button variant="outline" class="text-white bg-emerald-500 hover:bg-emerald-600 w-full border-0 shadow-sm" as-child>
            <span>Convidar Novos Pacientes</span>
          </Button>

          <div class="relative w-full">
            <Input id="patient-search" type="text" placeholder="Buscar paciente por nome, código ou email..." class="pl-10 bg-gray-50 border-gray-200 focus:bg-white transition-colors" />
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <Search class="w-4 h-4 text-gray-400" />
            </span>
          </div>
      </div>

     
      <PatientsListTable :patients="patients" />

    </article>

    <aside id="planner" class="w-full lg:w-2/5 p-6 md:p-8 shadow-sm bg-white rounded-xl border border-gray-100 h-fit">
      <Planner/>
    </aside>

  </section>
</template>