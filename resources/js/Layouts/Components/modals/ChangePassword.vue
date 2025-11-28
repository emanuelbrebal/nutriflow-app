<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
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
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';

const form = useForm({
    password: '',
});

const handlePasswordChange = () => {
    form.post(route('user.change-password'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            form.reset('password');
        }
    });
};
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle>Segurança da Conta</CardTitle>
        </CardHeader>
        <CardContent>
            <p class="text-sm text-gray-600 mb-4">
                Deseja alterar sua senha de acesso?
            </p>

            <AlertDialog>
                <AlertDialogTrigger as-child>
                    <Button variant="outline" class="w-full border-red-200 text-red-700 hover:bg-red-50 hover:text-red-800">
                        Alterar senha de acesso
                    </Button>
                </AlertDialogTrigger>
                
                <AlertDialogContent>
                    <AlertDialogHeader>
                        <AlertDialogTitle class="text-red-600">
                            Tem certeza que deseja alterar a sua senha?
                        </AlertDialogTitle>
                        
                        <AlertDialogDescription class="text-gray-600">
                            Nossa equipe nunca entrará em contato solicitando dados sensíveis.
                            <br>
                            Ao suspeitar de algo, envie um e-mail para: suporte.nutriflow@email.com
                        </AlertDialogDescription>
                    </AlertDialogHeader>

                    <div class="py-4 space-y-2">
                        <Label for="password">Nova Senha</Label>
                        <Input 
                            id="password" 
                            type="password" 
                            placeholder="••••••••" 
                            v-model="form.password"
                            @keydown.enter.prevent="handlePasswordChange"
                            :class="{ 'border-red-500': form.errors.password }"
                        />
                        <div v-if="form.errors.password" class="text-red-500 text-xs font-medium">
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <AlertDialogFooter>
                        <AlertDialogCancel :disabled="form.processing">
                            Cancelar
                        </AlertDialogCancel>

                        <AlertDialogAction 
                            @click.prevent="handlePasswordChange" 
                            class="bg-red-600 hover:bg-red-700 text-white"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Alterando...</span>
                            <span v-else>Sim, alterar senha</span>
                        </AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>
        </CardContent>
    </Card>
</template>