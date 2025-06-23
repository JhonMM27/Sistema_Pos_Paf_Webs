<!-- Modal Eliminar Proveedor -->
<div id="deleteProviderModal-{{ $reg->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <!-- Icono de advertencia -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            
            <!-- Título -->
            <h3 class="text-lg font-medium text-gray-900 mb-2">Confirmar Eliminación</h3>
            
            <!-- Mensaje -->
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 mb-4">
                    ¿Está seguro que desea eliminar el proveedor <strong>"{{ $reg->nombre }}"</strong>?
                </p>
                <p class="text-xs text-gray-400">
                    Esta acción no se puede deshacer. Si el proveedor tiene compras asociadas, no se podrá eliminar.
                </p>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-center space-x-3 px-4 py-3">
                <button type="button" class="cancelDeleteProvider px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors" data-id="{{ $reg->id }}">
                    Cancelar
                </button>
                <form action="{{ route('proveedores.destroy', $reg->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-trash mr-2"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    // Funcionalidad del modal de eliminar proveedor
    document.querySelector('.delete-provider[data-id="{{ $reg->id }}"]').addEventListener('click', function() {
        document.getElementById('deleteProviderModal-{{ $reg->id }}').classList.remove('hidden');
    });

    document.querySelector('.cancelDeleteProvider[data-id="{{ $reg->id }}"]').addEventListener('click', function() {
        document.getElementById('deleteProviderModal-{{ $reg->id }}').classList.add('hidden');
    });

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('deleteProviderModal-{{ $reg->id }}').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
</script>  --}}