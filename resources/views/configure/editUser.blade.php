<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl mx-4 overflow-hidden border border-gray-200 transform transition-all duration-300 scale-95 opacity-0"
        id="editModalContent">
        <!-- Encabezado del Modal -->
        <div class="px-6 py-4 border-b flex justify-between items-center bg-gradient-to-r from-blue-600 to-indigo-600">
            <h3 class="text-xl font-semibold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Editar Usuario
            </h3>
            <button id="closeEditUserModal" class="text-white hover:text-gray-200 focus:outline-none transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="editUserForm" class="p-6">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-user-id" name="user_id">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna izquierda - Información básica -->
                <div class="space-y-4">
                    <div>
                        <label for="edit-user-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo*</label>
                        <div class="relative">
                            <input type="text" name="name" id="edit-user-name" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                placeholder="Ej: Juan Pérez">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="edit-user-email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico*</label>
                        <div class="relative">
                            <input type="email" name="email" id="edit-user-email" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                placeholder="Ej: usuario@dominio.com">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="edit-user-password" class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                        <div class="relative">
                            <input type="password" name="password" id="edit-user-password"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                placeholder="Dejar vacío para mantener la actual">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none" onclick="togglePasswordVisibility('edit-user-password')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Dejar vacío para mantener la contraseña actual</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="edit-user-document" class="block text-sm font-medium text-gray-700 mb-1">Documento</label>
                            <input type="text" name="documento" id="edit-user-document" placeholder="Opcional"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all">
                        </div>
                        <div>
                            <label for="edit-user-phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                            <input type="tel" name="telefono" id="edit-user-phone" placeholder="Opcional"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Columna derecha - Configuración avanzada -->
                <div class="space-y-4">
                    <div>
                        <label for="edit-TipoUsuario_id" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Usuario*</label>
                        <select name="TipoUsuario_id" id="edit-TipoUsuario_id" required onchange="toggleEditAccessFields(this.value)"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all appearance-none bg-white bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGNsYXNzPSJsdWNpZGUgbHVjaWRlLWNoZXZyb24tZG93biI+PHBhdGggZD0ibTYgOSA2IDYgNi02Ii8+PC9zdmc+')] bg-no-repeat bg-[center_right_1rem]">
                            <option value="">Seleccione un tipo</option>
                            <option value="1">Empleado</option>
                            <option value="2">Cliente</option>
                        </select>
                    </div>

                    <div>
                        <label for="edit-user-address" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <textarea name="direccion" id="edit-user-address" rows="2" placeholder="Opcional"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all"></textarea>
                    </div>

                    <!-- Sección de Roles (solo para empleados) -->
                    <div id="edit-roles-section" class="hidden transition-all duration-300">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rol del Usuario</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="edit-roles-container">
                            <!-- Los roles se cargarán dinámicamente -->
                        </div>
                    </div>

                    <!-- Sección de Permisos (solo para empleados) -->
                    <div id="edit-permissions-section" class="hidden transition-all duration-300">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Permisos Especiales</label>
                        <div class="bg-gray-50 border rounded-lg p-4 max-h-48 overflow-y-auto shadow-inner">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="edit-permissions-container">
                                <!-- Los permisos se cargarán dinámicamente -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="mt-6 pt-4 flex justify-end gap-3 border-t border-gray-200">
                <button type="button" id="cancelEditUserModal"
                    class="px-5 py-2.5 rounded-lg bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mostrar/ocultar modal de edición con animación
    function toggleEditUserModal(show) {
        const modal = document.getElementById('editUserModal');
        const content = document.getElementById('editModalContent');
        
        if (show) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('bg-black/40');
                modal.classList.add('bg-black/50');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('bg-black/50');
            modal.classList.add('bg-black/40');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }

    // Mostrar/ocultar secciones según tipo de usuario en edición
    function toggleEditAccessFields(value) {
        const rolesSection = document.getElementById("edit-roles-section");
        const permissionsSection = document.getElementById("edit-permissions-section");
        
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

    // Cargar datos del usuario para edición (función global)
    window.loadUserData = function(userId) {
        fetch(`/configuracion/${userId}/edit`)
            .then(response => response.json())
            .then(data => {
                const user = data.user;
                
                // Log para depuración
                console.log('Datos recibidos del servidor:', data);
                console.log('Usuario:', user);
                console.log('Roles del usuario:', user.roles);
                console.log('Permisos del usuario:', user.permissions);
                console.log('Todos los permisos disponibles:', data.permisos);
                
                // Llenar el formulario con los datos del usuario
                document.getElementById('edit-user-id').value = user.id;
                document.getElementById('edit-user-name').value = user.name;
                document.getElementById('edit-user-email').value = user.email;
                document.getElementById('edit-user-document').value = user.documento || '';
                document.getElementById('edit-user-phone').value = user.telefono || '';
                document.getElementById('edit-user-address').value = user.direccion || '';
                document.getElementById('edit-TipoUsuario_id').value = user.TipoUsuario_id;
                
                // Cargar roles
                const rolesContainer = document.getElementById('edit-roles-container');
                rolesContainer.innerHTML = '';
                data.roles.forEach(role => {
                    const isChecked = user.roles.some(userRole => userRole.id === role.id);
                    rolesContainer.innerHTML += `
                        <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                            <input type="radio" id="edit_role_${role.id}" name="roles[]"
                                value="${role.name}" ${isChecked ? 'checked' : ''}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <label for="edit_role_${role.id}"
                                class="ml-2 text-sm text-gray-700 flex items-center">
                                <span class="inline-block h-3 w-3 rounded-full mr-2" style="background-color: ${role.color ?? '#3b82f6'}"></span>
                                ${role.name}
                            </label>
                        </div>
                    `;
                });
                
                // Cargar permisos
                const permissionsContainer = document.getElementById('edit-permissions-container');
                permissionsContainer.innerHTML = '';
                console.log('Cargando permisos...');
                data.permisos.forEach(permiso => {
                    const isChecked = user.permissions.some(userPermiso => userPermiso.id === permiso.id);
                    console.log(`Permiso ${permiso.name}: ${isChecked ? 'checked' : 'unchecked'}`);
                    permissionsContainer.innerHTML += `
                        <div class="flex items-center">
                            <input type="checkbox" id="edit_permiso_${permiso.id}" name="permissions[]"
                                value="${permiso.name}" ${isChecked ? 'checked' : ''}
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="edit_permiso_${permiso.id}"
                                class="ml-2 text-sm text-gray-700 truncate" title="${permiso.name}">
                                ${permiso.name}
                            </label>
                        </div>
                    `;
                });
                
                // Mostrar/ocultar secciones según tipo de usuario
                console.log('Tipo de usuario:', user.TipoUsuario_id);
                toggleEditAccessFields(user.TipoUsuario_id);
                
                // Mostrar el modal
                toggleEditUserModal(true);
            })
            .catch(error => {
                console.error('Error cargando datos del usuario:', error);
                Swal.fire('Error', 'No se pudieron cargar los datos del usuario', 'error');
            });
    };

    // Event listeners para el modal de edición
    document.addEventListener('DOMContentLoaded', function() {
        const closeEditUserModal = document.getElementById('closeEditUserModal');
        const cancelEditUserModal = document.getElementById('cancelEditUserModal');
        const editUserForm = document.getElementById('editUserForm');

        if (closeEditUserModal) {
            closeEditUserModal.addEventListener('click', () => toggleEditUserModal(false));
        }
        
        if (cancelEditUserModal) {
            cancelEditUserModal.addEventListener('click', () => toggleEditUserModal(false));
        }

        // Manejo del formulario de edición
        if (editUserForm) {
            editUserForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const userId = document.getElementById('edit-user-id').value;
                const formData = new FormData(this);
                
                // Agregar el método PUT para Laravel
                formData.append('_method', 'PUT');
                
                fetch(`/configuracion/${userId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('¡Éxito!', data.message, 'success').then(() => {
                            toggleEditUserModal(false);
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message || 'Error al actualizar el usuario', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Error al actualizar el usuario', 'error');
                });
            });
        }
    });
</script> 