<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { BookOpen, User, Package, Settings, BarChart3, Edit, Pencil } from 'lucide-vue-next';

const props = defineProps<{
    libros: Libro[]
    autores: Autor[]
    paises: Pais[]
    generos: Genero[]
    libroedit?: Libro
}>();

const showModal = ref(false);
const showEditModal = ref(false);
const activeTab = ref<'libro' | 'autor'>('libro');
const selectedLibro = ref<Libro | null>(null);

const form = useForm({
    titulo: '',
    autor_id: '',
    genero_id: '',
    stock: 1,
});

const editForm = useForm({
    titulo: '',
    autor_id: '',
    genero_id: '',
    stock: 1,
});

const autorForm = useForm({
    nombre: '',
    pais_id: '',
});

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    activeTab.value = 'libro';
    form.reset();
    form.clearErrors();
    autorForm.reset();
    autorForm.clearErrors();
};

const openEditModal = (libro: Libro) => {
    selectedLibro.value = libro;
    editForm.titulo = libro.titulo;
    editForm.autor_id = libro.autor_id ? String(libro.autor_id) : '';
    editForm.genero_id = libro.genero_id ? String(libro.genero_id) : '';
    editForm.stock = libro.stock;
    showEditModal.value = true;
};

const closeEditModal = () => {
    showEditModal.value = false;
    selectedLibro.value = null;
    editForm.reset();
    editForm.clearErrors();
};

const submit = () => {
    form.post(route('libros.store'), {
        onSuccess: closeModal,
    });
};

const submitEdit = () => {
    if (!selectedLibro.value) return;
    editForm.put(route('libros.update', selectedLibro.value.id_libro), {
        onSuccess: closeEditModal,
    });
};

const submitAutor = () => {
    autorForm.post(route('autores.store'), {
        onSuccess: () => {
            autorForm.reset();
            autorForm.clearErrors();
            activeTab.value = 'libro';
        },
    });
};


interface Libro {
    id_libro: number;
    titulo: string;
    autor: string;
    autor_id?: number;
    genero_id?: number;
    stock: number;
}


interface Autor {
    id_autor: number;
    nombre: string;
    pais: string;
}

interface Genero {
    id_genero: number;
    nombre: string;
}

interface Pais {
    id_pais: number;
    nombre: string;
}

</script>

