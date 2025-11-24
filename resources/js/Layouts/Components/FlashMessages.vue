<script setup lang="ts">
import { watch, h } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { toast } from 'vue-sonner'
import { Toaster } from '@/components/ui/sonner'
import { CheckCircle2, AlertCircle, Info } from 'lucide-vue-next'

interface FlashData {
  success: string | null
  error: string | null
  message?: string | null
}

const page = usePage()

const renderIcon = (icon: any, colorClass: string) => {
  return h(icon, { class: `w-5 h-5 ${colorClass}` })
}

watch(
  () => page.props.flash as FlashData,
  (flash) => {
    if (!flash) return

    if (flash.success) {
      toast.success(flash.success, {
        icon: renderIcon(CheckCircle2, 'text-white'),
        class: '!bg-green-600 !border-green-700 !text-white font-medium shadow-lg',
        duration: 4000,
      })
    }

    if (flash.error) {
      toast.error(flash.error, {
        icon: renderIcon(AlertCircle, 'text-white'),
        class: '!bg-red-600 !border-red-700 !text-white font-medium shadow-lg',
        duration: 5000,
      })
    }
    
    if (flash.message) {
      toast.message(flash.message, {
        icon: renderIcon(Info, 'text-blue-600'),
        class: '!bg-white !border-blue-100 !text-gray-800 font-medium shadow-lg border-l-4 !border-l-blue-500',
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
      class: 'rounded-lg border-0 p-4 flex items-center gap-3',
      style: {
        fontSize: '0.95rem',
      }
    }"
  />
</template>