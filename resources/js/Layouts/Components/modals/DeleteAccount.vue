<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
} from '@/components/ui/card';
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

const handleDeleteAccount = () => {
    isLoading.value = true;
    
    router.post(route('user.delete'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Card class="border-red-200 bg-red-50">
        <CardHeader>
            <CardTitle class="text-red-600">Zona de Perigo</CardTitle>
        </CardHeader>
        <CardContent>
            <p class="text-sm text-red-800 mb-4">
                Excluir sua conta é uma ação permanente.
            </p>

            <AlertDialog>
                <AlertDialogTrigger as-child>
                    <Button 
                        variant="destructive" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white border-none shadow-sm"
                    >
                        Desativar conta
                    </Button>
                </AlertDialogTrigger>
                
                <AlertDialogContent>
                    <AlertDialogHeader>
                        <AlertDialogTitle class="text-red-600">
                            Tem certeza que deseja desativar sua conta?
                        </AlertDialogTitle>
                        
                        <AlertDialogDescription class="text-gray-600">
                            Pense bem! Esta ação é <strong>irreversível</strong>! 
                            <br><br>
                            Todos os seus dados serão removidos. Caso tenha interesse em reativar a sua conta posteriormente, você precisará entrar em contato com o suporte.
                            <br><br>
                            E-mail: suporte.nutriflow@email.com
                        </AlertDialogDescription>
                    </AlertDialogHeader>

                    <AlertDialogFooter>
                        <AlertDialogCancel :disabled="isLoading">
                            Cancelar
                        </AlertDialogCancel>

                        <AlertDialogAction 
                            @click.prevent="handleDeleteAccount" 
                            class="bg-red-600 hover:bg-red-700 text-white border-none"
                            :disabled="isLoading"
                        >
                            <span v-if="isLoading">Desativando...</span>
                            <span v-else>Sim, desativar conta</span>
                        </AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>
        </CardContent>
    </Card>
</template>