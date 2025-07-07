@extends('layout.app')
@section('contenido')
<main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
    <div class="max-w-7xl mx-auto">
        <div id="clientsContent" class="tab-content">
            <!-- Encabezado y Controles -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Gestión de Clientes</h1>
                        <p class="text-gray-600 text-sm mt-1">Administra los clientes del sistema</p>
                    </div>
                    <div>
                        <button id="openAddClientModal"
                            class="w-full sm:w-auto flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Nuevo Cliente
                        </button>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
                    <form action="{{ route('clientes.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                            <div class="sm:col-span-2 md:col-span-3">
                                <label for="clientSearch" class="block text-sm font-medium text-gray-700 mb-1">
                                    Buscar cliente
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" id="clientSearch" placeholder="Nombre, correo o documento" 
                                        name="texto" value="{{ $texto ?? '' }}"
                                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit"
                                    class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-sm">
                                    <i class="fas fa-filter mr-2"></i> Filtrar
                                </button>
                                <a href="{{ route('clientes.index') }}"
                                    class="w-full sm:w-auto px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors shadow-sm text-center">
                                    <i class="fas fa-sync-alt mr-2"></i> Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tabla de Clientes -->
                <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                                @can('cliente-eliminar')
                                    
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($registros as $cliente)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cliente->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->documento ?: 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->telefono ?: 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->direccion ?: 'N/A' }}</td>
                                @can('cliente-eliminar')
                                    
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="openEditClientModal text-blue-600 hover:text-blue-900" data-id="{{ $cliente->id }}" title="Editar">
                                            <i class="fas fa-edit text-lg"></i>
                                        </button>
                                        <button class="openDeleteClientModal text-red-600 hover:text-red-900" data-id="{{ $cliente->id }}" title="Eliminar">
                                            <i class="fas fa-trash-alt text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                                @endcan
                            </tr>
                            @include('cliente.edit', ['cliente' => $cliente])
                            @include('cliente.delete', ['cliente' => $cliente])
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay clientes registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if ($registros->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 pt-4 border-t border-green-100 gap-y-4">
                        <div class="text-sm text-black-500 text-center sm:text-left">
                            Mostrando {{ $registros->firstItem() }} a {{ $registros->lastItem() }} de
                            {{ $registros->total() }} resultados
                        </div>
                        <div class="w-full sm:w-auto overflow-x-auto">
                            <div class="inline-flex items-center space-x-1">
                                {{ $registros->links('vendor.pagination.tailwind') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

@include('cliente.create')

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- MANEJO DEL MODAL DE CREACIÓN ---
    const addClientModal = document.getElementById('addClientModal');
    const openAddClientModalButton = document.getElementById('openAddClientModal');
    const closeAddClientModalButton = document.getElementById('closeAddClientModal');
    const cancelAddClientButton = document.getElementById('cancelAddClient');

    function openAddModal() {
        addClientModal.classList.remove('hidden');
    }
    function closeAddModal() {
        addClientModal.classList.add('hidden');
    }

    openAddClientModalButton.addEventListener('click', openAddModal);
    closeAddClientModalButton.addEventListener('click', closeAddModal);
    cancelAddClientButton.addEventListener('click', closeAddModal);

    // --- MANEJO DE MODALES DE EDICIÓN ---
    const editModals = document.querySelectorAll('.openEditClientModal');
    editModals.forEach(button => {
        button.addEventListener('click', function () {
            const clientId = this.dataset.id;
            document.getElementById('editClientModal-' + clientId).classList.remove('hidden');
        });
    });

    const closeEditModals = document.querySelectorAll('.closeEditClientModal');
    closeEditModals.forEach(button => {
        button.addEventListener('click', function () {
            const clientId = this.dataset.id;
            document.getElementById('editClientModal-' + clientId).classList.add('hidden');
        });
    });

    const cancelEditButtons = document.querySelectorAll('.cancelEditClient');
    cancelEditButtons.forEach(button => {
        button.addEventListener('click', function () {
            const clientId = this.dataset.id;
            document.getElementById('editClientModal-' + clientId).classList.add('hidden');
        });
    });

    // --- MANEJO DE MODALES DE ELIMINACIÓN ---
    const deleteModals = document.querySelectorAll('.openDeleteClientModal');
    deleteModals.forEach(button => {
        button.addEventListener('click', function () {
            const clientId = this.dataset.id;
            document.getElementById('deleteClientModal-' + clientId).classList.remove('hidden');
        });
    });

    const cancelDeleteButtons = document.querySelectorAll('.cancelDeleteClient');
    cancelDeleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const clientId = this.dataset.id;
            document.getElementById('deleteClientModal-' + clientId).classList.add('hidden');
        });
    });

    // Mostrar SweetAlert2 para notificaciones de sesión
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            timer: 3000,
            timerProgressBar: true,
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session('error') }}',
        });
    @endif

    // Si hay errores de validación, abrir el modal de creación
    @if($errors->any())
        openAddModal();
    @endif
});
</script>
@endpush
