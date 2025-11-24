<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import UnlinkNutritionist from './modals/UnlinkNutritionist.vue';

const props = defineProps({
  nutritionist: {
    type: Object,
    required: true
  }
});
console.log(props.nutritionist)
</script>

<template>
  <div class="w-full flex flex-row items-center gap-4 rounded-xl shadow-sm border border-gray-100 bg-white p-6 mb-4">
    <div>
      <Avatar class="w-18 h-18 justify-self-center ">
        <AvatarImage :src="props.nutritionist.user.profile_picture_path ? `/storage/${props.nutritionist.user.profile_picture_path}` : ''" :alt="nutritionist.user.name"
          class="object-cover border-[#5AD598] border-2" />
        <AvatarFallback>
          {{ nutritionist.user.name.substring(0, 2).toUpperCase() }}
        </AvatarFallback>
      </Avatar>
    </div>
    <div class="flex-1">
      <p class="text-xs font-semibold text-green-600 uppercase tracking-wide">Seu nutricionista</p>

      <h3 class="text-xl font-bold text-gray-800">
        Dr(a). {{ nutritionist.user?.name }}
      </h3>

      <p class="text-sm text-gray-600 mt-1">
        Especialidade: <span class="font-medium text-gray-900">{{ nutritionist.specialty }}</span>
      </p>

      <p class="text-sm text-gray-500">
        CRN: {{ nutritionist.crn }}
      </p>
    </div>

    <div class="flex gap-2">
      <UnlinkNutritionist />
    </div>
  </div>
</template>