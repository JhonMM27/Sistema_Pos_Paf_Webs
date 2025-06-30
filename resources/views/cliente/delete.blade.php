<!-- Modal Eliminar Cliente -->
<div id="deleteClientModal-{{ $cliente->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden">
    <div class="bg-white w-full max-w-md mx-4 rounded-xl shadow-2xl overflow-hidden animate-[fadeIn_0.3s_ease-out]">
        <!-- Encabezado -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-red-50 to-white flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-red-100 p-2 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Confirmar Eliminación</h3>
            </div>
            <button class="cancelDeleteClient text-gray-400 hover:text-gray-600 transition-colors" data-id="{{ $cliente->id }}">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Contenido -->
        <div class="px-6 py-6 text-center space-y-4">
            <p class="text-gray-700 text-sm">
                ¿Estás seguro de que deseas eliminar al cliente
                <span class="font-bold text-red-600">{{ $cliente->name }}</span>?
                Esta acción no se puede deshacer.
            </p>
        </div>

        <!-- Formulario -->
        <form id="deleteClientForm-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <!-- Botones -->
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="button"
                    class="cancelDeleteClient px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
                    data-id="{{ $cliente->id }}">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Eliminar
                </button>
            </div>
        </form>
    </div>
</div>
