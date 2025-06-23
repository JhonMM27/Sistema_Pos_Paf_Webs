@extends('layout.app')
@section('contenido')
<main class="flex-1 p-4 md:p-6">
    <div id="providersContent" class="tab-content">
        <!-- Encabezado y Controles -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 border border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-800">Gestión de Proveedores</h1>
                    <p class="text-gray-600 text-sm mt-1">Administra los proveedores del sistema</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button id="openAddProviderModal"
                        class="flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                        <i class="fas fa-plus-circle mr-2"></i> Nuevo Proveedor
                    </button>
                    {{-- <a href="{{ route('categorias.index') }}"
                        class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        <i class="fas fa-tags mr-2"></i> Ir a Categorías
                    </a> --}}
                </div>
            </div>

            <!-- Filtros Mejorados -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                <form action="{{ route('proveedores.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <!-- Campo de búsqueda -->
                        <div class="md:col-span-2">
                            <label for="providerSearch" class="block text-sm font-medium text-gray-700 mb-1">
                                Buscar proveedor
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="providerSearch" placeholder="Nombre, RUC/DNI o correo" 
                                    name="texto" value="{{ request('texto') }}"
                                    class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <!-- Filtro por tipo -->
                        <div>
                            <label for="providerType" class="block text-sm font-medium text-gray-700 mb-1">
                                Tipo
                            </label>
                            <select id="providerType" name="TipoProveedor_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">Todos</option>
                                @foreach($tipos_proveedor as $tipo)
                                    <option value="{{ $tipo->id }}" {{ request('TipoProveedor_id') == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-sm">
                                <i class="fas fa-filter mr-2"></i> Filtrar
                            </button>
                            <a href="{{ route('proveedores.index') }}"
                                class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors shadow-sm text-center">
                                <i class="fas fa-sync-alt mr-2"></i> Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabla de Proveedores Mejorada -->
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
                                Tipo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                RUC/DNI
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Teléfono
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Correo
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-tag mr-1"></i> {{ $reg->tipoProveedor->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $reg->ruc_dni }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $reg->telefono }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate" title="{{ $reg->correo }}">
                                {{ $reg->correo }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 edit-provider p-1 rounded-full hover:bg-blue-50 transition-colors"
                                        id="editProviderBtn-{{ $reg->id }}" title="Editar">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 delete-provider p-1 rounded-full hover:bg-red-50 transition-colors"
                                        data-id="{{ $reg->id }}" title="Eliminar">
                                        <i class="fas fa-trash w-5 h-5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('proveedor.edit')
                        @include('proveedor.delete')
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <i class="fas fa-truck text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-gray-500">No hay proveedores registrados</p>
                                    <button id="openAddProviderModal" class="mt-4 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-plus-circle mr-1"></i> Crear primer proveedor
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
@include('proveedor.create')

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

<script>
    // Funcionalidad para abrir modal de crear proveedor
    document.getElementById('openAddProviderModal').addEventListener('click', function() {
        document.getElementById('createProviderModal').classList.remove('hidden');
    });

    // Funcionalidad para editar proveedor
    document.querySelectorAll('.edit-provider').forEach(button => {
        button.addEventListener('click', function() {
            const providerId = this.id.replace('editProviderBtn-', '');
            document.getElementById('editProviderModal-' + providerId).classList.remove('hidden');
        });
    });

    // Funcionalidad para eliminar proveedor
    document.querySelectorAll('.delete-provider').forEach(button => {
        button.addEventListener('click', function() {
            const providerId = this.getAttribute('data-id');
            document.getElementById('deleteProviderModal-' + providerId).classList.remove('hidden');
        });
    });

    // Funcionalidad para cerrar modales de editar
    document.querySelectorAll('.closeEditProviderModal').forEach(button => {
        button.addEventListener('click', function() {
            const providerId = this.getAttribute('data-id');
            document.getElementById('editProviderModal-' + providerId).classList.add('hidden');
        });
    });

    document.querySelectorAll('.cancelEditProvider').forEach(button => {
        button.addEventListener('click', function() {
            const providerId = this.getAttribute('data-id');
            document.getElementById('editProviderModal-' + providerId).classList.add('hidden');
        });
    });

    // Funcionalidad para cerrar modales de eliminar
    document.querySelectorAll('.cancelDeleteProvider').forEach(button => {
        button.addEventListener('click', function() {
            const providerId = this.getAttribute('data-id');
            document.getElementById('deleteProviderModal-' + providerId).classList.add('hidden');
        });
    });

    // Cerrar modales al hacer clic fuera de ellos
    document.querySelectorAll('[id^="editProviderModal-"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });

    document.querySelectorAll('[id^="deleteProviderModal-"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });

    document.getElementById('createProviderModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
</script>
@endsection
