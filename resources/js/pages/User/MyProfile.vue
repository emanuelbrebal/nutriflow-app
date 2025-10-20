<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue'; // Assumindo que você tem um Layout de Usuário
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select";
import { Button } from '@/components/ui/button';
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/components/ui/card';

import NutritionistInfoCard from '@/Layouts/Components/MyProfile/NutritionistInfoCard.vue';


const props = defineProps<{
    user: {
        name: string;
        email: string;
        birth_date: string;
        biological_sex: 'masculino' | 'feminino';
        height: number;
        weight: number;
        main_objective: 'perder_peso' | 'ganhar_massa' | 'manter_peso' | 'reeducacao';
        activity_level: 'sedentario' | 'leve' | 'moderado' | 'ativo' | 'muito_ativo';

        nutritionist: {
            name: string;
            specialty: string;
            crn: string;
            avatar_url: string;
        }
    }
}>();

defineOptions({
    layout: UserLayout,
});

const form = useForm({
    name: 'Ana Silva',
    email: 'ana.silva@exemplo.com',
    birth_date: '1995-05-15',
    biological_sex: 'feminino',
    height: 168,
    weight: 65.5,
    main_objective: 'perder_peso',
    activity_level: 'leve',
});

const submitProfileUpdate = () => {
    //   form.patch(route('profile.update'), {
    //     preserveScroll: true,
    //     onSuccess: () => {
    //     },
    //   });
};
</script>

<template>
    <div class="p-4 md:p-8">
        <h1 class="text-3xl font-bold mb-6">Minha Conta</h1>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <main class="lg:col-span-2">
                <form @submit.prevent="submitProfileUpdate">
                    <Card>
                        <CardHeader>
                            <CardTitle>Minhas Informações Pessoais</CardTitle>
                            <CardDescription>
                                Estes são os dados que seu nutricionista usará como base.
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="flex flex-col gap-2">
                                <Label for="name">Nome Completo</Label>
                                <Input id="name" type="text" v-model="form.name" />
                                <div v-if="form.errors.name" class="text-red-500 text-sm">
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="email">E-mail (Login)</Label>
                                <Input id="email" type="email" v-model="form.email" disabled />
                                <p class="text-xs text-gray-500">O e-mail não pode ser alterado.</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="birth_date">Data de Nascimento</Label>
                                <Input id="birth_date" type="date" v-model="form.birth_date" />
                                <div v-if="form.errors.birth_date" class="text-red-500 text-sm">
                                    {{ form.errors.birth_date }}
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="biological_sex">Sexo Biológico</Label>
                                <Select v-model="form.biological_sex">
                                    <SelectTrigger id="biological_sex">
                                        <SelectValue placeholder="Selecione" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="masculino">Masculino</SelectItem>
                                        <SelectItem value="feminino">Feminino</SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="height">Altura (cm)</Label>
                                <Input id="height" type="number" placeholder="Ex: 175" v-model="form.height" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="weight">Peso Atual (kg)</Label>
                                <Input id="weight" type="number" placeholder="Ex: 70.5" step="0.1"
                                    v-model="form.weight" />
                            </div>

                            <div class="flex flex-row justify-between">
                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <Label for="main_objective">Objetivo Principal</Label>
                                    <Select v-model="form.main_objective">
                                        <SelectTrigger id="main_objective">
                                            <SelectValue placeholder="Selecione seu objetivo" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="perder_peso">Perder peso</SelectItem>
                                            <SelectItem value="ganhar_massa">Ganhar massa muscular</SelectItem>
                                            <SelectItem value="manter_peso">Manter peso</SelectItem>
                                            <SelectItem value="reeducacao">Reeducação alimentar</SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <Label for="activity_level">Nível de Atividade Física</Label>
                                    <Select v-model="form.activity_level">
                                        <SelectTrigger id="activity_level">
                                            <SelectValue placeholder="Selecione seu nível" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="sedentario">Sedentário (pouco ou nenhum)</SelectItem>
                                            <SelectItem value="leve">Leve (1-3 dias/semana)</SelectItem>
                                            <SelectItem value="moderado">Moderado (3-5 dias/semana)</SelectItem>
                                            <SelectItem value="ativo">Ativo (6-7 dias/semana)</SelectItem>
                                            <SelectItem value="muito_ativo">Muito Ativo (trabalho físico)
                                            </SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                            </div>


                        </CardContent>
                        <CardFooter class="flex justify-end">
                            <Button type="submit" :disabled="form.processing">
                                Salvar Alterações
                            </Button>
                        </CardFooter>
                    </Card>
                </form>
            </main>

            <aside class="lg:col-span-1 flex flex-col gap-6">

                <NutritionistInfoCard />
                <Card>
                    <CardHeader>
                        <CardTitle>Segurança da Conta</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-sm text-gray-600 mb-4">
                            Deseja alterar sua senha de acesso?
                        </p>
                        <Button as-child>
                            <Button> Alterar Senha
                            </Button>
                        </Button>
                    </CardContent>
                </Card>

                <Card class="border-red-500">
                    <CardHeader>
                        <CardTitle class="text-red-600">Zona de Perigo</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-sm text-gray-600 mb-4">
                            Excluir sua conta é uma ação permanente e não pode ser desfeita.
                        </p>
                        <Button variant="destructive">
                            Excluir minha conta
                        </Button>
                    </CardContent>
                </Card>

            </aside>
        </div>
    </div>
</template>