<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

// Lucide icons
import {
    BookOpen,
    Plus,
    Eye,
    Pencil
} from 'lucide-vue-next'

const props = defineProps({
    prestamos: Array
})
</script>

<template>
    <Head title="Préstamos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center gap-2">
                <BookOpen class="w-6 h-6" />
                Gestión de Préstamos
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <!-- Botón crear -->
                <div class="flex justify-end mb-4">
                    <Link
                        href="/prestamos/create"
                        class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                    >
                        <Plus class="w-4 h-4" />
                        Nuevo Préstamo
                    </Link>
                </div>

                <!-- Tabla -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Libro
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Usuario
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Fecha préstamo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Estado
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="prestamo in prestamos" :key="prestamo.id_prestamo">
                                    <td class="px-6 py-4">
                                        {{ prestamo.libro?.titulo ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ prestamo.user?.name ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ prestamo.fecha_prestamo }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            v-if="prestamo.fecha_devolucion_real"
                                            class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold"
                                        >
                                            Devuelto
                                        </span>

                                        <span
                                            v-else
                                            class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold"
                                        >
                                            Pendiente
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right space-x-3">
                                        <Link
                                            :href="`/prestamos/${prestamo.id_prestamo}`"
                                            class="inline-flex items-center gap-1 text-blue-600 hover:underline"
                                        >
                                            <Eye class="w-4 h-4" />
                                            Ver
                                        </Link>

                                        <Link
                                            :href="`/prestamos/${prestamo.id_prestamo}/edit`"
                                            class="inline-flex items-center gap-1 text-indigo-600 hover:underline"
                                        >
                                            <Pencil class="w-4 h-4" />
                                            Editar
                                        </Link>
                                    </td>
                                </tr>

                                <tr v-if="prestamos.length === 0">
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No hay préstamos registrados
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
