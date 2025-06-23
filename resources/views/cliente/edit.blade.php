<!-- Modal Editar Cliente -->
<div id="editClientModal-{{ $cliente->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Editar Cliente</h3>
                <button class="closeEditClientModal text-gray-400 hover:text-gray-600" data-id="{{ $cliente->id }}">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Formulario -->
            <form id="editClientForm-{{ $cliente->id }}" action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label for="edit_name_{{ $cliente->id }}" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_name_{{ $cliente->id }}" name="name" value="{{ $cliente->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="edit_email_{{ $cliente->id }}" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
                        <input type="email" id="edit_email_{{ $cliente->id }}" name="email" value="{{ $cliente->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <!-- Documento -->
                    <div>
                        <label for="edit_documento_{{ $cliente->id }}" class="block text-sm font-medium text-gray-700 mb-1">Documento (DNI/RUC)</label>
                        <input type="text" id="edit_documento_{{ $cliente->id }}" name="documento" value="{{ $cliente->documento }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <!-- Teléfono -->
                    <div>
                        <label for="edit_telefono_{{ $cliente->id }}" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" id="edit_telefono_{{ $cliente->id }}" name="telefono" value="{{ $cliente->telefono }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <!-- Dirección -->
                    <div>
                        <label for="edit_direccion_{{ $cliente->id }}" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <input type="text" id="edit_direccion_{{ $cliente->id }}" name="direccion" value="{{ $cliente->direccion }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" class="cancelEditClient px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300" data-id="{{ $cliente->id }}">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"><i class="fas fa-save mr-2"></i>Actualizar Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div> 