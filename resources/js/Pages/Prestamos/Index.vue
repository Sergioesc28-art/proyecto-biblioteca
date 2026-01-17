<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// El componente de Heroicons (si lo instalaste) o lo dejamos simple por ahora
</script>

<template>
    <Head title="Gestión de Préstamos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">📋 Control de Préstamos</h2>
        </template>

        <div class="py-12 bg-gray-100">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-medium text-gray-700">Filtrar por Semestre:</label>
                        <select class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option>Enero - Junio 2026</option>
                            <option>Julio - Diciembre 2025</option>
                        </select>
                    </div>
                    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition">
                        + Registrar Préstamo
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Usuario</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Libro</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha Salida</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Estado / Semanas</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-red-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Sergio España</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Don Quijote de la Mancha</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Oct 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Atrasado (+12 semanas)
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900">Devolver</button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-orange-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Juan Pérez</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cálculo Vectorial</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">01 Dic 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            Pendiente (7 semanas)
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900">Devolver</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>