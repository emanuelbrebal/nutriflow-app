<script setup lang="ts">
import { ref, computed } from 'vue';
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter
} from '@/components/ui/card';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger
} from '@/components/ui/tooltip';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Info, Plus } from 'lucide-vue-next';
import Checkbox from '@/components/ui/checkbox/Checkbox.vue';

const tasks = ref([
  {
    id: 1,
    done: false,
    task: 'Montar protocolo inicial',
    patient: 'Ana Silva',
    due: '20/10/2025',
    priority: 'Alta',
  },
  {
    id: 2,
    done: false,
    task: 'Revisar exames de sangue',
    patient: 'Bruno Costa',
    due: '21/10/2025',
    priority: 'Alta',
  },
  {
    id: 3,
    done: true,
    task: 'Fazer consulta de retorno',
    patient: 'Carla Dias',
    due: '19/10/2025',
    priority: 'Média',
  },
  {
    id: 4,
    done: false,
    task: 'Ajustar dieta (pós-avaliação)',
    patient: 'USER001 (da sua tabela)',
    due: '22/10/2025',
    priority: 'Média',
  },
  {
    id: 5,
    done: false,
    task: 'Enviar receitas novas',
    patient: 'USER002 (da sua tabela)',
    due: '23/10/2025',
    priority: 'Baixa',
  },
]);

const completedCount = computed(() => tasks.value.filter(t => t.done).length);
const totalCount = computed(() => tasks.value.length);
</script>

<template>
  <Card class="w-full">
    <CardHeader class="flex flex-row items-center justify-between">
      <div>
        <div class="flex items-center gap-2">
          <CardTitle>Seu Planner</CardTitle>
          <TooltipProvider>
            <Tooltip>
              <TooltipTrigger>
                <Info class="w-4 h-4 text-gray-500" />
              </TooltipTrigger>
              <TooltipContent>
                <p>Suas tarefas pendentes da semana.</p>
              </TooltipContent>
            </Tooltip>
          </TooltipProvider>
        </div>
        <CardDescription>
          Tarefas relacionadas aos seus pacientes.
        </CardDescription>
      </div>
      <Button variant="outline" size="sm">
        <Plus class="w-4 h-4 mr-2" />
        Adicionar Tarefa
      </Button>
    </CardHeader>
    
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead class="w-[50px]">Feito</TableHead>
            <TableHead>Tarefa</TableHead>
            <TableHead class="w-[100px]">Prazo</TableHead>
            <TableHead class="w-[100px]">Prioridade</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow v-if="tasks.length === 0">
            <TableCell colspan="4" class="text-center text-gray-500">
              Nenhuma tarefa pendente!
            </TableCell>
          </TableRow>

          <TableRow v-for="task in tasks" :key="task.id" :class="task.done ? 'bg-gray-50' : ''">
            
            <TableCell>
              <Checkbox :checked="task.done" />
            </TableCell>
            
            <TableCell>
              <div 
                class="font-medium" 
                :class="task.done ? 'line-through text-gray-500' : 'text-gray-900'"
              >
                {{ task.task }}
              </div>
              <div 
                class="text-sm"
                :class="task.done ? 'line-through text-gray-400' : 'text-gray-600'"
              >
                Paciente: {{ task.patient }}
              </div>
            </TableCell>
            
            <TableCell 
              class="text-sm"
              :class="task.done ? 'line-through text-gray-400' : 'text-gray-700'"
            >
              {{ task.due }}
            </TableCell>
            
            <TableCell>
              <Badge 
                :variant="task.priority === 'Alta' ? 'destructive' : (task.priority === 'Média' ? 'warning' : 'outline')"
              >
                {{ task.priority }}
              </Badge>
            </TableCell>

          </TableRow>
        </TableBody>
      </Table>
    </CardContent>

    <CardFooter>
      <p class="text-sm text-gray-600">
        {{ completedCount }} de {{ totalCount }} tarefas concluídas.
      </p>
    </CardFooter>
  </Card>
</template>