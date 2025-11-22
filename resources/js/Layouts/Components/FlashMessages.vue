<script setup lang="ts">
import { watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { toast } from 'vue-sonner'
import { Toaster } from '@/components/ui/sonner'

interface FlashData {
  success: string | null
  error: string | null
}

const page = usePage<any>()

watch(
  () => page.props.flash as FlashData,
  (flash) => {
    if (!flash) return

    if (flash.success) {
      toast.success(flash.success, {
        class: '!bg-green-600 !text-white !border-green-600 font-bold',
        duration: 4000
      })
    }

    if (flash.error) {
      toast.error(flash.error, {
        class: '!bg-red-600 !text-white !border-red-600 font-bold',
        duration: 4000
      })
    }
  },
  { deep: true, immediate: true }
)
</script>

<template>
  <Toaster position="top-right" closeButton/>
</template>