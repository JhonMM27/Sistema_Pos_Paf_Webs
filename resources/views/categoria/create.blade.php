<!-- Modal para Agregar Nueva Categoría -->
<div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full border-t-4 border-green-600 animate-fadeIn">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-green-600">
                <i class="fas fa-plus-circle mr-2"></i>Agregar Nueva Categoría
            </h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="addCategoryForm" action="{{ route('categorias.store') }}" method="POST">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" id="categoryName" name="nombre" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="categoryDescription" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="categoryDescription" rows="3" name="descripcion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select id="estado" name="estado"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="button"
                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 close-modal">Cancelar</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700">Guardar</button>
            </div>
        </form>
    </div>
</div>
