<script setup lang="ts">
import { computed, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import LinkPatientsCard from '../MyProfile/LinkedNutritionist/LinkPatientsCard.vue';

const page = usePage();

const user = computed(() => page.props.auth.user)

</script>

<template>
  <AlertDialog>
    <AlertDialogTrigger as-child>
      <Button variant="outline" class="text-white bg-emerald-500 hover:bg-emerald-600 w-full border-0 shadow-sm"
        as-child>
        <span>Convidar Novos Pacientes</span>
      </Button>
    </AlertDialogTrigger>
    <AlertDialogContent class="sm:max-w-4xl w-[95vw]">
      <AlertDialogHeader>
        <AlertDialogTitle>Vincular pacientes</AlertDialogTitle>
        <AlertDialogDescription >
         <LinkPatientsCard :user-code="user.user_code"/>
        </AlertDialogDescription>
      </AlertDialogHeader>
      <AlertDialogFooter>
        <AlertDialogCancel>Cancelar</AlertDialogCancel>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>