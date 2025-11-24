<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
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

const isLoading = ref(false);

const handleUnlink = () => {
    isLoading.value = true;
    
    router.post(route('user.unlink-nutritionist.post'), {}, {
        preserveScroll: true,
        onSuccess: () => {
            isLoading.value = false;
        },
        onError: () => {
            isLoading.value = false;
        },
        onFinish: () => {
            isLoading.value = false;
        }
    });
};
</script>

<template>
  <AlertDialog>
    <AlertDialogTrigger as-child>
      <Button variant="outline" class="border-red-200 text-red-700 hover:bg-red-50 hover:text-red-800">
        Cancelar vínculo
      </Button>
    </AlertDialogTrigger>
    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle class="text-red-600">Tem certeza que deseja cancelar o vínculo?</AlertDialogTitle>
        <AlertDialogDescription>
          Ao cancelar, seu nutricionista perderá o acesso aos seus dados e não poderá mais atualizar seu protocolo.
          <br><br>
          Seus dados históricos serão mantidos, mas o acompanhamento será interrompido.
        </AlertDialogDescription>
      </AlertDialogHeader>
      <AlertDialogFooter>
        <AlertDialogCancel :disabled="isLoading">Cancelar</AlertDialogCancel>
        
        <AlertDialogAction 
            @click.prevent="handleUnlink" 
            class="bg-red-600 hover:bg-red-700 text-white"
            :disabled="isLoading"
        >
            <span v-if="isLoading">Processando...</span>
            <span v-else>Sim, cancelar vínculo</span>
        </AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>