@extends('layout.app')
@section('contenido')

<main class="flex-1 p-6">
    <div id="categoriesContent" class="tab-content">
        <div class="bg-green-50 p-6 rounded-lg shadow mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Gestión de Categorías</h2>
                <div class="space-x-2">
                    <button id="openAddCategoryModal"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        <i class="fas fa-plus-circle mr-1"></i> Nueva Categoría
                    </button>
                    <button id="exportCategoriesBtn"
                        class="bg-amber-400 text-white px-4 py-2 rounded-md hover:bg-amber-500">
                        <i class="fas fa-file-export mr-2"></i> Exportar
                    </button>
                </div>
            </div>

            <!-- Filtros -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="categorySearch" class="block text-sm font-medium text-gray-700 mb-1">Buscar categoría</label>
                    <input type="text" id="categorySearch" placeholder="Nombre o ID de categoría"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                </div>
                <div>
                    <label for="categoryStatus" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select id="categoryStatus"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                        <option value="">Todos</option>
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Tabla de Categorías -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Nombre</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Descripción</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Estado</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($registros as $reg)
                            <tr>
                                <td class="px-6 py-4 text-gray-500">{{ $reg->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $reg->nombre }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $reg->descripcion }}</td>
                                <td class="px-6 py-4">
                                    @if ($reg->estado == 1)
                                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 edit-category" id="editCategoryBtn-{{ $reg->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 delete-category" data-id="{{ $reg->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('categoria.edit')
                            @include('categoria.delete')
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay categorías registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="flex flex-col md:flex-row items-center justify-between mt-6 space-y-2 md:space-y-0">
                <div class="flex justify-center w-full">
                    <div class="text-lg">
                        {{ $registros->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Modales -->
@include('categoria.create')

<!-- Notificaciones -->
@if (Session::has('mensaje'))
    <div id="successModal"
        class="fixed top-4 right-4 z-50 bg-green-500 text-white py-4 px-6 rounded-lg shadow-lg opacity-0 transition-opacity duration-1000">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-3xl"></i>
            <div class="flex flex-col">
                <span class="font-semibold text-lg">{{ Session::get('mensaje') }}</span>
                <span class="text-sm">Operación realizada con éxito.</span>
            </div>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div id="errorModal"
        class="fixed top-4 right-4 z-50 bg-red-500 text-white py-4 px-6 rounded-lg shadow-lg opacity-0 transition-opacity duration-1000">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-3 text-3xl"></i>
            <div class="flex flex-col">
                <span class="font-semibold text-lg">{{ Session::get('error') }}</span>
                <span class="text-sm">Algo salió mal, intenta nuevamente.</span>
            </div>
        </div>
    </div>
@endif

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('openAddCategoryModal')?.addEventListener('click', function () {
            document.getElementById('addCategoryModal').classList.remove('hidden');
        });

        document.querySelectorAll('.close-modal').forEach(button => {
            button.addEventListener('click', function () {
                this.closest('.fixed').classList.add('hidden');
            });
        });

        document.querySelectorAll('.edit-category').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.id.split('-')[1];
                document.getElementById('editCategoryModal-' + id).classList.remove('hidden');
            });
        });

        document.querySelectorAll('.delete-category').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('deleteCategoryModal-' + id).classList.remove('hidden');
            });
        });

        // Mostrar notificaciones
        const successModal = document.getElementById("successModal");
        const errorModal = document.getElementById("errorModal");

        if (successModal) {
            successModal.classList.remove("opacity-0");
            successModal.classList.add("opacity-100");
            setTimeout(() => {
                successModal.classList.remove("opacity-100");
                successModal.classList.add("opacity-0");
            }, 5000);
        }

        if (errorModal) {
            errorModal.classList.remove("opacity-0");
            errorModal.classList.add("opacity-100");
            setTimeout(() => {
                errorModal.classList.remove("opacity-100");
                errorModal.classList.add("opacity-0");
            }, 5000);
        }
    });
</script>
@endsection
