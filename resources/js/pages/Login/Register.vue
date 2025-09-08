<script setup lang="ts">
import AuthLayout from "@Layouts/AuthLayout.vue"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select"

defineOptions({
  layout: AuthLayout,
})

import { ref } from 'vue'
import { formatCPF } from '@/utils/formatters/formatCPF'
import { formatPhone } from '@/utils/formatters/formatPhone'

const cpf = ref<string>('')
const phone = ref<string>('')


function onCpfInput(e: Event) {
  const target = e.target as HTMLInputElement
  cpf.value = formatCPF(target.value)
}

function onPhoneInput(e: Event) {
  const target = e.target as HTMLInputElement
  phone.value = formatPhone(target.value)
}

</script>

<template>
  <div>
    <h2 class="text-2xl font-bold mb-6">Criar conta</h2>
    <form class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <Label class="mb-2" for="tratamento">Tratamento</Label>
          <Select>
            <SelectTrigger id="tratamento">
              <SelectValue placeholder="Selecione" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="nutricionista">Nutricionista</SelectItem>
              <SelectItem value="nutricionista">Dr.</SelectItem>
              <SelectItem value="nutricionista">Dra.</SelectItem>
              <SelectItem value="nutricionista">Aluno(a)</SelectItem>
            </SelectContent>
          </Select>
        </div>
        <div>
          <Label class="mb-2" for="nome">Nome completo</Label>
          <Input id="nome" type="text" placeholder="Seu nome" />
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <Label class="mb-2" for="cpf">CPF</Label>
          <Input id="cpf" type="text" placeholder="Apenas números"
          v-model="cpf" 
          @input="onCpfInput" />
        </div>
        <div>
          <Label class="mb-2" for="telefone">Telefone</Label>
          <Input id="telefone" type="text" placeholder="(DDD) + número" 
          @input="onPhoneInput"/>
        </div>
      </div>

      <div>
        <Label class="mb-2" for="email">E-mail para login</Label>
        <Input id="email" type="email" placeholder="seu@email.com" />
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <Label class="mb-2" for="password">Senha de acesso</Label>
          <Input id="password" type="password" placeholder="••••••••" />
        </div>
        <div>
          <Label class="mb-2" for="confirm_password">Confirmar senha</Label>
          <Input id="confirm_password" type="password" placeholder="••••••••" />
        </div>
      </div>

      <Button class="w-full mt-4">Cadastrar e avançar</Button>
    </form>

    <p class="mt-6 text-sm text-gray-500 text-center">
      Já tem conta?
      <a href="/sign-in" class="text-green-600 hover:underline">Clique aqui</a>
    </p>

    <p class="mt-4 text-xs text-gray-400 text-center">
      Ao se cadastrar no Nutriflow, você concorda com os
      <a href="/terms" class="underline"> termos de uso </a> e
      <a href="/privacy" class="underline"> privacidade</a>.
    </p>
  </div>
</template>
