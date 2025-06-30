<div id="editCategoryModal-{{ $reg->id }}"
    class="fixed inset-0 z-50 flex hidden items-center justify-center bg-gray-500 bg-opacity-50 backdrop-blur-sm overflow-y-auto">
    <div
        class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 my-8 p-4 sm:p-6 border-l-4 border-blue-500 overflow-y-auto max-h-[90vh] transition-all duration-300">

        <!-- Encabezado -->
        <div class="bg-white border-b border-gray-100 pb-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800">
                    Editar Categoría <span class="text-blue-600">#{{ $reg->id }}</span>
                </h3>
            </div>
            <button class="close-modal text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('categorias.update', $reg->id) }}" class="mt-4 space-y-5">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Nombre <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nombre" value="{{ $reg->nombre }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 text-sm transition-all"
                    placeholder="Ingrese el nombre de la categoría">
            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Descripción
                </label>
                <textarea name="descripcion" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 text-sm resize-none transition-all"
                    placeholder="Agregue una descripción opcional">{{ $reg->descripcion }}</textarea>
            </div>

            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Estado
                </label>
                <div class="relative">
                    <select name="estado"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white pr-8 text-sm appearance-none">
                        <option value="1" {{ $reg->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $reg->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Pie del Modal -->
            <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row justify-end gap-3">
                <button type="button"
                    class="close-modal px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
