<script setup lang="ts">
import heroImage from '@/assets/images/landing-hero.png';
import { Button, Card, CardHeader, CardTitle, CardContent } from '@/components/ui/index';

import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

import PlansCards from '@/Layouts/Components/Plans/PlansCards.vue';

</script>
<template>
    <div class="font-sans text-gray-900 bg-white">
        <section class="bg-gradient-to-r from-[#5AD598] to-green-400 text-white">
            <div class="container mx-auto px-6 py-20 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-nowrap">
                        Nutriflow: Dietas Inteligentes com IA
                    </h1>
                    <p class="text-lg md:text-xl mb-6">
                        Transforme seus protocolos de dietas em insights práticos.
                    </p>
                    <h2 class="text-2xl md:text-3xl font-bold mb-4 text-nowrap">
                        Ideal para nutricionistas e pacientes!
                    </h2>
                    <ul>
                        <li>
                            <p class="text-lg md:text-xl mb-6">
                                Nutricionistas:
                                Crie protocolos de dieta personalizados e transforme seu acompanhamento em recomendações
                                inteligentes com base nos registros de seus pacientes.
                            </p>

                        </li>
                        <li>
                            <p class="text-lg md:text-xl mb-6">
                                Pacientes:
                                Acompanhe seu progresso diário e gere relatórios semanalmente incluindo pontos de
                                melhoria e pequenas vitórias!
                            </p>
                        </li>
                    </ul>
                    <div class="flex gap-4">
                        <Button variant="default" size="lg" as-child>
                            <Link :href="route('login.redirect')">
                            Começar Gratuitamente
                            </Link>
                        </Button>
                        <Button variant="outline" size="lg" class="text-black" as-child>
                            <a href="#planos">
                                Ver nossos planos
                            </a>
                        </Button>
                    </div>
                </div>
                <div class="max-w-2xl mx-auto space-y-6">
                    <Card>
                        <CardContent class="flex justify-center">
                            <img :src="heroImage" alt="Nutriflow IA" class="w-full max-w-md rounded-lg shadow-lg" />
                        </CardContent>
                    </Card>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-6">Por que escolher o Nutriflow?</h2>
                <p class="text-gray-700 mb-10 max-w-3xl mx-auto">
                    Nutriflow combina tecnologia de inteligência artificial e ciência da nutrição para oferecer soluções
                    precisas e personalizadas.
                    Analise o histórico de dietas, obtenha insights sobre consumo de macronutrientes e acompanhe a
                    hidratação diária de forma simples e eficiente.
                </p>
                <div class="grid md:grid-cols-3 gap-10">
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-[#5AD598]">IA Avançada</CardTitle>
                        </CardHeader>
                        <CardContent>
                            Receba recomendações automáticas com base nos dados que você registra e otimize suas dietas
                            sem esforço.
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-[#5AD598]">Protocolos Personalizados</CardTitle>
                        </CardHeader>
                        <CardContent>
                            Crie dietas adaptadas ao seu perfil, ajustando macronutrientes, calorias e hidratação
                            conforme suas metas.
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-[#5AD598]">Gráficos e Insights</CardTitle>
                        </CardHeader>
                        <CardContent>
                            Visualize dados detalhados, acompanhe sua evolução e identifique padrões para melhorar
                            resultados.
                        </CardContent>
                    </Card>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">Exemplo de Registro Diário</h2>

                <div class="hidden md:flex items-center justify-between space-x-6">
                    <div class="flex-1 bg-white p-6 rounded-lg shadow text-center">
                        <h3 class="font-bold text-lg mb-2">Crie a dieta</h3>
                        <p class="text-gray-600">Defina seus objetivos e monte seu plano alimentar.</p>
                    </div>
                    <div class="w-10 h-1 bg-green-500 rounded"></div>
                    <div class="flex-1 bg-white p-6 rounded-lg shadow text-center">
                        <h3 class="font-bold text-lg mb-2">Anote suas refeições</h3>
                        <p class="text-gray-600">Registre tudo que você consome diariamente.</p>
                    </div>
                    <div class="w-10 h-1 bg-green-500 rounded"></div>
                    <div class="flex-1 bg-white p-6 rounded-lg shadow text-center">
                        <h3 class="font-bold text-lg mb-2">Sistema analisa os dados</h3>
                        <p class="text-gray-600">O sistema calcula seus macros e calorias.</p>
                    </div>
                    <div class="w-10 h-1 bg-green-500 rounded"></div>
                    <div class="flex-1 bg-white p-6 rounded-lg shadow text-center">
                        <h3 class="font-bold text-lg mb-2">Acompanhe os resultados</h3>
                        <p class="text-gray-600">Veja gráficos e métricas do seu progresso.</p>
                    </div>
                    <div class="w-10 h-1 bg-green-500 rounded"></div>
                    <div class="flex-1 bg-white p-6 rounded-lg shadow text-center">
                        <h3 class="font-bold text-lg mb-2">Gere insights</h3>
                        <p class="text-gray-600">Receba recomendações personalizadas.</p>
                    </div>
                </div>

            </div>
        </section>
        <PlansCards />
        <section class="py-20 bg-[#5AD598] text-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Pronto para otimizar suas dietas com inteligência?
                </h2>
                <p class="mb-8 max-w-2xl mx-auto">
                    Comece hoje mesmo e transforme seus registros em resultados reais. Nutriflow simplifica a criação de
                    protocolos e análise de dados.
                </p>
                <Button variant="default" size="lg" as-child>
                    <Link :href="route('login.redirect')">
                    Começar Gratuitamente
                    </Link>
                </Button>
            </div>
        </section>

        <footer class="bg-gray-100 py-10 text-center text-gray-700">
            &copy; 2025 Nutriflow. Todos os direitos reservados.
        </footer>
    </div>

</template>
