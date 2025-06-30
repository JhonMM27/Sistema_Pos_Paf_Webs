@extends('layout.app')
@section('contenido')

    @push('estilos')
        <style>
            /* Scroll personalizado */
            .modal-scroll {
                max-height: 200px;
                overflow-y: auto;
            }

            .modal-scroll::-webkit-scrollbar {
                width: 6px;
            }

            .modal-scroll::-webkit-scrollbar-thumb {
                background-color: #cbd5e1;
                border-radius: 6px;
            }

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

            .transition-smooth {
                transition: all 0.3s ease-in-out;
            }
        </style>
    @endpush

    <div class="w-full px-4 py-6">
        <main class="w-full px-4 md:px-6 py-6">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

                <!-- Encabezado -->
                <div class="px-6 pt-4 pb-3 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Gestión de Usuarios</h1>
                        <p class="text-sm text-gray-500">Controla roles, permisos y datos de los empleados</p>
                    </div>
                    <button id="openCreateUserModal"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-200">
                        <i class="fas fa-plus"></i> Nuevo Usuario
                    </button>
                </div>

                <!-- Mensaje de éxito -->
                @if (session('success'))
                    <div class="mx-6 my-3 p-3 rounded-lg bg-green-100 text-green-800 text-sm shadow">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabla Responsive -->
                <div class="p-6 overflow-x-auto custom-scrollbar">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 font-semibold">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Correo</th>
                                <th class="px-4 py-3">Roles</th>
                                <th class="px-4 py-3">Permisos</th>
                                <th class="px-4 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($registros as $usuario)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">{{ $usuario->id }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $usuario->name }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $usuario->email }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @foreach ($usuario->roles as $role)
                                            <span
                                                class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full mr-1 mb-1">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @php
                                            $permisosUsuarios = $usuario->getAllPermissions()->pluck('name')->sort();
                                        @endphp
                                        @foreach ($permisosUsuarios->take(2) as $permiso)
                                            <span
                                                class="inline-block bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full mr-1 mb-1">
                                                {{ $permiso }}
                                            </span>
                                        @endforeach
                                        {{-- @if ($permisosUsuarios->count() > 2)
                                        <button onclick="mostrarPermisos('{{ $usuario->id }}')"
                                            class="text-blue-600 text-xs hover:underline ml-1">
                                            +{{ $permisosUsuarios->count() - 2 }} más
                                        </button>
                                        <div id="permisos-modal-{{ $usuario->id }}"
                                            class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center transition-all duration-300 custom-scrollbar">
                                            <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-md w-full">
                                                <!-- Encabezado del modal -->
                                                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                                                    <h3 class="text-lg font-semibold text-gray-800">Permisos del usuario</h3>
                                                    <button onclick="cerrarPermisos('{{ $usuario->id }}')"
                                                        class="text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <!-- Lista de permisos -->
                                                <div class="p-4 overflow-y-auto max-h-96 custom-scrollbar">
                                                    <ul id="permisos-lista-{{ $usuario->id }}"
                                                        class="space-y-2">
                                                        @foreach ($permisosUsuarios as $permiso)
                                                            <li class="px-2 py-1 bg-gray-100 rounded text-sm text-gray-700">
                                                                {{ $permiso }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif --}}

                                    @if ($permisosUsuarios->count() > 2)
    <button onclick="mostrarPermisos('{{ $usuario->id }}')"
        class="text-blue-600 text-xs hover:underline ml-1">
        +{{ $permisosUsuarios->count() - 2 }} más
    </button>

    <!-- Modal fijo, con scroll interno y fondo bloqueado -->
    <div id="permisos-modal-{{ $usuario->id }}"
        class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm overflow-y-auto">

        <div id="modal-content-{{ $usuario->id }}"
            class="mx-auto mt-12 mb-12 w-full max-w-2xl bg-white rounded-xl shadow-2xl transition-transform duration-300 overflow-hidden">

            <!-- Header -->
            <div class="sticky top-0 bg-gray-50 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Permisos del Usuario</h3>
                <button onclick="cerrarPermisos('{{ $usuario->id }}')"
                    class="text-gray-400 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Cuerpo -->
            <div class="p-4 max-h-[70vh] overflow-y-auto custom-scrollbar grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach ($permisosUsuarios as $permiso)
                    <div class="flex items-center gap-2 px-3 py-2 bg-gray-50 border border-gray-200 rounded-md shadow-sm">
                        <i class="fas fa-check-circle text-green-500"></i>
                        <span class="text-sm text-gray-700 truncate">{{ $permiso }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Footer -->
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50 text-right">
                <button onclick="cerrarPermisos('{{ $usuario->id }}')"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
@endif

                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <button class="edit-user-btn text-blue-600 hover:text-blue-800 mr-2"
                                            data-id="{{ $usuario->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="delete-user-btn text-red-600 hover:text-red-800"
                                            data-id="{{ $usuario->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay usuarios
                                        registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $registros->links('vendor.pagination.tailwind') }}
                </div>

            </div>
        </main>
    </div>

    @include('configure.createUser')
    @include('configure.editUser')

