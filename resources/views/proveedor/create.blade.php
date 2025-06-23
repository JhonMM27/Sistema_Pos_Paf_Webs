<!-- Modal Crear Proveedor -->
<div id="createProviderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Header del Modal -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Proveedor</h3>
                <button id="closeCreateProviderModal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Formulario -->
            <form action="{{ route('proveedores.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre del Proveedor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nombre') border-red-500 @enderror"
                            placeholder="Ingrese el nombre del proveedor">
                        @error('nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">
                            Tipo <span class="text-red-500">*</span>
                        </label>
                        <select id="tipo" name="TipoProveedor_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('TipoProveedor_id') border-red-500 @enderror">
                            <option value="">Seleccione el tipo</option>
                            @foreach($tipos_proveedor as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('TipoProveedor_id') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('TipoProveedor_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- RUC/DNI -->
                    <div>
                        <label for="ruc_dni" class="block text-sm font-medium text-gray-700 mb-1">
                            RUC/DNI <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="ruc_dni" name="ruc_dni" value="{{ old('ruc_dni') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ruc_dni') border-red-500 @enderror"
                            placeholder="Ingrese RUC o DNI">
                        @error('ruc_dni')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">
                            Teléfono <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('telefono') border-red-500 @enderror"
                            placeholder="Ingrese el teléfono">
                        @error('telefono')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Correo -->
                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700 mb-1">
                            Correo Electrónico
                        </label>
                        <input type="email" id="correo" name="correo" value="{{ old('correo') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('correo') border-red-500 @enderror"
                            placeholder="ejemplo@correo.com">
                        @error('correo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="md:col-span-2">
                        <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">
                            Dirección
                        </label>
                        <textarea id="direccion" name="direccion" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('direccion') border-red-500 @enderror"
                            placeholder="Ingrese la dirección">{{ old('direccion') }}</textarea>
                        @error('direccion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-1">
                            Observaciones
                        </label>
                        <textarea id="observaciones" name="observaciones" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('observaciones') border-red-500 @enderror"
                            placeholder="Observaciones adicionales">{{ old('observaciones') }}</textarea>
                        @error('observaciones')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" id="cancelCreateProvider"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-save mr-2"></i> Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>
    // Funcionalidad del modal de crear proveedor
    document.getElementById('openAddProviderModal').addEventListener('click', function() {
        document.getElementById('createProviderModal').classList.remove('hidden');
    });

    document.getElementById('closeCreateProviderModal').addEventListener('click', function() {
        document.getElementById('createProviderModal').classList.add('hidden');
    });

    document.getElementById('cancelCreateProvider').addEventListener('click', function() {
        document.getElementById('createProviderModal').classList.add('hidden');
    });

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('createProviderModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
</script>  --}}