<div id="addCategoryModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl overflow-hidden w-full max-w-md mx-4 my-8 border-t-4 border-green-500 animate-[fadeIn_0.3s_ease-out] max-h-[90vh] p-4 sm:p-6 overflow-y-auto">
        <!-- Encabezado del Modal -->
        <div class="bg-gradient-to-r from-green-50 to-white px-4 sm:px-6 py-3 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-plus-circle text-green-600 text-lg"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800">
                        Nueva Categoría
                    </h3>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition-colors close-modal p-1 rounded-full hover:bg-gray-100">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Contenido del Formulario -->
        <form id="addCategoryForm" action="{{ route('categorias.store') }}" method="POST" class="mt-4 space-y-5">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Nombre <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-tag text-gray-400"></i>
                    </div>
                    <input type="text" id="categoryName" name="nombre" required
                        class="pl-10 w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 placeholder-gray-400 transition-all"
                        placeholder="Ej. Electrónicos">
                </div>
            </div>

            <!-- Descripción -->
            <div>
                <label for="categoryDescription" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Descripción
                </label>
                <div class="relative">
                    <div class="absolute top-3 left-3">
                        <i class="fas fa-align-left text-gray-400"></i>
                    </div>
                    <textarea id="categoryDescription" rows="3" name="descripcion"
                        class="pl-10 w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 placeholder-gray-400 transition-all resize-none"
                        placeholder="Breve descripción de la categoría"></textarea>
                </div>
            </div>

            <!-- Estado -->
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Estado
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-toggle-on text-gray-400"></i>
                    </div>
                    <select id="estado" name="estado"
                        class="pl-10 w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 appearance-none bg-white transition-all">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row justify-end gap-3">
                <button type="button"
                    class="close-modal px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                    <i class="fas fa-times mr-2"></i> Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-save mr-2"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>
