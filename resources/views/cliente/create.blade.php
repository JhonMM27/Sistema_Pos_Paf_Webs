<!-- Modal Crear Cliente -->
<div id="addClientModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Cliente</h3>
                <button id="closeAddClientModal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Formulario -->
            <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label for="create_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo <span class="text-red-500">*</span></label>
                        <input type="text" id="create_name" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" placeholder="Ingrese el nombre del cliente" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="create_email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
                        <input type="email" id="create_email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" placeholder="ejemplo@correo.com" required>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <!-- Documento -->
                    <div>
                        <label for="create_documento" class="block text-sm font-medium text-gray-700 mb-1">Documento (DNI/RUC)</label>
                        <input type="text" id="create_documento" name="documento" value="{{ old('documento') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('documento') border-red-500 @enderror" placeholder="Ingrese el documento">
                        @error('documento') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <!-- Teléfono -->
                    <div>
                        <label for="create_telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" id="create_telefono" name="telefono" value="{{ old('telefono') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('telefono') border-red-500 @enderror" placeholder="Ingrese el teléfono">
                        @error('telefono') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <!-- Dirección -->
                    <div>
                        <label for="create_direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <input type="text" id="create_direccion" name="direccion" value="{{ old('direccion') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('direccion') border-red-500 @enderror" placeholder="Ingrese la dirección">
                        @error('direccion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" id="cancelAddClient" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"><i class="fas fa-save mr-2"></i>Guardar Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div> 