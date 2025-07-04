<!-- Modal Eliminar Proveedor -->
<div id="deleteProviderModal-{{ $reg->id }}" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 md:mx-6 sm:mx-2 overflow-y-auto max-h-[90vh]">
        <!-- Encabezado -->
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Eliminar Proveedor</h3>
                    <p class="text-sm text-gray-500">ID: #{{ $reg->id }}</p>
                </div>
            </div>
            <button class="text-gray-400 hover:text-gray-600 transition-colors cancelDeleteProvider" data-id="{{ $reg->id }}">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Mensaje de Confirmación -->
        <div class="px-6 py-4 space-y-4">
            <div class="bg-red-50/50 border border-red-100 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-red-500 mt-0.5 mr-2"></i>
                    <div>
                        <p class="font-medium text-red-800">¿Está seguro de eliminar al proveedor?</p>
                        <p class="text-sm text-red-600 mt-1">
                            <strong>{{ $reg->nombre }}</strong> será eliminado permanentemente. 
                            Si tiene compras asociadas, no podrá eliminarlo.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
            <button type="button" class="cancelDeleteProvider px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors" data-id="{{ $reg->id }}">
                <i class="fas fa-times mr-2"></i> Cancelar
            </button>
            <form action="{{ route('proveedores.destroy', $reg->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
