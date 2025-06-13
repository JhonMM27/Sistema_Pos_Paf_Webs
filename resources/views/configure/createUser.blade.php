<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl mx-4 overflow-hidden border border-gray-200 transform transition-all duration-300 scale-95 opacity-0"
         id="modalContent">
        <!-- Encabezado del Modal -->
        <div class="px-6 py-4 border-b flex justify-between items-center bg-gradient-to-r from-indigo-600 to-blue-600">
            <h3 class="text-xl font-semibold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Agregar Nuevo Usuario
            </h3>
            <button id="closeUserModal" class="text-white hover:text-gray-200 focus:outline-none transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('configuracion.store') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna izquierda - Información básica -->
                <div class="space-y-4">
                    <div>
                        <label for="user-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo*</label>
                        <div class="relative">
                            <input type="text" name="name" id="user-name" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all placeholder-gray-400"
                                placeholder="Ej: Juan Pérez">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="user-email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico*</label>
                        <div class="relative">
                            <input type="email" name="email" id="user-email" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all placeholder-gray-400"
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
                        <label for="user-password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña*</label>
                        <div class="relative">
                            <input type="password" name="password" id="user-password" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all placeholder-gray-400"
                                placeholder="Mínimo 8 caracteres">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none" onclick="togglePasswordVisibility('user-password')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">La contraseña debe tener al menos 8 caracteres</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="user-document" class="block text-sm font-medium text-gray-700 mb-1">Documento</label>
                            <input type="text" name="documento" id="user-document" placeholder="Opcional"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                        </div>
                        <div>
                            <label for="user-phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                            <input type="tel" name="telefono" id="user-phone" placeholder="Opcional"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Columna derecha - Configuración avanzada -->
                <div class="space-y-4">
                    <div>
                        <label for="TipoUsuario_id" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Usuario*</label>
                        <select name="user-type" id="TipoUsuario_id" required onchange="toggleAccessFields(this.value)"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all appearance-none bg-white bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGNsYXNzPSJsdWNpZGUgbHVjaWRlLWNoZXZyb24tZG93biI+PHBhdGggZD0ibTYgOSA2IDYgNi02Ii8+PC9zdmc+')] bg-no-repeat bg-[center_right_1rem]">
                            <option value="">Seleccione un tipo</option>
                            <option value="2">Empleado</option>
                            <option value="1">Cliente</option>
                        </select>
                    </div>

                    <div>
                        <label for="user-address" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <textarea name="direccion" id="user-address" rows="2" placeholder="Opcional"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all"></textarea>
                    </div>

                    <!-- Sección de Roles (solo para empleados) -->
                    <div id="roles-section" class="hidden transition-all duration-300">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rol del Usuario</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($roles as $role)
                                <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <input type="radio" id="role_{{ $role->id }}" name="roles[]"
                                        value="{{ $role->name }}"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <label for="role_{{ $role->id }}"
                                        class="ml-2 text-sm text-gray-700 flex items-center">
                                        <span class="inline-block h-3 w-3 rounded-full mr-2" style="background-color: {{ $role->color ?? '#6366f1' }}"></span>
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sección de Permisos (solo para empleados) -->
                    <div id="permissions-section" class="hidden transition-all duration-300">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Permisos Especiales</label>
                        <div class="bg-gray-50 border rounded-lg p-4 max-h-48 overflow-y-auto shadow-inner">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ($permisos as $permiso)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="permiso_{{ $permiso->id }}" name="permissions[]"
                                            value="{{ $permiso->name }}"
                                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        <label for="permiso_{{ $permiso->id }}"
                                            class="ml-2 text-sm text-gray-700 truncate" title="{{ $permiso->name }}">
                                            {{ $permiso->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="mt-6 pt-4 flex justify-end gap-3 border-t border-gray-200">
                <button type="button" id="cancelUserModal"
                    class="px-5 py-2.5 rounded-lg bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Guardar Usuario
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mostrar/ocultar modal con animación
    function toggleUserModal(show) {
        const modal = document.getElementById('addUserModal');
        const content = document.getElementById('modalContent');
        
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

    // Mostrar/ocultar contraseña
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // Mostrar/ocultar secciones según tipo de usuario
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

    // Event listeners
    document.getElementById('addUserButton').addEventListener('click', () => toggleUserModal(true));
    document.getElementById('closeUserModal').addEventListener('click', () => toggleUserModal(false));
    document.getElementById('cancelUserModal').addEventListener('click', () => toggleUserModal(false));
</script>