@endsection

@push('scripts')
    <script>
        function mostrarPermisos(id) {
            document.getElementById('permisos-modal-' + id).classList.remove('hidden');
        }

        function cerrarPermisos(id) {
            document.getElementById('permisos-modal-' + id).classList.add('hidden');
        }

        // --- MODALES ---
        function openModal(modalId, contentId) {
            const modal = document.getElementById(modalId);
            const content = document.getElementById(contentId);
            modal.classList.remove('hidden', 'opacity-0');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal(modalId, contentId) {
            const modal = document.getElementById(modalId);
            const content = document.getElementById(contentId);
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden', 'opacity-0');
            }, 300);
        }

        // Botones de abrir/cerrar
        document.getElementById('openCreateUserModal').onclick = () => openModal('createUserModal', 'createModalContent');
        document.getElementById('closeCreateUserModal').onclick = () => closeModal('createUserModal', 'createModalContent');
        document.getElementById('cancelCreateUserModal').onclick = () => closeModal('createUserModal',
        'createModalContent');

        // Cargar datos al editar
        document.querySelectorAll('.edit-user-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                fetch(`/configuracion/${userId}/edit`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('edit-user-id').value = data.user.id;
                        document.getElementById('edit-user-name').value = data.user.name;
                        document.getElementById('edit-user-email').value = data.user.email;

                        const rolesContainer = document.getElementById('edit-roles-container');
                        rolesContainer.innerHTML = '';
                        data.roles.forEach(role => {
                            const checked = data.user.roles.length && data.user.roles[0].id ===
                                role.id ? 'checked' : '';
                            rolesContainer.innerHTML += `
                            <div class='flex items-center p-2 rounded-lg border border-gray-200 hover:bg-gray-50'>
                                <input type='radio' id='edit_role_${role.id}' name='roles[]' value='${role.name}' class='h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300' ${checked}>
                                <label for='edit_role_${role.id}' class='ml-2 text-sm text-gray-700 flex items-center'>
                                    <span class='inline-block h-3 w-3 rounded-full mr-2' style='background-color: ${role.color ?? '#6366f1'}'></span>
                                    ${role.name}
                                </label>
                            </div>`;
                        });

                        const permissionsContainer = document.getElementById(
                            'edit-permissions-container');
                        permissionsContainer.innerHTML = '';
                        data.permisos.forEach(perm => {
                            const checked = data.all_permissions && data.all_permissions.includes(perm.name) ? 'checked' : '';
                            permissionsContainer.innerHTML += `
                            <div class='flex items-center p-2 rounded-lg border border-gray-200 hover:bg-gray-50'>
                                <input type='checkbox' id='edit_permiso_${perm.id}' name='permissions[]' value='${perm.name}' class='h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300' ${checked}>
                                <label for='edit_permiso_${perm.id}' class='ml-2 text-sm text-gray-700 flex items-center'>
                                    <span class='inline-block h-3 w-3 rounded-full mr-2 bg-green-400'></span>
                                    ${perm.name}
                                </label>
                            </div>`;
                        });

                        openModal('editUserModal', 'editModalContent');
                    })
                    .catch(() => Swal.fire('Error', 'No se pudieron cargar los datos', 'error'));
            });
        });

        document.getElementById('closeEditUserModal').onclick = () => closeModal('editUserModal', 'editModalContent');
        document.getElementById('cancelEditUserModal').onclick = () => closeModal('editUserModal', 'editModalContent');

        // Crear usuario
        document.getElementById('createUserForm').onsubmit = function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('/configuracion', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    Swal.fire('¡Éxito!', data.message, 'success').then(() => window.location.reload());
                } else {
                    Swal.fire('Error', data.message || 'No se pudo crear el usuario', 'error');
                }
            }).catch(() => Swal.fire('Error', 'No se pudo crear el usuario', 'error'));
        };

        // Editar usuario
        document.getElementById('editUserForm').onsubmit = function(e) {
            e.preventDefault();
            const userId = document.getElementById('edit-user-id').value;
            const formData = new FormData(this);
            formData.append('_method', 'PUT');
            fetch(`/configuracion/${userId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    Swal.fire('¡Éxito!', data.message, 'success').then(() => window.location.reload());
                } else {
                    Swal.fire('Error', data.message || 'No se pudo actualizar el usuario', 'error');
                }
            }).catch(() => Swal.fire('Error', 'No se pudo actualizar el usuario', 'error'));
        };

        // Eliminar usuario
        document.querySelectorAll('.delete-user-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede deshacer.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/configuracion/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json'
                            }
                        }).then(res => res.json()).then(data => {
                            Swal.fire(
                                data.success ? '¡Eliminado!' : 'Error',
                                data.message,
                                data.success ? 'success' : 'error'
                            ).then(() => data.success && window.location.reload());
                        }).catch(() => Swal.fire('Error', 'Error al eliminar', 'error'));
                    }
                });
            });
        });
    </script>
@endpush
