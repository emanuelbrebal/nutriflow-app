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
    specialties: SelectOption[]; 
  }
}

const page = usePage<PageEnums>();

const options = page.props.enums || { specialties: [] };

const form = useForm({
  profile_picture: null as File | null,
  mobile_number: '',
  crn: '',
  specialty: null as string | number | null,
});

const handlePhoneMask = (e: Event) => {
  let value = e.target.value;

  value = value.replace(/\D/g, "");

  value = value.substring(0, 11);

  value = value.replace(/^(\d{2})(\d)/g, "($1) $2");
  
  value = value.replace(/(\d)(\d{4})$/, "$1-$2");

  form.mobile_number = value;
};

const handleCrnMask = (e: Event) => {
  let value = e.target.value;

  let numbers = value.replace(/\D/g, "");

  if (numbers.length === 0) {
    form.crn = "";
    return;
  }

  let region = numbers.substring(0, 1);
  let registration = numbers.substring(1);


  if (registration.length > 0) {
    form.crn = `CRN-${region} ${registration}`;
  } else {
    form.crn = `CRN-${region}`;
  }
};

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    form.profile_picture = target.files[0];
  }
};

const submit = () => {
  form.post(route('nutritionist.onboarding-form.post'), {
    preserveScroll: true,
    forceFormData: true, 
  });
};
</script>

<template>
  <div class="w-full bg-white rounded-xl shadow-sm border border-gray-200 p-8">
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-900">Perfil Profissional</h2>
      <p class="text-gray-500 mt-1">
        Essas informações validam sua atuação e ajudam os pacientes a encontrarem sua especialidade.
      </p>
    </div>

    <form @submit.prevent="submit">
      <FieldGroup>

        <FieldSet>
          <FieldLegend>Identificação</FieldLegend>
          <FieldDescription>
            Como os pacientes visualizarão seu perfil.
          </FieldDescription>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <Field class="md:col-span-2">
              <FieldLabel for="profile_picture">Foto Profissional</FieldLabel>
              <div class="flex items-center gap-4">
                <input id="profile_picture" name="profile_picture" type="file" accept="image/*"
                  @change="handleFileChange"
                  class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0  file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer file:text-green-700 file:bg-green-50 file:rounded-md file:px-2 file:py-1 file:mr-4 hover:file:bg-green-100"
                  :class="{ 'border-red-500': form.errors.profile_picture }" />
              </div>
              <FieldDescription>
                Recomendado: Foto de rosto clara e iluminada. JPG ou PNG. Máximo 2MB.
              </FieldDescription>
              <p v-if="form.errors.profile_picture" class="text-xs text-red-500 mt-1">
                {{ form.errors.profile_picture }}
              </p>
            </Field>

            <Field>
              <FieldLabel for="mobile_number">Celular Profissional / WhatsApp</FieldLabel>
              <Input id="mobile_number" type="tel" placeholder="(00) 00000-0000" v-model="form.mobile_number"
                :class="{ 'border-red-500': form.errors.mobile_number }" @input="handlePhoneMask" maxlength="15"/>
              <p v-if="form.errors.mobile_number" class="text-xs text-red-500 mt-1">
                {{ form.errors.mobile_number }}
              </p>
            </Field>

          </div>
        </FieldSet>

        <FieldSeparator />

        <FieldSet>
          <FieldLegend>Dados Técnicos</FieldLegend>
          <FieldDescription>
            Informações regulatórias e área de foco.
          </FieldDescription>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <Field>
              <FieldLabel for="crn">Número do CRN</FieldLabel>
              <Input id="crn" type="text" placeholder="Ex: CRN-3 12345" v-model="form.crn"
                :class="{ 'border-red-500': form.errors.crn }" @input="handleCrnMask"/>
              <FieldDescription>
                Seu registro no Conselho Regional de Nutricionistas.
              </FieldDescription>
              <p v-if="form.errors.crn" class="text-xs text-red-500 mt-1">
                {{ form.errors.crn }}
              </p>
            </Field>

            <Field>
              <FieldLabel for="specialty">Especialidade Principal</FieldLabel>
              <Select v-model="form.specialty">
                <SelectTrigger id="specialty" :class="{ 'border-red-500': form.errors.specialty }">
                  <SelectValue placeholder="Selecione sua área..." />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem 
                    v-for="option in options.specialties" 
                    :key="String(option.value)"
                    :value="String(option.value)"
                  >
                    {{ option.label }}
                  </SelectItem>
                </SelectContent>
              </Select>
              <p v-if="form.errors.specialty" class="text-xs text-red-500 mt-1">
                {{ form.errors.specialty }}
              </p>
            </Field>

          </div>
        </FieldSet>

        <div class="flex justify-end pt-4">
          <Button type="submit" :disabled="form.processing"
            class="bg-green-600 hover:bg-green-700 text-white font-bold px-8">
            <span v-if="form.processing">Salvando...</span>
            <span v-else>Concluir Cadastro</span>
          </Button>
        </div>

      </FieldGroup>
    </form>
  </div>
</template>