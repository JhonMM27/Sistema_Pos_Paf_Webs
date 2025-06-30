<!-- Modal Editar Usuario -->
<div id="editUserModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm hidden overflow-y-auto">
    <div id="editModalContent" class="w-full max-w-lg mx-auto my-10 bg-white rounded-2xl shadow-xl border transition-transform duration-300 transform scale-95">
        <div class="sticky top-0 z-10 flex justify-between items-center px-4 py-3 border-b bg-gradient-to-r from-blue-600 to-indigo-600 rounded-t-2xl">
            <h3 class="text-lg text-white font-semibold flex items-center">
                <i class="fas fa-user-edit mr-2"></i>Editar Usuario
            </h3>
            <button id="closeEditUserModal" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="editUserForm" class="p-4 space-y-4" action="{{ route('configuracion.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" id="edit-user-id">

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="edit-user-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo*</label>
                    <input type="text" name="name" id="edit-user-name" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400">
                </div>

                <div>
                    <label for="edit-user-email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico*</label>
                    <input type="email" name="email" id="edit-user-email" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400">
                </div>

                <div>
                    <label for="edit-user-password" class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                    <input type="password" name="password" id="edit-user-password"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400"
                           placeholder="Dejar vacío para mantener la actual">
                    <p class="mt-1 text-xs text-gray-500">Dejar vacío para mantener la contraseña actual</p>
                </div>

                <div>
                    <label for="edit-user-documento" class="block text-sm font-medium text-gray-700 mb-1">Documento</label>
                    <input type="text" name="documento" id="edit-user-documento" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400" placeholder="Opcional">
                </div>

                <div>
                    <label for="edit-user-direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                    <input type="text" name="direccion" id="edit-user-direccion" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400" placeholder="Opcional">
                </div>

                <div>
                    <label for="edit-user-telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" name="telefono" id="edit-user-telefono" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition placeholder-gray-400" placeholder="Opcional">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="edit-roles-container">
                    <!-- Los roles se cargarán dinámicamente -->
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Permisos Especiales</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="edit-permissions-container">
                    <!-- Los permisos se cargarán dinámicamente -->
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t mt-6">
                <button type="button" id="cancelEditUserModal"
                        class="px-4 py-2 rounded-lg bg-white text-gray-700 border border-gray-300 hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 flex items-center">
                    <i class="fas fa-save mr-2"></i>Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>