<!-- Modal Crear Cliente -->
<div id="addClientModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden">
    <div class="bg-white w-full max-w-2xl mx-4 md:mx-auto rounded-xl shadow-2xl overflow-hidden animate-[fadeIn_0.3s_ease-out]">
        <!-- Encabezado -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <i class="fas fa-user-plus text-blue-600 text-lg"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Nuevo Cliente</h3>
            </div>
            <button id="closeAddClientModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Formulario -->
        <form action="{{ route('clientes.store') }}" method="POST" class="px-6 py-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nombre -->
                <div class="md:col-span-2">
                    <label for="create_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre Completo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="create_name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('name') border-red-500 @enderror"
                        placeholder="Ingrese el nombre del cliente" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Correo -->
                <div>
                    <label for="create_email" class="block text-sm font-medium text-gray-700 mb-1">
                        Correo Electrónico <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="create_email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('email') border-red-500 @enderror"
                        placeholder="ejemplo@correo.com" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Documento -->
                <div>
                    <label for="create_documento" class="block text-sm font-medium text-gray-700 mb-1">Documento</label>
                    <input type="text" id="create_documento" name="documento" value="{{ old('documento') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('documento') border-red-500 @enderror"
                        placeholder="DNI o RUC">
                    @error('documento') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="create_telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" id="create_telefono" name="telefono" value="{{ old('telefono') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('telefono') border-red-500 @enderror"
                        placeholder="Número de contacto">
                    @error('telefono') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Dirección -->
                <div class="md:col-span-2">
                    <label for="create_direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                    <input type="text" id="create_direccion" name="direccion" value="{{ old('direccion') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm @error('direccion') border-red-500 @enderror"
                        placeholder="Dirección completa">
                    @error('direccion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end space-x-3">
                <button type="button" id="cancelAddClient"
                    class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-save mr-2"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>
