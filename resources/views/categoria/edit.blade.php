<!-- Modal para Editar Categoría -->
<div id="editCategoryModal-{{ $reg->id }}"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full border-t-4 border-blue-600 animate-fadeIn">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-blue-600">
                <i class="fas fa-pen mr-2"></i>Editar Categoría
            </h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="editCategoryForm-{{ $reg->id }}"
            action="{{ route('categorias.update', ['categoria' => $reg->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo: Nombre -->
            <div class="mb-4">
                <label for="categoryName-{{ $reg->id }}"
                    class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" id="categoryName-{{ $reg->id }}" name="nombre" value="{{ $reg->nombre }}"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Campo: Descripción -->
            <div class="mb-4">
                <label for="categoryDescription-{{ $reg->id }}"
                    class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="categoryDescription-{{ $reg->id }}" rows="3" name="descripcion"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion', $reg->descripcion) }}</textarea>
            </div>

            <!-- Campo: Estado -->
            <div class="mb-4">
                <label for="estado-{{ $reg->id }}"
                    class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select id="estado-{{ $reg->id }}" name="estado"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ $reg->estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $reg->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="button"
                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 close-modal">Cancelar</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar modal de edición
        document.querySelectorAll('.edit-category').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.id.split('-')[1];
                document.getElementById('editCategoryModal-' + id).classList.remove('hidden');
            });
        });

        // Cerrar cualquier modal
        document.querySelectorAll('.close-modal').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.fixed').classList.add('hidden');
            });
        });
    });
</script>
