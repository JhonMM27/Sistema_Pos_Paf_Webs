<!-- Modal para Eliminar Categoría -->
<div id="deleteCategoryModal-{{ $reg->id }}"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full border-t-4 border-red-600">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-red-600">
                <i class="fas fa-exclamation-triangle mr-2"></i>Eliminar Categoría
            </h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="deleteCategoryForm-{{ $reg->id }}" action="{{ route('categorias.destroy', $reg->id) }}" method="POST">
            @csrf
            @method('DELETE') <!-- Esto estaba mal como @method('destroy') -->
            <div class="mb-4">
                <p class="text-gray-800 font-semibold">¿Está seguro de que desea eliminar esta categoría?</p>
                <p class="text-gray-500 text-sm">Esta acción no se puede deshacer.</p>

                <input type="text" id="categoryName" name="nombre" value="{{ $reg->nombre }}" readonly
                    class="mt-3 w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-700 cursor-not-allowed">
            </div>

            <div class="flex justify-end space-x-3 mt-4">
                <button type="button"
                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 close-modal">Cancelar</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700">Eliminar</button>
            </div>
        </form>
    </div>
</div>


    <script>
        // document.getElementById("deleteCategoryBtn-{{ $reg->id }}").addEventListener('click', function() {
        //     document.getElementById("deleteCategoryModal-{{ $reg->id }}").classList.remove('hidden');
        // });


        document.addEventListener('DOMContentLoaded', function () {
        // Mostrar modal
        document.querySelectorAll('.delete-category').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('deleteCategoryModal-' + id).classList.remove('hidden');
            });
        });

        // Cerrar modal
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function () {
                this.closest('.fixed').classList.add('hidden');
            });
        });
    });
    </script>
