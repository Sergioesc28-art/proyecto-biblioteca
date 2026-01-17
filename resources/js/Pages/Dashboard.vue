<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Panel de Biblioteca" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-blue-900">
                📚 Sistema de Gestión de Biblioteca
            </h2>
        </template>

        <div class="py-12 bg-gray-50">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
                    
                    <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-blue-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Libros en Stock</p>
                                <p class="text-2xl font-bold text-gray-900">450</p>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-full text-blue-600 text-2xl">📖</div>
                        </div>
                        <p class="mt-2 text-xs text-blue-600 font-semibold">4 libros en nivel crítico</p>
                    </div>

                    <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-purple-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Género más visitado</p>
                                <p class="text-2xl font-bold text-gray-900">Terror</p>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-full text-purple-600 text-2xl">👻</div>
                        </div>
                        <p class="mt-2 text-xs text-purple-600 font-semibold">+12% este semestre</p>
                    </div>

                    <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-red-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Deudores Críticos</p>
                                <p class="text-2xl font-bold text-gray-900">12</p>
                            </div>
                            <div class="p-3 bg-red-100 rounded-full text-red-600 text-2xl">⚠️</div>
                        </div>
                        <p class="text-xs text-red-600 mt-2 font-semibold">+10 semanas de retraso</p>
                    </div>

                    <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-orange-500 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Libros Prestados</p>
                                <p class="text-2xl font-bold text-gray-900">85</p>
                            </div>
                            <div class="p-3 bg-orange-100 rounded-full text-orange-600 text-2xl">🔖</div>
                        </div>
                        <p class="text-xs text-orange-600 mt-2 font-semibold">Total del semestre</p>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-xl border border-gray-200">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-800 italic">Reporte General del Semestre</h3>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">Ver todos los préstamos</button>
                        </div>
                        <div class="h-64 flex items-center justify-center border-2 border-dashed border-gray-200 rounded-lg bg-gray-50 text-gray-400">
                            Próximamente: Gráfico de libros más prestados y Tabla de Deudores
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>