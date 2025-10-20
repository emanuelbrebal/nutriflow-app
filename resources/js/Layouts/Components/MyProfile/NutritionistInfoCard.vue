<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
</script>

<template>
  <div class="w-full flex flex-row items-center gap-4 rounded shadow bg-white p-6">
    
    <div>
      <Avatar class="w-20 h-20">
        <AvatarImage src="https://github.com/shadcn.png" alt="Foto do Nutricionista" />
        <AvatarFallback>ND</AvatarFallback>
      </Avatar>
    </div>
    
    <div class="flex-1">
      <p class="text-sm text-gray-500">Seu nutricionista</p>
      <h3 class="text-xl font-bold text-gray-800">
        Dr. Nome do Nutricionista
      </h3>
      <p class="text-sm text-gray-700">
        Especialidade (Ex: Nutrição Esportiva)
      </p>
      <p classs="text-sm text-gray-500">
        CRN: 12345/P
      </p>
    </div>

    <div>
      <Button variant="outline">
        Enviar Mensagem
      </Button>
    </div>

  </div>
</template>