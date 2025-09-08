<script setup lang="ts">
import AuthLayout from "@Layouts/AuthLayout.vue"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"

defineOptions({
  layout: AuthLayout,
})

</script>

<template>
<div class="min-h-[50vh] flex flex-col justify-center">
    <h2 class="text-2xl font-bold mb-6">Acessar conta</h2>
    <form class="space-y-4">
      <div >
        <Label class="mb-2" for="email">E-mail</Label>
        <Input id="email" type="email" placeholder="seu@email.com" />
      </div>

      <div>
        <Label class="mb-2" for="password">Senha</Label>
        <Input id="password" type="password" placeholder="••••••••" />
      </div>

      <Button class="w-full mt-4">Entrar</Button>
    </form>

    <p class="mt-6 text-sm text-gray-500 text-center">
      Não tem conta?
      <a href="/sign-up" class="text-green-600 hover:underline">Cadastre-se</a>
    </p>
  </div>
</template>
