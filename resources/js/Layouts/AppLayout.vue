<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import FlashMessages from '@/Layouts/Components/FlashMessages.vue';
import { computed } from 'vue';


const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
    <FlashMessages />
  </div>

  <div class="flex">
    <aside
      class="w-64 bg-white border-r-4 border-[#5AD598] text-black p-6 pdl-4 flex flex-col justify-content-evenly h-screen sticky top-0">
      <section id="header-top" class="h-fit">

        <h1 class="text-4xl font-bold mb-6 text-[#5AD598] justify-self-center">Nutriflow</h1>
        <div id="user-info" class="flex flex-col justify-center m-4">
          <div id="user-avatar" class="mb-4">
            <Avatar class="w-18 h-18 justify-self-center ">
              <AvatarImage :src="user.profile_picture_path ? `/storage/${user.profile_picture_path}` : ''"
                :alt="user.name" class="object-cover border-[#5AD598] border-2"/>
              <AvatarFallback>
                {{ user.name.substring(0, 2).toUpperCase() }}
              </AvatarFallback>
            </Avatar>
          </div>
          <div id="hello-user">
            <span>
              <slot name="user-greeting" />
            </span>
          </div>
        </div>
      </section>

      <nav id="navigation" class="flex-1 space-y-4 m-4">
        <slot name="navigation-links" />
      </nav>

      <hr>
      <section id="header-bottom" class="flex flex-col justify-content-evenly">
        <div id="upgrade-tag" class="bg-[#00B359] flex flex-col items-center p-3 rounded-lg text-white gap-[6px] mb-4">
          <span id="upgrade-title" class="font-bold">
            Melhore seu Plano
          </span>
          <span id="upgrade-trust">
            Desbloqueie análises, recursos avançados e IA.
          </span>
          <Link :href="route('plans.upgrade')"
            class="bg-[#49D18D] text-white p-1 rounded hover:bg-[#3db376] transition">
          Fazer Upgrade
          </Link>
        </div>

        <div id="profile" class="m-4">
          <Link :href="route('user.my-profile')" class="block hover:text-gray-500 transition">Meu Perfil</Link>
          <Link :href="route('logout')" method="post" as="button" type="button"
            class="block hover:text-gray-500 transition mt-2">
          Encerrar sessão
          </Link>
        </div>
      </section>
    </aside>

    <div class="flex-1 flex flex-col bg-[#e2e2e2] min-h-screen h-fit">

      <main class="flex-1 p-6">
        <slot />
      </main>

      <footer class="bg-gray-200 text-center p-4 text-sm text-gray-600">
        © 2025 - Nutriflow. Todos os direitos reservados.
      </footer>
    </div>
  </div>
</template>