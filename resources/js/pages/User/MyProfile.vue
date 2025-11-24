<script setup lang="ts">
import { useForm, Link, usePage } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select";
import { Button } from '@/components/ui/button';
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/components/ui/card';
import { User } from '@/types';
import { route } from 'ziggy-js';

import LinkedNutritionist from '@/Layouts/Components/MyProfile/LinkedNutritionist/LinkedNutritionist.vue';
import LinkNutritionistCard from '@/Layouts/Components/MyProfile/LinkedNutritionist/LinkNutritionistCard.vue';

const props = defineProps<{
    user: User
}>();

defineOptions({
    layout: UserLayout,
});

interface SelectOption {
    value: string | number;
    label: string;
}

interface PageEnums {
    enums: {
        objectives: SelectOption[];
        activity_levels: SelectOption[];
        biological_sex: SelectOption[];
    }
}

const page = usePage<PageEnums>();
const options = page.props.enums || { objectives: [], activity_levels: [], biological_sex: [] };

const formatDate = (isoString?: string) => {
    if (!isoString) return '';
    return isoString.split('T')[0];
};

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    mobile_number: props.user.mobile_number || '',
    profile_picture: null as File | null,
    birth_date: formatDate(props.user.patient?.birth_date),


    biological_sex: props.user.patient?.biological_sex ? String(props.user.patient.biological_sex) : '',

    height: props.user.patient?.height ?? '',
    weight: props.user.patient?.weight ?? '',

    main_objective: props.user.patient?.main_objective ? String(props.user.patient.main_objective) : '',
    activity_level: props.user.patient?.activity_level ? String(props.user.patient.activity_level) : '',
});

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        form.profile_picture = target.files[0];
    }
};

const submitProfileUpdate = () => {
    form.post(route('user.update.post'), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>
    <div class="p-4 md:p-8">
        <h1 class="text-3xl font-bold mb-6">Minha Conta</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <main class="lg:col-span-2">

                <div class="mb-6">
                    <LinkedNutritionist v-if="user.patient?.nutritionist" :nutritionist="user.patient.nutritionist" />
                    <LinkNutritionistCard v-else :user-code="user.user_code" />
                </div>

                <form @submit.prevent="submitProfileUpdate">
                    <Card>
                        <CardHeader>
                            <CardTitle>Minhas Informações Pessoais</CardTitle>
                            <CardDescription>
                                Estes são os dados que seu nutricionista usará como base.
                            </CardDescription>
                        </CardHeader>

                        <CardContent class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="md:col-span-2 flex flex-col gap-2">
                                <Label for="profile_picture">Foto de Perfil</Label>
                                <input id="profile_picture" name="profile_picture" type="file" accept="image/*"
                                    @change="handleFileChange"
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer file:text-green-700 file:bg-green-50 file:rounded-md file:px-2 file:py-1 file:mr-4 hover:file:bg-green-100"
                                    :class="{ 'border-red-500': form.errors.profile_picture }" />
                                <p v-if="form.errors.profile_picture" class="text-xs text-red-500">
                                    {{ form.errors.profile_picture }}
                                </p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="name">Nome Completo</Label>
                                <Input id="name" type="text" v-model="form.name" />
                                <div v-if="form.errors.name" class="text-red-500 text-sm">
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="email">E-mail (Login)</Label>
                                <Input id="email" type="email" v-model="form.email" disabled
                                    class="bg-gray-100 text-gray-500 cursor-not-allowed" />
                                <p class="text-xs text-gray-500">O e-mail não pode ser alterado.</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label for="mobile_number">Celular</Label>
                                <Input id="mobile_number" type="tel" placeholder="(00) 00000-0000"
                                    v-model="form.mobile_number" />
                                <div v-if="form.errors.mobile_number" class="text-red-500 text-sm">
                                    {{ form.errors.mobile_number }}
                                </div>
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
                                    <SelectTrigger id="biological_sex"
                                        :class="{ 'border-red-500': form.errors.biological_sex }">
                                        <SelectValue placeholder="Selecione..." />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem v-for="option in options.biological_sex" :key="String(option.value)"
                                            :value="String(option.value)">
                                            {{ option.label }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                                <p v-if="form.errors.biological_sex" class="text-xs text-red-500 mt-1">
                                    {{ form.errors.biological_sex }}
                                </p>
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

                            <div class="flex flex-col gap-2 md:col-span-2">
                                <Label for="main_objective">Objetivo Principal</Label>
                                <Select v-model="form.main_objective">
                                    <SelectTrigger id="main_objective">
                                        <SelectValue placeholder="Selecione seu objetivo" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem v-for="option in options.objectives" :key="String(option.value)"
                                            :value="String(option.value)">
                                            {{ option.label }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>

                            <div class="flex flex-col gap-2 md:col-span-2">
                                <Label for="activity_level">Nível de Atividade Física</Label>
                                <Select v-model="form.activity_level">
                                    <SelectTrigger id="activity_level"
                                        :class="{ 'border-red-500': form.errors.activity_level }">
                                        <SelectValue placeholder="Selecione seu nível" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem v-for="option in options.activity_levels"
                                            :key="String(option.value)" :value="String(option.value)">
                                            {{ option.label }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>

                        </CardContent>
                        <CardFooter class="flex justify-end border-t bg-gray-50/50 px-6 py-4">
                            <Button type="submit" :disabled="form.processing"
                                class="bg-green-600 hover:bg-green-700 text-white">
                                <span v-if="form.processing">Salvando...</span>
                                <span v-else>Salvar Alterações</span>
                            </Button>
                        </CardFooter>
                    </Card>
                </form>
            </main>

            <aside class="lg:col-span-1 flex flex-col gap-6">
                <Card>
                    <CardHeader>
                        <CardTitle>Segurança da Conta</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-sm text-gray-600 mb-4">Deseja alterar sua senha de acesso?</p>
                        <Button variant="outline" class="w-full">Alterar Senha</Button>
                    </CardContent>
                </Card>

                <Card class="border-red-100 bg-red-50">
                    <CardHeader>
                        <CardTitle class="text-red-600">Zona de Perigo</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-sm text-red-800 mb-4">Excluir sua conta é uma ação permanente.</p>
                        <Button variant="destructive" class="w-full bg-red-600 hover:bg-red-700">Excluir minha
                            conta</Button>
                    </CardContent>
                </Card>
            </aside>
        </div>
    </div>
</template>