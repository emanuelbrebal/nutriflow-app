<template>
  <div class="min-h-screen w-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 rounded-xl shadow-lg overflow-hidden bg-white">

      <div class="hidden md:flex items-center justify-center bg-gradient-to-br from-green-500 to-emerald-600 relative">

        <div class="relative z-10 text-white p-6 max-w-md">
          <h1 class="text-3xl font-bold">Nutriflow</h1>
          <p class="mt-2">Organize sua nutrição de forma prática e inteligente.</p>
        </div>
      </div>

      <div class="flex flex-col justify-center p-10">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

</script>
