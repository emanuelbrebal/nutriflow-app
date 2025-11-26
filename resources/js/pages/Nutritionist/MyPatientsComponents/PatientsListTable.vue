<script setup lang="ts">
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
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { UserX, FileText, Activity } from 'lucide-vue-next';
import LinkPatientsCard from '@/Layouts/Components/MyProfile/LinkedNutritionist/LinkPatientsCard.vue';

const props = defineProps<{
  patients: any[],
}>();

const page = usePage();

const currentUser = page.props.auth?.user;

const getInitials = (name: string) => {
  return name ? name.substring(0, 2).toUpperCase() : 'UN';
};
</script>

<template>
  <div v-if="patients.length === 0" class="flex flex-col items-center justify-center py-16 px-4 bg-white border border-dashed border-gray-300 rounded-lg">
    <div class="mb-6">
      <LinkPatientsCard :user-code="currentUser.user_code" />
    </div>
  </div>

  <div v-else class="rounded-md border">
    <Table>
      <TableCaption>Uma lista com todos os seus pacientes ativos.</TableCaption>
      <TableHeader>
        <TableRow>
          <TableHead class="w-20">Perfil</TableHead>
          <TableHead>Paciente</TableHead>
          <TableHead class="hidden md:table-cell">Contato</TableHead>
          <TableHead class="text-center">Protocolo</TableHead>
          <TableHead class="text-center">Avaliação</TableHead>
          <TableHead class="text-center">Status</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="patient in patients" :key="patient.id">
          <TableCell>
            <Avatar>
              <AvatarImage
                :src="patient.user?.profile_picture_path ? `/storage/${patient.user.profile_picture_path}` : ''"
                :alt="patient.user?.name" />
              <AvatarFallback>{{ getInitials(patient.user?.name) }}</AvatarFallback>
            </Avatar>
          </TableCell>

          <TableCell class="font-medium">
            <div class="flex flex-col">
              <span class="text-gray-900 font-semibold">{{ patient.user?.name }}</span>
              <span class="text-xs text-gray-500 uppercase">{{ patient.user?.user_code }}</span>
            </div>
          </TableCell>

          <TableCell class="hidden md:table-cell text-gray-600">
            {{ patient.user?.email }}
          </TableCell>

          <TableCell class="text-center">
            <div class="flex flex-col items-center gap-1">
              <Button as-child size="sm" class="bg-orange-400 hover:bg-orange-500 text-white h-8 w-full max-w-[100px]">
                <Link :href="route('nutritionist.redirect.diet_builder', { patientId: patient.id })">
                <FileText class="w-3 h-3 mr-1.5" />
                Dietas
                </Link>
              </Button>
              <span class="text-[10px] text-gray-400" v-if="patient.active_protocol">
                Vence em: {{ patient.active_protocol.end_date }}
              </span>
            </div>
          </TableCell>

          <TableCell class="text-center">
            <div class="flex flex-col items-center gap-1">
              <Button as-child size="sm" class="bg-blue-400 hover:bg-blue-500 text-white h-8 w-full max-w-[100px]">
                <Link :href="route('nutritionist.redirect.set_new_evaluation', { patientId: patient.id })">
                <Activity class="w-3 h-3 mr-1.5" />
                Avaliar
                </Link>
              </Button>
            </div>
          </TableCell>

          <TableCell class="text-center">
            <Badge variant="outline"
                          :class="patient.user?.account_status === 2 ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : 'bg-red-100 text-red-600'">
              {{ patient.user?.account_status === 2 ? 'Ativo' : 'Inativo' }}
            </Badge>
          </TableCell>

        </TableRow>
      </TableBody>
    </Table>
  </div>
</template>