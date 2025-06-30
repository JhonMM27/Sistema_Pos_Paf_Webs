<!-- Modal Crear Usuario -->
<div id="createUserModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm hidden overflow-y-auto">
    <div id="createModalContent" class="w-full max-w-2xl mx-auto my-10 bg-white rounded-2xl shadow-xl border transition-transform duration-300 transform scale-95">
        <!-- Encabezado -->
        <div class="sticky top-0 z-10 flex justify-between items-center px-6 py-4 border-b bg-gradient-to-r from-blue-600 to-indigo-600 rounded-t-2xl">
            <h3 class="text-xl text-white font-semibold flex items-center">
                <i class="fas fa-user-plus mr-2"></i>Agregar Usuario
            </h3>
            <button id="closeCreateUserModal" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Formulario -->
        <form id="createUserForm" class="p-6 space-y-4" action="{{ route('configuracion.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="create-user-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo*</label>
                    <input type="text" name="name" id="create-user-name" required placeholder="Ej: Juan Pérez"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400">
                </div>
                <div>
                    <label for="create-user-email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico*</label>
                    <input type="email" name="email" id="create-user-email" required placeholder="Ej: usuario@dominio.com"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400">
                </div>

                <div>
                    <label for="create-user-password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña*</label>
                    <input type="password" name="password" id="create-user-password" required placeholder="Mínimo 8 caracteres"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400">
                </div>
                <div>
                    <label for="create-user-documento" class="block text-sm font-medium text-gray-700 mb-1">Documento</label>
                    <input type="text" name="documento" id="create-user-documento" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400" placeholder="Opcional">
                </div>

                <div>
                    <label for="create-user-direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                    <input type="text" name="direccion" id="create-user-direccion" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400" placeholder="Opcional">
                </div>
                <div>
                    <label for="create-user-telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" name="telefono" id="create-user-telefono" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400" placeholder="Opcional">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($roles as $role)
                        <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-gray-50">
                            <input type="radio" id="create_role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <label for="create_role_{{ $role->id }}" class="ml-2 text-sm text-gray-700 flex items-center">
                                <span class="inline-block h-3 w-3 rounded-full mr-2" style="background-color: {{ $role->color ?? '#6366f1' }}"></span>
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Permisos Especiales</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($permisos as $permiso)
                        <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-gray-50">
                            <input type="checkbox" id="create_permiso_{{ $permiso->id }}" name="permissions[]" value="{{ $permiso->name }}" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                            <label for="create_permiso_{{ $permiso->id }}" class="ml-2 text-sm text-gray-700 flex items-center">
                                <span class="inline-block h-3 w-3 rounded-full mr-2 bg-green-400"></span>
                                {{ $permiso->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Acciones -->
            <div class="flex justify-end gap-3 pt-4 border-t mt-6">
                <button type="button" id="cancelCreateUserModal"
                        class="px-4 py-2 rounded-lg bg-white text-gray-700 border border-gray-300 hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 flex items-center">
                    <i class="fas fa-save mr-2"></i>Guardar Usuario
                </button>
            </div>
        </form>
    </div>
</div>