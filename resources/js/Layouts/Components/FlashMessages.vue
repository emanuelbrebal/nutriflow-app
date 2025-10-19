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
  <Transition name="fade">
    <div v-if="success" class="alert alert-success">
      {{ success }}
    </div>
  </Transition>

  <Transition name="fade">
    <div v-if="error" class="alert alert-danger">
      {{ error }}
    </div>
  </Transition>
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