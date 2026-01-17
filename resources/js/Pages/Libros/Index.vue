<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// Aquí definiremos los datos que vendrán de la base de datos más adelante
const props = defineProps(['libros']);
</script>

<template>
    <Head title="Inventario de Libros" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">📚 Inventario de Libros</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        + Agregar Nuevo Libro
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Autor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4">Cien años de soledad</td>
                                    <td class="px-6 py-4">Gabriel García Márquez</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">15 unidades</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-blue-600 hover:underline">Editar</button>
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