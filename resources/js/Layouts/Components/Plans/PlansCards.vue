<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
<template>

    <section id="planos" class="bg-gray-50 py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">
                Nossos Planos
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4 text-center">Básico</h3>
                    <p class="text-gray-600 mb-6 text-center">Ideal para começar sua jornada nutricional.</p>
                    <div class="text-4xl font-extrabold text-center mb-6">Gratuito</div>
                    <ul class="text-gray-600 mb-6 space-y-2">
                        <li>✅ Criação de dieta personalizada</li>
                        <li>✅ Registro de refeições</li>
                        <li>✅ Acompanhamento básico</li>
                    </ul>

                    <Link :href="route('login.redirect')"
                        class="w-full bg-gray-800 hover:bg-black text-white p-2 rounded transition">
                    Começar Gratuitamente
                    </Link>
                </div>

                <div
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 border-2 border-green-500">
                    <h3 class="text-xl font-bold mb-4 text-center">Intermediário</h3>
                    <p class="text-gray-600 mb-6 text-center">Para quem quer resultados mais detalhados.</p>
                    <div class="text-4xl font-extrabold text-center mb-6">R$49<span
                            class="text-lg font-medium">/mês</span></div>
                    <ul class="text-gray-600 mb-6 space-y-2">
                        <li>✅ Todos recursos do Básico</li>
                        <li>✅ Análise avançada de refeições</li>
                        <li>✅ Relatórios semanais</li>
                        <li>✅ Dicas personalizadas</li>
                    </ul>
                    <Link :href="route('plans.payment')"
                        class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600 transition">
                    Assinar Plano
                    </Link>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4 text-center">Premium</h3>
                    <p class="text-gray-600 mb-6 text-center">O plano completo para transformar sua alimentação.</p>
                    <div class="text-4xl font-extrabold text-center mb-6">R$79<span
                            class="text-lg font-medium">/mês</span></div>
                    <ul class="text-gray-600 mb-6 space-y-2">
                        <li>✅ Todos recursos do Intermediário</li>
                        <li>✅ Consultoria nutricional online</li>
                        <li>✅ Acesso a insights avançados</li>
                        <li>✅ Monitoramento diário personalizado</li>
                    </ul>
                    <Link :href="route('plans.payment')"
                        class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600 transition">
                    Assinar Plano
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>