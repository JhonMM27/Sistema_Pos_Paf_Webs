<div id="modalDeleteProduct" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300 overflow-y-auto">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 md:mx-6 sm:mx-2 max-h-[90vh]">
        <!-- Botón cerrar -->
        <button type="button" class="absolute top-3 right-3 text-red-600 hover:text-red-900 text-2xl close-modal"
            data-modal="modalDeleteProduct">
            <i class="fas fa-times"></i>
        </button>

        <!-- Título -->
        <h2 class="text-xl font-bold text-red-800 mb-4 flex items-center gap-2">
            <i class="fas fa-exclamation-triangle text-red-500"></i> Eliminar Producto
        </h2>

        <!-- Formulario -->
        <form id="formDeleteProduct" method="POST" action="">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="delete_id">

            <!-- Cuerpo del modal -->
            <div class="space-y-4">
                <!-- Mensaje de advertencia -->
                <div class="bg-red-50 border border-red-100 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-red-500 mt-0.5 mr-2"></i>
                        <div>
                            <p class="font-medium text-red-800">¿Está seguro de eliminar este producto?</p>
                            <p class="text-sm text-red-600 mt-1">Esta acción es permanente y no puede deshacerse.</p>
                        </div>
                    </div>
                </div>

                <!-- Campo nombre del producto -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Producto a eliminar</label>
                    <div class="relative">
                        <input type="text" name="nombre" id="delete_nombre" readonly
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 cursor-not-allowed">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex flex-col sm:flex-row justify-end gap-2">
                <button type="button"
                    class="close-modal px-4 py-2 rounded-md border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 transition"
                    data-modal="modalDeleteProduct">Cancelar</button>
                <button type="submit"
                    class="px-6 py-2 rounded-md bg-red-600 text-white font-bold hover:bg-red-700 transition">Eliminar</button>
            </div>
        </form>
    </div>
</div>
