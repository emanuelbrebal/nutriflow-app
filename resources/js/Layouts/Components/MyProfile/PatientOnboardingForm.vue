<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';
import {
  Field,
  FieldDescription,
  FieldGroup,
  FieldLabel,
  FieldLegend,
  FieldSeparator,
  FieldSet,
} from '@/components/ui/field';
import { route } from 'ziggy-js';

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

const form = useForm({
  profile_picture: null as File | null,
  mobile_number: '',
  birth_date: '',
  biological_sex: null as string | number | null,
  height: '',
  weight: '',
  main_objective: null as string | number | null,
  activity_level: null as string | number | null,
});

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    form.profile_picture = target.files[0];
  }
};

const submit = () => {
  form.post(route('user.onboarding-form.post'), {
    preserveScroll: true,
    forceFormData: true,
  });
};
</script>

<template>
  <div class="w-full bg-white rounded-xl shadow-sm border border-gray-200 p-8">
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-900">Complete seu Perfil</h2>
      <p class="text-gray-500 mt-1">
        Essas informações são essenciais para que seu nutricionista crie o melhor plano para você.
      </p>
    </div>

    <form @submit.prevent="submit">
      <FieldGroup>

        <FieldSet>
          <FieldLegend>Informações Pessoais</FieldLegend>
          <FieldDescription>
            Identificação e contatos básicos.
          </FieldDescription>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <Field class="md:col-span-2">
              <FieldLabel for="profile_picture">Foto de Perfil</FieldLabel>
              <div class="flex items-center gap-4">
                <input id="profile_picture" name="profile_picture" type="file" accept="image/*"
                  @change="handleFileChange"
                  class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer file:text-green-700 file:bg-green-50 file:rounded-md file:px-2 file:py-1 file:mr-4 hover:file:bg-green-100"
                  :class="{ 'border-red-500': form.errors.profile_picture }" />
              </div>
              <FieldDescription>
                Recomendado: JPG ou PNG. Máximo 2MB.
              </FieldDescription>
              <p v-if="form.errors.profile_picture" class="text-xs text-red-500 mt-1">
                {{ form.errors.profile_picture }}
              </p>
            </Field>

            <Field>
              <FieldLabel for="mobile_number">Número de Celular</FieldLabel>
              <Input id="mobile_number" type="tel" placeholder="(00) 00000-0000" v-model="form.mobile_number"
                :class="{ 'border-red-500': form.errors.mobile_number }" />
              <p v-if="form.errors.mobile_number" class="text-xs text-red-500 mt-1">
                {{ form.errors.mobile_number }}
              </p>
            </Field>

            <Field>
              <FieldLabel for="birth_date">Data de Nascimento</FieldLabel>
              <Input id="birth_date" type="date" v-model="form.birth_date"
                :class="{ 'border-red-500': form.errors.birth_date }" />
              <p v-if="form.errors.birth_date" class="text-xs text-red-500 mt-1">
                {{ form.errors.birth_date }}
              </p>
            </Field>

            <Field>
              <FieldLabel for="biological_sex">Sexo Biológico</FieldLabel>
              <Select v-model="form.biological_sex">
                <SelectTrigger id="biological_sex" :class="{ 'border-red-500': form.errors.biological_sex }">
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
            </Field>
          </div>
        </FieldSet>

        <FieldSeparator />

        <FieldSet>
          <FieldLegend>Composição Corporal</FieldLegend>
          <FieldDescription>
            Medidas atuais para cálculo de necessidades calóricas.
          </FieldDescription>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <Field>
              <FieldLabel for="height">Altura (cm)</FieldLabel>
              <Input id="height" type="number" placeholder="Ex: 175" v-model="form.height"
                :class="{ 'border-red-500': form.errors.height }" />
              <FieldDescription>Use centímetros (sem vírgula).</FieldDescription>
              <p v-if="form.errors.height" class="text-xs text-red-500 mt-1">
                {{ form.errors.height }}
              </p>
            </Field>

            <Field>
              <FieldLabel for="weight">Peso (kg)</FieldLabel>
              <Input id="weight" type="number" placeholder="Ex: 70.5" step="0.1" v-model="form.weight"
                :class="{ 'border-red-500': form.errors.weight }" />
              <p v-if="form.errors.weight" class="text-xs text-red-500 mt-1">
                {{ form.errors.weight }}
              </p>
            </Field>
          </div>
        </FieldSet>

        <FieldSeparator />

        <FieldSet>
          <FieldLegend>Objetivos e Rotina</FieldLegend>
          <FieldDescription>
            Onde você quer chegar e como é o seu dia a dia.
          </FieldDescription>

          <div class="grid grid-cols-1 gap-6">
            <Field>
              <FieldLabel for="main_objective">Qual seu principal objetivo?</FieldLabel>
              <Select v-model="form.main_objective">
                <SelectTrigger id="main_objective" :class="{ 'border-red-500': form.errors.main_objective }">
                  <SelectValue placeholder="Selecione um objetivo" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem v-for="option in options.objectives" :key="String(option.value)"
                    :value="String(option.value)">
                    {{ option.label }}
                  </SelectItem>
                </SelectContent>
              </Select>
              <p v-if="form.errors.main_objective" class="text-xs text-red-500 mt-1">
                {{ form.errors.main_objective }}
              </p>
            </Field>

            <Field>
              <FieldLabel for="activity_level">Nível de Atividade Física</FieldLabel>
              <Select v-model="form.activity_level">
                <SelectTrigger id="activity_level" :class="{ 'border-red-500': form.errors.activity_level }">
                  <SelectValue placeholder="Selecione sua frequência de exercícios" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem v-for="option in options.activity_levels" :key="String(option.value)"
                    :value="String(option.value)">
                    {{ option.label }}
                  </SelectItem>
                </SelectContent>
              </Select>
              <p v-if="form.errors.activity_level" class="text-xs text-red-500 mt-1">
                {{ form.errors.activity_level }}
              </p>
            </Field>
          </div>
        </FieldSet>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="form.processing"
            class="bg-green-600 hover:bg-green-700 text-white font-bold px-8">
            <span v-if="form.processing">Salvando...</span>
            <span v-else>Salvar Perfil</span>
          </Button>
        </div>

      </FieldGroup>
    </form>
  </div>
</template>