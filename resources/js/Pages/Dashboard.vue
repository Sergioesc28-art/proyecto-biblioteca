<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// Recibimos los datos del controlador
const props = defineProps({
    stats: {
        type: Object,
        default: () => ({ listaStock: [] }) // Esto evita que sea undefined
    }
});
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
                    
                    <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Libros Monitoreados</p>
                                <p class="text-lg font-bold text-gray-900">Stock Actual</p>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-full text-blue-600 text-2xl">📖</div>
                        </div>
                        <ul class="mt-2 text-xs text-gray-600">
                            <li v-for="libro in stats.listaStock" :key="libro.titulo" class="flex justify-between">
                                <span>{{ libro.titulo }}:</span>
                                <span class="font-bold text-blue-600">{{ libro.stock }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Género más visitado</p>
                                <p class="text-2xl font-bold text-gray-900">{{ stats.genero }}</p>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-full text-purple-600 text-2xl">👻</div>
                        </div>
                        <p class="mt-2 text-xs text-purple-600 font-semibold">Tendencia del semestre</p>
                    </div>

                    <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Libro Estrella</p>
                                <p class="text-sm font-bold text-gray-900">{{ stats.libroMas }}</p>
                            </div>
                            <div class="p-3 bg-orange-100 rounded-full text-orange-600 text-2xl">🔖</div>
                        </div>
                        <p class="text-xs text-orange-600 mt-2 font-semibold">El favorito de los lectores</p>
                    </div>

                 <div class="p-5 bg-white rounded-xl shadow-sm border-t-4 border-gray-400">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase">Menos Buscado</p>
                                <p class="text-sm font-bold text-gray-900">{{ stats.libroMenos }}</p>
                            </div>
                            <div class="p-3 bg-gray-100 rounded-full text-gray-600 text-2xl">📉</div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Requiere más promoción</p>
                    </div>
                </div>

                <div class="mb-8 p-6 bg-gradient-to-r from-green-600 to-green-500 rounded-2xl shadow-lg text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="bg-white/20 p-4 rounded-full text-4xl">🏆</div>
                            <div>
                                <h3 class="text-xl font-bold opacity-90 uppercase tracking-wider">Lector Estrella del Semestre</h3>
                                <p class="text-4xl font-black mt-1">{{ stats.usuarioTop }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-5xl font-bold">{{ stats.totalPrestamos }}</p>
                            <p class="text-sm uppercase font-bold opacity-80">Préstamos Totales</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-xl border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 italic mb-4">📍 Reporte de Origen y Autoría</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <p class="text-gray-600">Nacionalidad predominante:</p>
                                <p class="text-xl font-bold text-blue-800">{{ stats.pais }}</p>
                            </div>
                            <div class="p-4 bg-green-50 rounded-lg">
                                <p class="text-gray-600">Autor con más libros:</p>
                                <p class="text-xl font-bold text-green-800">{{ stats.autor }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>