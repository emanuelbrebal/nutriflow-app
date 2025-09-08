<template>
  <div class="min-h-screen w-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-4xl flex flex-col bg-white rounded-xl shadow-lg">
      <main class="flex-1 p-8">
        <slot />
      </main>

      <footer class="bg-gray-50 text-center text-sm text-gray-500 py-4 border-t">
        © 2025 - Nutriflow. Todos os direitos reservados.
      </footer>
    </div>
  </div>
</template>

<script setup lang="ts">
</script>
