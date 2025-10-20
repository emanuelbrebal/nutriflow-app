<script setup lang="ts">
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select";
import { Button } from '@/components/ui/button';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  profile_picture: '',
  birth_date: '',
  biological_sex: null,
  height: '',
  weight: '',
  main_objective: null,
  activity_level: null,
});

const submit = () => {
  form.get(route('user.my-profile'), {
  });
};
</script>

<template>
  <form @submit.prevent="submit" class="w-full max-w-2xl mx-auto rounded shadow bg-white p-8">
    <h2 class="text-2xl font-bold mb-2">Complete seu perfil</h2>
    <p class="text-gray-600 mb-6">
      Precisamos de mais algumas informações para personalizar sua experiência e ajudar seu nutricionista.
    </p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


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
        <div v-if="form.errors.biological_sex" class="text-red-500 text-sm">
          {{ form.errors.biological_sex }}
        </div>
      </div>

      <div class="flex flex-col gap-2">
        <Label for="height">Altura (cm)</Label>
        <Input id="height" type="number" placeholder="Ex: 175" v-model="form.height" />
        <div v-if="form.errors.height" class="text-red-500 text-sm">
          {{ form.errors.height }}
        </div>
      </div>

      <div class="flex flex-col gap-2">
        <Label for="weight">Peso (kg)</Label>
        <Input id="weight" type="number" placeholder="Ex: 70.5" step="0.1" v-model="form.weight" />
        <div v-if="form.errors.weight" class="text-red-500 text-sm">
          {{ form.errors.weight }}
        </div>
      </div>

      <div class="flex flex-col gap-2">
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
        <div v-if="form.errors.main_objective" class="text-red-500 text-sm">
          {{ form.errors.main_objective }}
        </div>
      </div>

      <div class="flex flex-col gap-2">
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
            <SelectItem value="muito_ativo">Muito Ativo (trabalho físico)</SelectItem>
          </SelectContent>
        </Select>
        <div v-if="form.errors.activity_level" class="text-red-500 text-sm">
          {{ form.errors.activity_level }}
        </div>
      </div>
    </div>

    <div class="flex justify-end mt-8">
      <Button type="submit" :disabled="form.processing">
        Salvar e continuar
      </Button>
    </div>
  </form>
</template>