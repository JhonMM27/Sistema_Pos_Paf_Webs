<div id="deleteCategoryModal-{{ $reg->id }}"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden overflow-y-auto">
    <div
        class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 my-8 p-4 sm:p-6 border-l-4 border-red-500 overflow-y-auto max-h-[90vh] transition-all duration-300">

        <!-- Encabezado -->
        <div class="pb-4 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Eliminar Categoría</h3>
                    <p class="text-sm text-gray-500">ID: #{{ $reg->id }}</p>
                </div>
            </div>
            <button
                class="text-gray-400 hover:text-gray-600 transition-colors close-modal p-1 rounded-full hover:bg-gray-100">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Formulario -->
        <form id="deleteCategoryForm-{{ $reg->id }}" action="{{ route('categorias.destroy', $reg->id) }}" method="POST"
            class="mt-4 space-y-4">
            @csrf
            @method('DELETE')

            <!-- Advertencia -->
            <div class="bg-red-50/50 border border-red-100 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-red-500 mt-0.5 mr-2"></i>
                    <div>
                        <p class="font-medium text-red-800">¿Está seguro de eliminar esta categoría?</p>
                        <p class="text-sm text-red-600 mt-1">Esta acción es permanente y no puede deshacerse.</p>
                    </div>
                </div>
            </div>

            <!-- Campo categoría -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoría a eliminar</label>
                <div class="relative">
                    <input type="text" name="nombre" value="{{ $reg->nombre }}" readonly
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row justify-end gap-3">
                <button type="button"
                    class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors close-modal">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center">
                    <i class="fas fa-trash-alt mr-2"></i> Eliminar Permanentemente
                </button>
            </div>
        </form>
    </div>
</div>
