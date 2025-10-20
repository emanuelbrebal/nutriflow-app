<script setup lang="ts">
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select";
import { useForm, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { ref } from "vue";
import {
  PinInput,
  PinInputGroup,
  PinInputSlot,
} from "@/components/ui/pin-input";
import { Badge } from '@/components/ui/badge';
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger
} from '@/components/ui/tooltip';

const value = ref<string[]>([]);
const handleComplete = (e: string[]) => alert(e.join(""));


defineOptions({
  layout: AuthLayout,
});

const form = useForm({
  tratamento: null,
  nome: '',
  code: '',
  telefone: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register.post'), {
    onError: () => {
      form.reset('password', 'password_confirmation')
    }
  })
};
</script>

<template>
  <div>
    <h2 class="text-2xl font-bold mb-6">Criar conta</h2>
    <form class="space-y-4" @submit.prevent="submit">
      <div class="grid w-full max-w-sm items-center gap-1.5">
        <Label for="picture">Foto de Perfil</Label>
        <Input id="picture" type="file" />
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <Label class="mb-2" for="tratamento">Tratamento</Label>
          <Select v-model="form.tratamento">
            <SelectTrigger id="tratamento">
              <SelectValue placeholder="Selecione" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="nutricionista">Nutricionista</SelectItem>
              <SelectItem value="paciente">Paciente</SelectItem>
              <SelectItem value="aluno">Aluno(a)</SelectItem>
            </SelectContent>
          </Select>
          <div v-if="form.errors.tratamento" class="text-red-500 text-sm mt-1">
            {{ form.errors.tratamento }}
          </div>
        </div>
        <div>
          <div class="flex flex-row items-center">
            <Label class="mb-2" for="cpf">Código</Label>
            <TooltipProvider>
              <Tooltip>
                <Badge variant="outline" class="m-1 rounded-full">
                  <TooltipTrigger class="font-bold">i</TooltipTrigger>
                </Badge>
                <TooltipContent>
                  <p class="text-center">
                    Informe o código que seu nutricionista passou.
                  </p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>
          </div>
          <div>
            <PinInput id="pin-input" v-model="value" placeholder="o" @complete="handleComplete">
              <PinInputGroup>
                <PinInputSlot v-for="(id, index) in 6" :key="id" :index="index" />
              </PinInputGroup>
            </PinInput>
          </div>
          <div v-if="form.errors.code" class="text-red-500 text-sm mt-1">
            {{ form.errors.code }}
          </div>
        </div>

      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <Label class="mb-2" for="nome">Nome completo</Label>
          <Input id="nome" type="text" placeholder="Seu nome" v-model="form.nome" />
          <div v-if="form.errors.nome" class="text-red-500 text-sm mt-1">
            {{ form.errors.nome }}
          </div>
        </div>
        <div>
          <Label class="mb-2" for="telefone">Telefone</Label>
          <Input id="telefone" type="text" placeholder="(DDD) + número" v-model="form.telefone" />
          <div v-if="form.errors.telefone" class="text-red-500 text-sm mt-1">
            {{ form.errors.telefone }}
          </div>
        </div>
      </div>

      <div>
        <Label class="mb-2" for="email">E-mail para login</Label>
        <Input id="email" type="email" placeholder="seu@email.com" v-model="form.email" />
        <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <Label class="mb-2" for="password">Senha de acesso</Label>
          <Input id="password" type="password" placeholder="••••••••" v-model="form.password" />
          <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
            {{ form.errors.password }}
          </div>
        </div>
        <div>
          <Label class="mb-2" for="confirm_password">Confirmar senha</Label>
          <Input id="confirm_password" type="password" placeholder="••••••••" v-model="form.password_confirmation" />
        </div>
      </div>

      <Button class="w-full mt-4" type="submit" :disabled="form.processing">
        Cadastrar e avançar
      </Button>
    </form>

    <p class="mt-6 text-sm text-gray-500 text-center">
      Já tem conta?
      <Link :href="route('login.redirect')" class="text-green-600 hover:underline">Clique aqui</Link>
    </p>

    <p class="mt-4 text-xs text-gray-400 text-center">
      Ao se cadastrar no Nutriflow, você concorda com os
      <a href="#" class="underline"> termos de uso </a> e
      <a href="#" class="underline"> privacidade</a>.
    </p>
  </div>
</template>