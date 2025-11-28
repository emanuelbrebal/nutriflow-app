<script setup lang="ts">
import { watch, h, type Component } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { toast } from 'vue-sonner'
import { Toaster } from '@/components/ui/sonner'
import { CheckCircle2, Info, XCircle } from 'lucide-vue-next'

interface FlashData {
  success: string | null
  error: string | null
  message?: string | null
}

const page = usePage()

const renderIcon = (icon: Component, iconColor: string, bgColor: string) => {
  return h(
    'div',
    {
      class: `w-7 h-7 rounded-full flex items-center justify-center ${bgColor}`,
    },
    [h(icon, { class: `w-4 h-4 ${iconColor}` })]
  )
}

watch(
  () => page.props.flash as FlashData,
  (flash) => {
    if (!flash) return

    if (flash.success) {
      toast.success(flash.success, {
        icon: renderIcon(CheckCircle2, 'text-white', 'bg-green-600'),
        class:
          'border border-green-300/50 bg-green-50 text-green-800 font-medium shadow-md rounded-xl px-4 py-3 flex gap-3',
        duration: 3800,
      })
    }

    if (flash.error) {
      toast.error(flash.error, {
        icon: renderIcon(XCircle, 'text-red-700', 'bg-red-100'),
        class:
          'border border-red-300/60 bg-red-50 text-red-800 font-medium shadow-md rounded-xl px-4 py-3 flex gap-3',
        duration: 5000,
      })
    }

    if (flash.message) {
      toast.message(flash.message, {
        icon: renderIcon(Info, 'text-blue-700', 'bg-blue-100'),
        class:
          'border border-blue-300/60 bg-blue-50 text-blue-800 font-medium shadow-md rounded-xl px-4 py-3 flex gap-3',
        duration: 4000,
      })
    }
  },
  { deep: true, immediate: true }
)
</script>

<template>
  <Toaster 
    position="top-center"
    closeButton
    :toast-options="{
      class: 'rounded-xl border p-4 shadow-sm flex items-center gap-3 backdrop-blur-md',
      style: { fontSize: '0.95rem' }
    }"
  />
</template>