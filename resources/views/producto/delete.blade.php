<div id="modalDeleteProduct" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md relative">
        <button type="button" class="absolute top-3 right-3 text-green-600 hover:text-green-900 text-2xl close-modal" data-modal="modalDeleteProduct">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="text-xl font-bold text-green-800 mb-4 flex items-center gap-2">
            <i class="fas fa-trash text-red-500"></i> Eliminar Producto
        </h2>
        <form id="formDeleteProduct">
            <input type="hidden" name="id" id="delete_id">
            <p class="text-green-700 mb-6">¿Estás seguro que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
            <div class="flex justify-end gap-2">
                <button type="button" class="close-modal px-4 py-2 rounded-md border border-green-200 bg-green-50 text-green-700 hover:bg-green-100 transition" data-modal="modalDeleteProduct">Cancelar</button>
                <button type="submit" class="px-6 py-2 rounded-md bg-red-600 text-white font-bold hover:bg-red-700 transition">Eliminar</button>
            </div>
        </form>
    </div>
</div>