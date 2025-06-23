<!-- Modal Eliminar Cliente -->
<div id="deleteClientModal-{{ $cliente->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-1/4 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <!-- Icono de advertencia -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <!-- Título -->
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">¿Eliminar Cliente?</h3>
            <!-- Mensaje -->
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    ¿Estás seguro de que deseas eliminar al cliente
                    <span class="font-bold">{{ $cliente->name }}</span>?
                    Esta acción no se puede deshacer.
                </p>
            </div>
            <!-- Formulario y Botones -->
            <form id="deleteClientForm-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <div class="items-center px-4 py-3">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <i class="fas fa-trash-alt mr-2"></i>Sí, eliminar
                    </button>
                    <button type="button" class="cancelDeleteClient mt-3 px-4 py-2 bg-gray-200 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500" data-id="{{ $cliente->id }}">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 