<template>
    <Head title="Inventario de Libros" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-center gap-3">
                <BookOpen :size="32" class="text-blue-900" />
                <h2 class="text-center text-3xl font-bold leading-tight text-blue-900">Inventario de Libros</h2>
                <User :size="32" class="text-blue-900" />
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-center mb-4">
                    <button
                        class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition"
                        @click="openModal"
                    >
                        Agregar Libro / Autor
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        <div class="flex items-center gap-2">
                                            <BookOpen :size="16" />
                                            Título
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        <div class="flex items-center gap-2">
                                            <Pencil :size="16" />
                                            Autor
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        <div class="flex items-center gap-2">
                                            <Package :size="16" />
                                            Stock
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        <div class="flex items-center justify-end gap-2">
                                            <Settings :size="16" />
                                            Acciones
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="libro in libros" :key="libro.id_libro" class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ libro.titulo }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ libro.autor }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                            <BarChart3 :size="14" />
                                            {{ libro.stock }} unidades
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button @click="openEditModal(libro)" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                            <Edit :size="16" />
                                            Editar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
            <div class="w-full max-w-5xl rounded-xl bg-white shadow-2xl overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Lado izquierdo - Imagen -->
                    <div class="hidden md:block bg-white p-8">
                        <div class="h-full flex flex-col items-center justify-center">
                            <img
                                v-if="activeTab === 'libro'"
                                src="/addbook.png"
                                alt="Agregar libro"
                                class="w-full h-auto object-contain rounded-lg shadow-lg"
                            />
                            <img
                                v-else
                                src="/addbook.png"
                                alt="Agregar autor"
                                class="w-full h-auto object-contain rounded-lg shadow-lg"
                            />
                            <p class="text-blue-900 text-center mt-6 text-lg font-semibold">
                                {{ activeTab === 'libro' ? 'Expandir la colección' : 'Agregar nuevo autor' }}
                            </p>
                        </div>
                    </div>

                    <!-- Lado derecho - Tabs y Formulario -->
                    <div class="p-6 md:p-8">
                        <div class="relative flex items-center mb-6">
                            <h3 class="absolute left-1/2 -translate-x-1/2 text-2xl font-bold text-blue-900">
                                {{ activeTab === 'libro' ? 'Agregar un libro' : 'Agregar un autor' }}
                            </h3>
                            <button class="ml-auto text-gray-500 hover:text-gray-700 text-2xl" @click="closeModal">✕</button>
                        </div>

                        <!-- Tabs -->
                        <div class="flex justify-center space-x-8 mb-6 border-b border-gray-300 pb-2">
                            <button
                                @click="activeTab = 'libro'"
                                :class="{
                                    'text-blue-900 font-bold border-b-2 border-blue-900 pb-2': activeTab === 'libro',
                                    'text-gray-600 hover:text-gray-800': activeTab !== 'libro'
                                }"
                                class="px-4 py-2 text-sm transition-colors inline-flex items-center gap-2"
                            >
                                <BookOpen :size="18" />
                                Libro
                            </button>
                            <button
                                @click="activeTab = 'autor'"
                                :class="{
                                    'text-blue-900 font-bold border-b-2 border-blue-900 pb-2': activeTab === 'autor',
                                    'text-gray-600 hover:text-gray-800': activeTab !== 'autor'
                                }"
                                class="px-4 py-2 text-sm transition-colors inline-flex items-center gap-2"
                            >
                                <Pencil :size="18" />
                                Autor
                            </button>
                        </div>

                        <!-- Tab: Agregar Libro -->
                        <form v-if="activeTab === 'libro'" @submit.prevent="submit" class="space-y-4">
                            <!-- Campo: Título -->
                            <div>
                                <label class="block text-center font-semibold text-gray-700 mb-2">Título</label>
                                <input
                                    v-model="form.titulo"
                                    type="text"
                                    placeholder="Ingresa el título"
                                    class="w-full text-center rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                                    required
                                />
                                <p v-if="form.errors.titulo" class="mt-1 text-sm text-red-600">{{ form.errors.titulo }}</p>
                            </div>

                            <!-- Campos: Autor y Género -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-center font-semibold text-gray-700 mb-2">Autor</label>
                                    <select
                                        v-model="form.autor_id"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                                        required
                                    >
                                        <option disabled value="">Selecciona un autor</option>
                                        <option v-for="autor in autores" :key="autor.id_autor" :value="autor.id_autor">
                                            {{ autor.nombre }}
                                        </option>
                                    </select>
                                    <p v-if="form.errors.autor_id" class="mt-1 text-sm text-red-600">{{ form.errors.autor_id }}</p>
                                </div>

                                <div>
                                    <label class="block text-center font-semibold text-gray-700 mb-2">Género</label>
                                    <select
                                        v-model="form.genero_id"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                                        required
                                    >
                                        <option disabled value="">Selecciona un género</option>
                                        <option v-for="genero in generos" :key="genero.id_genero" :value="genero.id_genero">
                                            {{ genero.nombre }}
                                        </option>
                                    </select>
                                    <p v-if="form.errors.genero_id" class="mt-1 text-sm text-red-600">{{ form.errors.genero_id }}</p>
                                </div>
                            </div>

                            <!-- Campo: Stock -->
                            <div>
                                <label class="block text-center font-semibold text-gray-700 mb-2">Cantidad en Stock</label>
                                <input
                                    v-model="form.stock"
                                    type="number"
                                    min="0"
                                    placeholder="Ej: 10"
                                    class="w-full text-center rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                                    required
                                />
                                <p v-if="form.errors.stock" class="mt-1 text-sm text-red-600">{{ form.errors.stock }}</p>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="flex justify-center gap-4 pt-4">
                                <button
                                    type="button"
                                    class="px-6 py-2 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold transition"
                                    @click="closeModal"
                                >
                                    Cancelar
                                </button>
                                <button
                                    type="submit"
                                    class="px-6 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold transition disabled:opacity-50"
                                    :disabled="form.processing"
                                >
                                    {{ form.processing ? 'Guardando...' : 'Guardar' }}
                                </button>
                            </div>
                        </form>

                        <!-- Tab: Agregar Autor -->
                        <form v-if="activeTab === 'autor'" @submit.prevent="submitAutor" class="space-y-4">
                            <!-- Campo: Nombre del Autor -->
                            <div>
                                <label class="block text-center font-semibold text-gray-700 mb-2">Nombre</label>
                                <input
                                    v-model="autorForm.nombre"
                                    type="text"
                                    placeholder="Nombre del autor"
                                    class="w-full text-center rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                                    required
                                />
                                <p v-if="autorForm.errors.nombre" class="mt-1 text-sm text-red-600">{{ autorForm.errors.nombre }}</p>
                            </div>

                            <!-- Campo: País -->
                            <div>
                                <label class="block text-center font-semibold text-gray-700 mb-2">País</label>
                                    <select
                                        v-model="autorForm.pais_id"
                                        class="w-full text-center rounded-lg border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                                        required>
                                        <option disabled value="">Selecciona un país</option>
                                        <option v-for="pais in paises" :key="pais.id_pais" :value="pais.id_pais">
                                            {{ pais.nombre }}
                                        </option>
                                    </select>
                                <p v-if="autorForm.errors.pais_id" class="mt-1 text-sm text-red-600">{{ autorForm.errors.pais_id }}</p>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="flex justify-center gap-4 pt-4">
                                <button
                                    type="button"
                                    class="px-6 py-2 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold transition"
                                    @click="closeModal"
                                >
                                    Cancelar
                                </button>
                                <button
                                    type="submit"
                                    class="px-6 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 font-semibold transition disabled:opacity-50"
                                    :disabled="autorForm.processing"
                                >
                                    {{ autorForm.processing ? 'Guardando...' : 'Guardar' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Libro -->
        <div v-if="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
            <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="relative flex items-center mb-6">
                        <h3 class="absolute left-1/2 -translate-x-1/2 text-2xl font-bold text-blue-900">Editar Libro</h3>
                        <button class="ml-auto text-gray-500 hover:text-gray-700 text-2xl" @click="closeEditModal">✕</button>
                    </div>

                    <form @submit.prevent="submitEdit" class="space-y-4">
                        <div>
                            <label class="block text-center font-semibold text-gray-700 mb-2">Título</label>
                            <input v-model="editForm.titulo" type="text" placeholder="Ingresa el título" class="w-full text-center rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required />
                            <p v-if="editForm.errors.titulo" class="mt-1 text-sm text-red-600">{{ editForm.errors.titulo }}</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-center font-semibold text-gray-700 mb-2">Autor</label>
                                <select v-model="editForm.autor_id" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                                    <option disabled value="">Selecciona un autor</option>
                                    <option v-for="autor in autores" :key="autor.id_autor" :value="autor.id_autor">{{ autor.nombre }}</option>
                                </select>
                                <p v-if="editForm.errors.autor_id" class="mt-1 text-sm text-red-600">{{ editForm.errors.autor_id }}</p>
                            </div>

                            <div>
                                <label class="block text-center font-semibold text-gray-700 mb-2">Género</label>
                                <select v-model="editForm.genero_id" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                                    <option disabled value="">Selecciona un género</option>
                                    <option v-for="genero in generos" :key="genero.id_genero" :value="genero.id_genero">{{ genero.nombre }}</option>
                                </select>
                                <p v-if="editForm.errors.genero_id" class="mt-1 text-sm text-red-600">{{ editForm.errors.genero_id }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-center font-semibold text-gray-700 mb-2">Cantidad en Stock</label>
                            <input v-model="editForm.stock" type="number" min="0" placeholder="Ej: 10" class="w-full text-center rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required />
                            <p v-if="editForm.errors.stock" class="mt-1 text-sm text-red-600">{{ editForm.errors.stock }}</p>
                        </div>

                        <div class="flex justify-center gap-4 pt-4">
                            <button type="button" class="px-6 py-2 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold transition" @click="closeEditModal">Cancelar</button>
                            <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-semibold transition disabled:opacity-50" :disabled="editForm.processing">{{ editForm.processing ? 'Guardando...' : 'Actualizar' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
