<!-- Modal para Editar Categoría -->
<div id="editCategoryModal-{{ $reg->id }}"
    class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300">
    <div
        class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 overflow-hidden border-l-4 border-blue-500 transform transition-all duration-300 scale-95 hover:scale-100">

        <!-- Encabezado -->
        <div class="bg-white px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">
                    Editar Categoría <span class="text-blue-600">#{{ $reg->id }}</span>
                </h3>
            </div>
            <button class="close-modal text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('categorias.update', $reg->id) }}">
            @csrf
            @method('PUT')
            <div class="px-6 py-4 space-y-5">
                <!-- Campo Nombre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        Nombre <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ $reg->nombre }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400"
                        placeholder="Ingrese el nombre de la categoría">
                </div>

                <!-- Campo Descripción -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>
                    <textarea name="descripcion" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400"
                        placeholder="Agregue una descripción opcional">{{ $reg->descripcion }}</textarea>
                </div>

                <!-- Campo Estado -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado
                    </label>
                    <select name="estado"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white pr-8">
                        <option value="1" {{ $reg->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $reg->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Pie del Modal -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
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
