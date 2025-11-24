<script setup lang="ts">
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    PinInput,
    PinInputGroup,
    PinInputSlot,
} from '@/components/ui/pin-input';
import { router } from '@inertiajs/vue3';
import { Link2, AlertCircle } from 'lucide-vue-next'; 
import { route } from 'ziggy-js';

const props = defineProps({
    userCode: {
        type: String,
        required: true
    }
});

const nutriCode = ref<string[]>([])

const handleLink = () => {
    const codeString = nutriCode.value.join('');

    router.post(route('user.link-nutritionist.post'), {
        code: codeString
    }, {
        preserveScroll: true,
        onSuccess: () => {
            nutriCode.value = [];
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
};

const handleComplete = (e: string[]) => {
    // Opcional: Pode focar no botão ou auto-enviar quando completar
    // console.log(e.join(''))
}
</script>

<template>
    <div class="flex flex-col gap-6 w-full mb-4">

        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 flex items-start gap-3 shadow-sm">
            <div class="mt-0.5 p-1 bg-amber-100 rounded-full text-amber-600">
                <AlertCircle class="w-5 h-5" />
            </div>
            <div>
                <h3 class="font-bold text-amber-900 text-sm">
                    Você ainda não possui nenhum nutricionista vinculado!
                </h3>
                <p class="text-amber-800 text-sm mt-1 leading-relaxed">
                    Por favor, siga os passos abaixo para liberar seu acesso completo:
                </p>
            </div>
        </div>

        <div class="w-full bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="flex flex-col md:flex-row min-h-[200px]">
                <div
                    class="w-full md:w-1/3 bg-gray-50 p-6 flex flex-col justify-center items-center text-center border-b md:border-b-0 md:border-r border-gray-200 relative group">
                    <div class="absolute inset-0 bg-grid-slate-100 dark:bg-grid-slate-700/25"></div>

                    <div class="relative z-10 flex flex-col items-center">
                        <div class="p-3 bg-white shadow-sm rounded-full mb-3 text-green-600">
                            <Link2 :size="24" />
                        </div>
                        <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2">
                            Seu Código de Acesso
                        </h4>

                        <div class="bg-white border border-gray-200 px-6 py-2 rounded-lg shadow-sm">
                            <span class="text-3xl font-black text-gray-800 tracking-widest font-mono select-all">
                                {{ userCode }}
                            </span>
                        </div>

                        <p class="text-xs text-gray-400 mt-4 px-2 max-w-[200px]">
                            Compartilhe este código com seu nutricionista para que ele te vincule.
                        </p>

                    </div>
                </div>

                <div
                    class="w-full md:w-2/3 p-8 flex flex-col justify-center items-center md:items-start gap-6 bg-white">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Vincular Nutricionista</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Se você já tem o código do seu profissional, digite abaixo:
                        </p>
                    </div>

                    <div class="w-full flex justify-center gap-1">
                        <PinInput id="pin-input" v-model="nutriCode" placeholder="○" class="flex gap-2 items-center"
                            @complete="handleComplete">
                            <PinInputGroup>
                                <PinInputSlot v-for="(id, index) in 6" :key="id" :index="index"
                                    class="flex gap-3 w-12 h-14 text-xl border-gray-300 focus:border-green-500 rounded-md bg-gray-50" />
                            </PinInputGroup>
                        </PinInput>
                    </div>

                    <div class="w-full flex md:justify-end justify-center">
                        <Button
                            class="w-full md:w-auto min-w-[150px] bg-green-600 hover:bg-green-700 text-white font-bold transition-all"
                            @click="handleLink" :disabled="nutriCode.length < 6">
                            Vincular Agora
                        </Button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>