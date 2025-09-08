<template>

  <Head title="Nutriflow - Seu Dashboard">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>
  <div>
    <h2 class="text-xl font-bold">Bem-vindo ao seu painel!</h2>
  </div>
  <section class="flex min-h-full w-full gap-6 mb-4">
    <article id="my-patients" class="w-3/5 p-8 shadow bg-white rounded border">
      <span class="font-bold">
        Seus pacientes
        <TooltipProvider>
          <Tooltip>
            <Badge variant="outline" class="m-1 rounded-full">
              <TooltipTrigger class="font-bold">i</TooltipTrigger>
            </Badge>
            <TooltipContent>
              <p class="text-center">
                Gerencie seus pacientes nesta aba.
                <br>
                A consulta será feita por status e prazo do protocolo (quanto mais próximo da data de vencimento).
              </p>
            </TooltipContent>
          </Tooltip>
        </TooltipProvider>
      </span>
      <Button variant="outline" class="text-white bg-emerald-400 w-full mb-4 mt-4" as-child>
        <a href="">
          Adicionar pacientes
        </a>
      </Button>
      <div class="flex w-full items-center gap-1.5 mb-4">
        <Input id="patient-search" type="text" placeholder="Buscar paciente" class="pl-10" />
        <span class="absolute flex items-center justify-center px-2">
          <Search class="size-6 text-muted-foreground " />
        </span>
      </div>
      Colocar um input de busca dos pacientes
      Colocar filtros de busca
      <Table>
        <TableCaption>
          Uma lista com todos os seus pacientes ativos.
        </TableCaption>
        <TableHeader>
          <TableRow>
            <TableHead class="w-[100px]"></TableHead>
            <TableHead class="w-[100px]">Usuario</TableHead>
            <TableHead>E-mail</TableHead>
            <TableHead>Prazo do protocolo</TableHead>
            <TableHead>Status</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow>
            <TableCell class="font-medium">
              <Avatar class="justify-self-center">
                <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
                <AvatarFallback>CN</AvatarFallback>
              </Avatar>
            </TableCell>
            <TableCell class="font-medium">
              USER001
            </TableCell>
            <TableCell class="font-medium">
              user_name.surname@email.com
            </TableCell>
            <TableCell class="font-medium">
              dd/mm/yyyy
            </TableCell>
            <TableCell class="font-medium">
              <Badge variant="outline" class="bg-emerald-300">Ativo</Badge>
            </TableCell>
          </TableRow>
          <TableRow>
            <TableCell class="font-medium">
              <Avatar class="justify-self-center">
                <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
                <AvatarFallback>CN</AvatarFallback>
              </Avatar>
            </TableCell>
            <TableCell class="font-medium">
              USER002
            </TableCell>
            <TableCell class="font-medium">
              user_name.surname2@email.com
            </TableCell>
            <TableCell class="font-medium">
              dd/mm/yyyy
            </TableCell>
            <TableCell class="font-medium">
              <Badge variant="destructive">Inativo</Badge>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>


    </article>

    <aside id="planner" class="w-2/5 p-8 shadow bg-white rounded">

      <span class="font-bold">
        Seu planner
        <TooltipProvider>
          <Tooltip>
            <Badge variant="outline" class="m-1 rounded-full">
              <TooltipTrigger class="font-bold">i</TooltipTrigger>
            </Badge>
            <TooltipContent>
              <p>Gerencie suas atividades aqui.</p>
            </TooltipContent>
          </Tooltip>
        </TooltipProvider>
      </span>
      <Button variant="outline" class="text-white bg-emerald-400 w-full mb-4 mt-4" as-child>
        <a href="">
          Adicionar tarefa
        </a>
      </Button>

      <Table>
        <TableHeader>

        </TableHeader>
      </Table>
      Colocar outra tabela aqui>
      tabela com checkboxes
    </aside>
  </section>



</template>

<script setup>
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import ProfessionalLayout from '@Layouts/ProfessionalLayout.vue'
import Badge from '@/components/ui/badge/Badge.vue';
import Button from '@/components/ui/button/Button.vue';
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger
} from '@/components/ui/tooltip'
import { Input } from '@/components/ui/input'
import { Search } from "lucide-vue-next"

defineOptions({
  layout: ProfessionalLayout
});
</script>