<!-- Modal Editar Proveedor -->
<div id="editProviderModal-{{ $reg->id }}" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 md:mx-6 sm:mx-2 overflow-y-auto max-h-[90vh]">
        <div class="mt-3">
            <!-- Header del Modal -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Editar Proveedor</h3>
                <button class="closeEditProviderModal text-gray-400 hover:text-gray-600" data-id="{{ $reg->id }}">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Formulario -->
            <form action="{{ route('proveedores.update', $reg->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label for="edit_nombre_{{ $reg->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre del Proveedor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_nombre_{{ $reg->id }}" name="nombre" value="{{ $reg->nombre }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nombre') border-red-500 @enderror"
                            placeholder="Ingrese el nombre del proveedor">
                        @error('nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label for="edit_tipo_{{ $reg->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                            Tipo <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_tipo_{{ $reg->id }}" name="TipoProveedor_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('TipoProveedor_id') border-red-500 @enderror">
                            <option value="">Seleccione el tipo</option>
                            @foreach($tipos_proveedor as $tipo)
                                <option value="{{ $tipo->id }}" {{ $reg->TipoProveedor_id == $tipo->id ? 'selected' : '' }}>
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
                        <label for="edit_ruc_dni_{{ $reg->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                            RUC/DNI <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_ruc_dni_{{ $reg->id }}" name="ruc_dni" value="{{ $reg->ruc_dni }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ruc_dni') border-red-500 @enderror"
                            placeholder="Ingrese RUC o DNI">
                        @error('ruc_dni')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="edit_telefono_{{ $reg->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                            Teléfono <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_telefono_{{ $reg->id }}" name="telefono" value="{{ $reg->telefono }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('telefono') border-red-500 @enderror"
                            placeholder="Ingrese el teléfono">
                        @error('telefono')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Correo -->
                    <div>
                        <label for="edit_correo_{{ $reg->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                            Correo Electrónico
                        </label>
                        <input type="email" id="edit_correo_{{ $reg->id }}" name="correo" value="{{ $reg->correo }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('correo') border-red-500 @enderror"
                            placeholder="ejemplo@correo.com">
                        @error('correo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="md:col-span-2">
                        <label for="edit_direccion_{{ $reg->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                            Dirección
                        </label>
                        <textarea id="edit_direccion_{{ $reg->id }}" name="direccion" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('direccion') border-red-500 @enderror"
                            placeholder="Ingrese la dirección">{{ $reg->direccion }}</textarea>
                        @error('direccion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label for="edit_observaciones_{{ $reg->id }}" class="block text-sm font-medium text-gray-700 mb-1">
                            Observaciones
                        </label>
                        <textarea id="edit_observaciones_{{ $reg->id }}" name="observaciones" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('observaciones') border-red-500 @enderror"
                            placeholder="Observaciones adicionales">{{ $reg->observaciones }}</textarea>
                        @error('observaciones')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" class="cancelEditProvider px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors" data-id="{{ $reg->id }}">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-save mr-2"></i> Actualizar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
