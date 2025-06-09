    <!-- Modal para Agregar Categoría -->
    <div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Agregar Nueva Categoría</h3>
                <button class="text-gray-500 hover:text-gray-700 close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addCategoryForm" action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" id="categoryName" name="nombre" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="categoryDescription"
                        class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea id="categoryDescription" rows="3" name="descripcion"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="mb-4">
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select id="estado" name="estado"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>

                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 close-modal">Cancelar</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
