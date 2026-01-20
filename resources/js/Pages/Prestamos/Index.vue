<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { ref, reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'

// Lucide Icons
import { BookOpen, Plus, Eye, Pencil, X, Save } from 'lucide-vue-next'

// Props
const props = defineProps({
    prestamos: Array,
    libros: Array,
    users: Array
})

// Modal control
const showModal = ref(false)
const isEditing = ref(false) // para saber si estamos editando
const editarId = ref(null)   // id del préstamo a editar

// Lista de préstamos reactiva
const prestamosList = ref([...props.prestamos])

// Formulario reactivo
const form = useForm({
    libro_id: '',
    user_id: '',
    fecha_prestamo: '',
    fecha_devolucion_esperada: '',
    fecha_devolucion_real: ''
})

// Abrir modal para crear
const abrirModalCrear = () => {
    isEditing.value = false
    editarId.value = null
    form.reset()
    showModal.value = true
}

// Abrir modal para editar
const abrirModalEditar = (prestamo) => {
    isEditing.value = true
    editarId.value = prestamo.id_prestamo
    form.libro_id = prestamo.libro?.id_libro ?? ''
    form.user_id = prestamo.user?.id ?? ''
    form.fecha_prestamo = prestamo.fecha_prestamo
    form.fecha_devolucion_esperada = prestamo.fecha_devolucion_esperada
    form.fecha_devolucion_real = prestamo.fecha_devolucion_real
    showModal.value = true
}

// Guardar o actualizar préstamo
const submit = async () => {
    if (isEditing.value) {
        // Editar
        const res = await form.put(`/prestamos/${editarId.value}`)
        if (res.data.prestamoActualizado) {
            const index = prestamosList.value.findIndex(p => p.id_prestamo === editarId.value)
            prestamosList.value[index] = res.data.prestamoActualizado
        }
    } else {
        // Crear
        const res = await form.post(`/prestamos`)
        if (res.data.prestamoNuevo) {
            prestamosList.value.unshift(res.data.prestamoNuevo)
        }
    }
    form.reset()
    showModal.value = false
}
</script>

<template>
  <Head title="Préstamos" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
        <BookOpen class="w-6 h-6" />
        Gestión de Préstamos
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

        <!-- Botón Nuevo -->
        <div class="flex justify-end mb-4">
          <button @click="abrirModalCrear" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            <Plus class="w-4 h-4" />
            Nuevo Préstamo
          </button>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
          <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <button @click="showModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
              <X class="w-5 h-5" />
            </button>

            <h3 class="text-lg font-semibold text-gray-700 mb-4">
              {{ isEditing ? 'Editar préstamo' : 'Registrar préstamo' }}
            </h3>

            <form @submit.prevent="submit" class="space-y-4">
              <!-- Libro -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Libro</label>
                <select v-model="form.libro_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                  <option value="">Seleccione un libro</option>
                  <option v-for="libro in libros" :key="libro.id_libro" :value="libro.id_libro">
                    {{ libro.titulo }}
                  </option>
                </select>
              </div>

              <!-- Usuario -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Usuario</label>
                <select
                  v-model="form.user_id"
                  class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >
                  <option value="">Seleccione un usuario</option>

                  <option
                    v-for="user in users"
                    :key="user.id"
                    :value="user.id"
                  >
                    {{ user.nombre }} {{ user.apellido_paterno }} {{ user.apellido_materno }}
                  </option>
                </select>
              </div>

              <!-- Fechas -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700">Fecha préstamo</label>
                  <input v-model="form.fecha_prestamo" type="date" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700">Fecha devolución esperada</label>
                  <input v-model="form.fecha_devolucion_esperada" type="date" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" />
                </div>
              </div>

              <!-- Botones -->
              <div class="flex justify-end gap-2 mt-4">
                <button type="button" @click="showModal = false" class="inline-flex items-center gap-2 px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                  <X class="w-4 h-4" /> Cancelar
                </button>
                <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition" :disabled="form.processing">
                  <Save class="w-4 h-4" /> Guardar
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Tabla -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 mt-6">
          <div class="p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Libro</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha préstamo</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                  <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr v-for="prestamo in prestamosList" :key="prestamo.id_prestamo">
                  <td class="px-6 py-4">{{ prestamo.libro?.titulo ?? '—' }}</td>
                  <td>
                    {{ prestamo.user?.nombre }}
                    {{ prestamo.user?.apellido_paterno }}
                    {{ prestamo.user?.apellido_materno }}
                  </td>
                  <td class="px-6 py-4">{{ prestamo.fecha_prestamo }}</td>
                  <td class="px-6 py-4">
                    <span v-if="prestamo.fecha_devolucion_real" class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                      Devuelto
                    </span>
                    <span v-else class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">
                      Pendiente
                    </span>
                  </td>
                  <td class="px-6 py-4 text-right space-x-3">
                    <button @click="abrirModalEditar(prestamo)" class="inline-flex items-center gap-1 text-indigo-600 hover:underline">
                      <Pencil class="w-4 h-4" /> Editar
                    </button>
                  </td>
                </tr>
                <tr v-if="prestamosList.length === 0">
                  <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay préstamos registrados</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
