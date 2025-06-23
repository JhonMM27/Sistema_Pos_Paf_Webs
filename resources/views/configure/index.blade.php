@extends('layout.app')
@section('contenido')
    @push('estilos')
        <style>
            /* Transiciones suaves para elementos interactivos */
            .transition-smooth {
                transition: all 0.3s ease;
            }

            /* Efecto hover para filas de tabla */
            .table-row-hover:hover {
                background-color: #f8fafc;
            }

            /* Estilo para pestañas activas */
            .tab-active {
                position: relative;
                color: #3b82f6;
            }

            .tab-active:after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background-color: #3b82f6;
                border-radius: 3px 3px 0 0;
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from {
                    transform: scaleX(0);
                }

                to {
                    transform: scaleX(1);
                }
            }

            /* Estilo para badges de estado */
            .badge {
                display: inline-flex;
                align-items: center;
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
                line-height: 1;
            }

            .badge-employee {
                background-color: #dbeafe;
                color: #1d4ed8;
            }

            .badge-client {
                background-color: #dcfce7;
                color: #166534;
            }

            /* Efecto para botones de acción */
            .action-btn {
                padding: 0.4rem;
                border-radius: 0.375rem;
                transition: all 0.2s;
            }

            .action-btn:hover {
                transform: translateY(-1px);
            }

            .edit-btn {
                color: #3b82f6;
            }

            .edit-btn:hover {
                background-color: #eff6ff;
            }

            .delete-btn {
                color: #ef4444;
            }

            .delete-btn:hover {
                background-color: #fef2f2;
            }

            /* Scroll personalizado */
            .custom-scrollbar::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }

            .custom-scrollbar::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>
    @endpush

    <div class="w-full px-4 py-6">
        <!-- Main Content -->
        <main class="w-full px-4 md:px-6 py-6">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                <!-- Tabs Navigation -->
                <div class="border-b border-gray-200 bg-white">
                    <div class="px-6 pt-4 pb-2 flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Panel de Administración</h1>
                    </div>

                    <div class="relative">
                        <nav class="flex px-6">
                            <button id="usersTab"
                                class="tab-active py-4 px-6 text-center border-b-2 font-medium text-sm text-blue-600 border-blue-600 relative z-10 transition-smooth">
                                <i class="fas fa-users mr-2"></i>Usuarios
                            </button>
                            <button id="rolesTab"
                                class="py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent relative z-10 transition-smooth">
                                <i class="fas fa-user-tag mr-2"></i>Roles
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Tabs Content -->
                <div class="p-6">
                    <!-- Users Tab Content -->
                    <div id="usersContent" class="tab-content active">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">Gestión de Empleados</h2>
                                <p class="text-sm text-gray-500">Administra los empleados del sistema</p>
                            </div>
                            <button id="addUserButton"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-smooth flex items-center shadow-md hover:shadow-lg">
                                <i class="fas fa-plus mr-2"></i>Nuevo Empleado
                            </button>
                        </div>

                        <!-- Users Table -->
                        <div class="overflow-x-auto custom-scrollbar rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Documento
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Teléfono
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if ($registros->isEmpty())
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                                No hay empleados registrados.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($registros as $reg)
                                            <tr class="table-row-hover transition-smooth">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $reg->id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full object-cover"
                                                                src="https://ui-avatars.com/api/?name={{ urlencode($reg->name) }}&background=random"
                                                                alt="{{ $reg->name }}">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $reg->name }}
                                                            </div>
                                                            <div class="text-xs text-gray-500 truncate max-w-xs">
                                                                {{ $reg->direccion ?? 'Sin dirección' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $reg->email }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $reg->documento ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $reg->telefono ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($reg->TipoUsuario->name === 'Empleado')
                                                        <span class="badge badge-employee">
                                                            <i class="fas fa-user-tie mr-1"></i>
                                                            {{ $reg->TipoUsuario->name }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-client">
                                                            <i class="fas fa-user mr-1"></i> {{ $reg->TipoUsuario->name }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                    <button class="edit-btn action-btn edit-user"
                                                        data-id="{{ $reg->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="delete-btn action-btn delete-user"
                                                        data-id="{{ $reg->id }}" data-name="{{ $reg->name }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        @if ($registros->hasPages())
                            <div class="mt-4 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    @if ($registros->onFirstPage())
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white cursor-not-allowed">
                                            Anterior
                                        </span>
                                    @else
                                        <a href="{{ $registros->previousPageUrl() }}"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Anterior
                                        </a>
                                    @endif

                                    @if ($registros->hasMorePages())
                                        <a href="{{ $registros->nextPageUrl() }}"
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Siguiente
                                        </a>
                                    @else
                                        <span
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white cursor-not-allowed">
                                            Siguiente
                                        </span>
                                    @endif
                                </div>
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Mostrando
                                            <span class="font-medium">{{ $registros->firstItem() }}</span>
                                            a
                                            <span class="font-medium">{{ $registros->lastItem() }}</span>
                                            de
                                            <span class="font-medium">{{ $registros->total() }}</span>
                                            resultados
                                        </p>
                                    </div>
                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                            aria-label="Pagination">
                                            @if ($registros->onFirstPage())
                                                <span
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed">
                                                    <span class="sr-only">Anterior</span>
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            @else
                                                <a href="{{ $registros->previousPageUrl() }}"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    <span class="sr-only">Anterior</span>
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            @endif

                                            @foreach ($registros->getUrlRange(1, $registros->lastPage()) as $page => $url)
                                                @if ($page == $registros->currentPage())
                                                    <span aria-current="page"
                                                        class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                        {{ $page }}
                                                    </span>
                                                @else
                                                    <a href="{{ $url }}"
                                                        class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                        {{ $page }}
                                                    </a>
                                                @endif
                                            @endforeach

                                            @if ($registros->hasMorePages())
                                                <a href="{{ $registros->nextPageUrl() }}"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    <span class="sr-only">Siguiente</span>
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            @else
                                                <span
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed">
                                                    <span class="sr-only">Siguiente</span>
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            @endif
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Roles Tab Content -->
                    <div id="rolesContent" class="tab-content hidden">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">Roles y Tipos de Usuario</h2>
                                <p class="text-sm text-gray-500">Visualiza los roles existentes y tipos de usuario del
                                    sistema</p>
                            </div>
                        </div>

                        <!-- Roles Table -->
                        <div class="overflow-x-auto custom-scrollbar rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Rol/Tipo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Descripción
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Usuarios Asignados
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Permisos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($roles as $role)
                                        @php
                                            $numAdmin = 0;
                                            $numVendedor = 0;
                                            $numCliente = 0;
                                        @endphp
                                        <tr class="table-row-hover transition-smooth">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                        <i class="fas fa-crown text-indigo-600"></i>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $role->name }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">Rol del sistema</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $role->description ?? 'Sin descripción' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">

                                                @if ($role->name === 'Administrador')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ ++$numAdmin }}
                                                    </span>
                                                @elseif($role->name === 'Vendedor')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ ++$numVendedor }}
                                                    </span>
                                                @elseif($role->name === 'Cliente')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ ++$numCliente }}
                                                    </span>
                                                @endif
                                                
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $role->permissions_count ?? 0 }} permisos
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- Mostrar clientes (usuarios sin roles) -->
                                    @php
                                        $clientesCount = \App\Models\User::whereDoesntHave('roles')->count();
                                    @endphp
                                    @if ($clientesCount > 0)
                                        <tr class="table-row-hover transition-smooth">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                        <i class="fas fa-user text-blue-600"></i>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Cliente</div>
                                                        <div class="text-xs text-gray-500">Tipo de usuario</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Usuarios sin roles asignados (clientes)
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $clientesCount }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                0 permisos
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('configure.createUser')
    @include('configure.editUser')

    <script>
        // Gestión de pestañas principales
        const usersTab = document.getElementById('usersTab');
        const rolesTab = document.getElementById('rolesTab');

        const usersContent = document.getElementById('usersContent');
        const rolesContent = document.getElementById('rolesContent');

        function resetTabs() {
            // Remove active classes from all tabs
            [usersTab, rolesTab].forEach(tab => {
                tab.classList.remove('tab-active', 'text-blue-600', 'border-blue-600');
                tab.classList.add('text-gray-500', 'border-transparent');
            });

            // Hide all content
            [usersContent, rolesContent].forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
        }

        function activateTab(tab, content) {
            resetTabs();
            tab.classList.add('tab-active', 'text-blue-600', 'border-blue-600');
            tab.classList.remove('text-gray-500');
            content.classList.remove('hidden');
            content.classList.add('active');

            // Guardar la pestaña activa en localStorage
            localStorage.setItem('activeTab', tab.id);
        }

        // Event listeners para pestañas
        usersTab.addEventListener('click', () => activateTab(usersTab, usersContent));
        rolesTab.addEventListener('click', () => activateTab(rolesTab, rolesContent));

        // Cargar pestaña activa desde localStorage al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            const activeTabId = localStorage.getItem('activeTab') || 'usersTab';
            const activeTab = document.getElementById(activeTabId);
            const activeContent = document.getElementById(activeTabId.replace('Tab', 'Content'));

            if (activeTab && activeContent) {
                activateTab(activeTab, activeContent);
            }
        });

        // Manejo del modal de usuario
        const addUserButton = document.getElementById('addUserButton');
        const addUserModal = document.getElementById('addUserModal');
        const closeUserModal = document.getElementById('closeUserModal');
        const cancelUserModal = document.getElementById('cancelUserModal');

        function toggleUserModal(show) {
            const modal = document.getElementById('addUserModal');
            const content = document.getElementById('modalContent');

            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('opacity-100');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('opacity-100');
                }, 300);
            }
        }

        // Event listeners para el modal
        addUserButton.addEventListener('click', () => toggleUserModal(true));
        closeUserModal.addEventListener('click', () => toggleUserModal(false));
        cancelUserModal.addEventListener('click', () => toggleUserModal(false));

        // Manejo de la creación de usuarios
        function toggleAccessFields(value) {
            const rolesSection = document.getElementById("roles-section");
            const permissionsSection = document.getElementById("permissions-section");

            if (value === "1") { // Empleado
                rolesSection.classList.remove("hidden");
                permissionsSection.classList.remove("hidden");

                // Animación para mostrar
                setTimeout(() => {
                    rolesSection.classList.remove("opacity-0");
                    permissionsSection.classList.remove("opacity-0");
                }, 10);
            } else {
                // Animación para ocultar
                rolesSection.classList.add("opacity-0");
                permissionsSection.classList.add("opacity-0");
                setTimeout(() => {
                    rolesSection.classList.add("hidden");
                    permissionsSection.classList.add("hidden");
                }, 300);
            }
        }

        // Editar usuario
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-user')) {
                const userId = e.target.closest('.edit-user').getAttribute('data-id');
                loadUserData(userId);
            }
        });

        // Eliminar usuario
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-user')) {
                const userId = e.target.closest('.delete-user').getAttribute('data-id');
                const userName = e.target.closest('.delete-user').getAttribute('data-name');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Realmente quieres eliminar al usuario "${userName}"? ¡No podrás revertir esto!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Llamada AJAX para eliminar
                        fetch(`/configuracion/${userId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        '¡Eliminado!',
                                        data.message,
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error',
                                        data.message,
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire(
                                    'Error',
                                    'Error al eliminar el usuario',
                                    'error'
                                );
                            });
                    }
                });
            }
        });
    </script>
@endsection
