@extends('layout.app')
@section('contenido')
<main class="flex-1 p-4 md:p-6">
    <div id="categoriesContent" class="tab-content">
        <!-- Encabezado y Controles -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 border border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-800">Gestión de Categorías</h1>
                    <p class="text-gray-600 text-sm mt-1">Administra las categorías de productos del sistema</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button id="openAddCategoryModal"
                        class="flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                        <i class="fas fa-plus-circle mr-2"></i> Nueva Categoría
                    </button>
                    <a href="{{ route('productos.index') }}"
                        class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        <i class="fas fa-boxes-stacked mr-2"></i> Ir a Productos
                    </a>
                </div>
            </div>

            <!-- Filtros Mejorados -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                <form action="{{ route('categorias.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <!-- Campo de búsqueda -->
                        <div class="md:col-span-2">
                            <label for="categorySearch" class="block text-sm font-medium text-gray-700 mb-1">
                                Buscar categoría
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="categorySearch" placeholder="Nombre, ID o descripción" 
                                    name="texto" value="{{ request('texto') }}"
                                    class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <!-- Filtro por estado -->
                        <div>
                            <label for="categoryStatus" class="block text-sm font-medium text-gray-700 mb-1">
                                Estado
                            </label>
                            <select id="categoryStatus" name="estado"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">Todos</option>
                                <option value="1" {{ request('estado') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ request('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-sm">
                                <i class="fas fa-filter mr-2"></i> Filtrar
                            </button>
                            <a href="{{ route('categorias.index') }}"
                                class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors shadow-sm text-center">
                                <i class="fas fa-sync-alt mr-2"></i> Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabla de Categorías Mejorada -->
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($registros as $reg)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $reg->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $reg->nombre }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $reg->descripcion }}">
                                {{ $reg->descripcion }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($reg->estado == 1)
                                <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Activo
                                </span>
                                @else
                                <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Inactivo
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 edit-category p-1 rounded-full hover:bg-blue-50 transition-colors"
                                        id="editCategoryBtn-{{ $reg->id }}" title="Editar">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 delete-category p-1 rounded-full hover:bg-red-50 transition-colors"
                                        data-id="{{ $reg->id }}" title="Eliminar">
                                        <i class="fas fa-trash w-5 h-5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('categoria.edit')
                        @include('categoria.delete')
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <i class="fas fa-folder-open text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-gray-500">No hay categorías registradas</p>
                                    <button id="openAddCategoryModal" class="mt-4 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-plus-circle mr-1"></i> Crear primera categoría
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación Mejorada -->
            @if($registros->hasPages())
            <div class="flex flex-col md:flex-row items-center justify-between mt-6 pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-500 mb-4 md:mb-0">
                    {{-- Mostrando {{ $registros->firstItem() }} a {{ $registros->lastItem() }} de {{ $registros->total() }} resultados --}}
                </div>
                <div class="flex items-center space-x-1">
                    {{ $registros->links('vendor.pagination.tailwind') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</main>

<!-- Modales -->
@include('categoria.create')

<!-- Notificaciones -->
@if(session('mensaje'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        html: '<div class="text-center"><i class="fas fa-check-circle text-4xl text-green-500 mb-3"></i><p class="text-gray-700">{{ session('mensaje') }}</p></div>',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#16a34a',
        background: '#fff',
        color: '#1f2937',
        customClass: {
            popup: 'rounded-xl shadow-xl border border-gray-200',
            confirmButton: 'px-6 py-2 font-medium'
        }
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '¡Error!',
        html: '<div class="text-center"><i class="fas fa-exclamation-circle text-4xl text-red-500 mb-3"></i><p class="text-gray-700">{{ session('error') }}</p></div>',
        confirmButtonText: 'Entendido',
        confirmButtonColor: '#dc2626',
        background: '#fff',
        color: '#1f2937',
        customClass: {
            popup: 'rounded-xl shadow-xl border border-gray-200',
            confirmButton: 'px-6 py-2 font-medium'
        }
    });
</script>
@endif

@if($errors->any())
<script>
    let errores = '';
    @foreach($errors->all() as $error)
        errores += '<li class="text-left py-1 flex items-start"><i class="fas fa-exclamation-circle text-red-500 mr-2 mt-0.5"></i>{{ $error }}</li>';
    @endforeach

    Swal.fire({
        icon: 'error',
        title: 'Errores de validación',
        html: `<ul class="text-left list-disc pl-5">${errores}</ul>`,
        confirmButtonText: 'Corregir',
        confirmButtonColor: '#dc2626',
        background: '#fff',
        color: '#1f2937',
        customClass: {
            popup: 'rounded-xl shadow-xl border border-gray-200',
            confirmButton: 'px-6 py-2 font-medium'
        }
    });
</script>
@endif

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejo de modales
        const modalActions = {
            init() {
                // Abrir modal de creación
                document.getElementById('openAddCategoryModal')?.addEventListener('click', function() {
                    document.getElementById('addCategoryModal').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });

                // Cerrar modales
                document.querySelectorAll('.close-modal').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.fixed').classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    });
                });

                // Abrir modales de edición
                document.querySelectorAll('.edit-category').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.id.split('-')[1];
                        document.getElementById('editCategoryModal-' + id).classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    });
                });

                // Abrir modales de eliminación
                document.querySelectorAll('.delete-category').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        document.getElementById('deleteCategoryModal-' + id).classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    });
                });
            }
        };

        modalActions.init();
    });
</script>
@endsection