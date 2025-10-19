<script setup>
import { computed, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const success = computed(() => page.props.flash?.success || null);
const error = computed(() => page.props.flash?.error || null);

watch([success, error], () => {
  if (success.value || error.value) {
    setTimeout(() => {
      if (success.value) {
        page.props.flash.success = null;
      }
      if (error.value) {
        page.props.flash.error = null;
      }
    }, 5000);
  }
});
</script>

<template>
  <div class="fixed top-6 right-6 z-50 w-full max-w-sm">

    <Transition name="fade">
      <div v-if="success" class="p-4 mb-4 rounded-lg shadow-xl bg-green-600 text-white">
        {{ success }}
      </div>
    </Transition>

    <Transition name="fade">
      <div v-if="error" class="p-4 rounded-lg shadow-xl bg-red-600 text-white">
        {{ error }}
      </div>
    </Transition>

  </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-enter-to,
.fade-leave-from {
  opacity: 1;
}
</style>