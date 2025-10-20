<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useColorMode } from '@vueuse/core';
import FlashMessages from '@/Layouts/Components/FlashMessages.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const mode = useColorMode();
</script>

<template>
  <div class="flex">
    <FlashMessages />
    <aside
      class="w-64 bg-white border-r-4 border-[#5AD598] text-black p-[24px] pdl-4 flex flex-col justify-content-evenly h-screen sticky top-0">
      <section id="header-top" class="h-fit">

        <h1 class="text-4xl font-bold mb-6 text-[#5AD598] justify-self-center">Nutriflow</h1>
        <div id="user-info" class="flex flex-col justify-center m-4">
          <div id="user-avatar" class="mb-4">
            <Avatar class="w-18 h-18 justify-self-center">
              <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
              <AvatarFallback>CN</AvatarFallback>
            </Avatar>
          </div>
          <div id="hello-user">
            <span>
              <slot name="user-greeting">
                Olá, Usuário
              </slot>
            </span>
          </div>
        </div>
      </section>

      <nav id="navigation" class="flex-1 space-y-4 m-4">
        <slot name="navigation-links" />
      </nav>

      <hr>
      <section id="header-bottom flex flex-col justify-content-evenly">

        <div id="upgrade-tag" class="bg-[#00B359] flex flex-col items-center p-3 rounded-lg text-white gap-[6px] mb-4">
          <span id="upgrade-title" class="font-bold">
            Melhore seu Plano
          </span>
          <span id="upgrade-trust">
            Desbloqueie análises, recursos avançados e IA.
          </span>
          <Link :href="route('plans.upgrade')" variant="outline" class="bg-[#49D18D] text-white p-1 rounded">
          Fazer Upgrade
          </Link>
        </div>

        <!-- <div id="dark-mode" class="min-w-full pl-3">
          <DropdownMenu>
            <DropdownMenuTrigger as-child>
              <Button variant="outline" class="flex items-center gap-2 ">
                <span class="relative flex items-center">
                  <Icon icon="radix-icons:moon"
                    class="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0" />
                  <Icon icon="radix-icons:sun"
                    class="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100" />
                </span>
                <span>Alterar tema</span>
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
              <DropdownMenuItem @click="mode = 'light'">
                Modo claro
              </DropdownMenuItem>
              <DropdownMenuItem @click="mode = 'dark'">
                Modo escuro
              </DropdownMenuItem>
              <DropdownMenuItem @click="mode = 'auto'">
                Manter aparência do sistema
              </DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>
        </div> -->

        <div id="profile" class="m-4">
          <Link :href="route('user.onboarding-form')" class="block hover:text-gray-200">Meu Perfil</Link>
          <Link :href="route('logout')" method="post" as="button" type="button" class="block hover:text-gray-200">
          Encerrar sessão</Link>
        </div>
      </section>
    </aside>

    <div class="flex-1 flex flex-col bg-[#e2e2e2] min-h-screen h-fit">
      <main class="flex-1 p-6">
        <slot />
      </main>

      <footer class="bg-gray-200 text-center p-4">
        © 2025 - Nutriflow. Todos os direitos reservados.
      </footer>
    </div>
  </div>
</template>