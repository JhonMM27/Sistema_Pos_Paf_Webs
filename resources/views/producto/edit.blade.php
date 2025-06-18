<div id="modalEditProduct" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg relative">
        <button type="button" class="absolute top-3 right-3 text-green-600 hover:text-green-900 text-2xl close-modal" data-modal="modalEditProduct">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="text-xl font-bold text-green-800 mb-4 flex items-center gap-2">
            <i class="fas fa-edit text-green-500"></i> Editar Producto
        </h2>
        <form id="formEditProduct" autocomplete="off">
            <input type="hidden" name="id" id="edit_id">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-green-700 text-sm font-semibold mb-1">Nombre</label>
                    <input type="text" name="nombre" id="edit_nombre" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                    <span class="text-xs text-red-500 error-nombre"></span>
                </div>
                <div>
                    <label class="block text-green-700 text-sm font-semibold mb-1">Código de Barras</label>
                    <input type="text" name="codigo_barras" id="edit_codigo_barras" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                    <span class="text-xs text-red-500 error-codigo_barras"></span>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-green-700 text-sm font-semibold mb-1">Descripción</label>
                    <textarea name="descripcion" id="edit_descripcion" rows="2" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm"></textarea>
                    <span class="text-xs text-red-500 error-descripcion"></span>
                </div>
                <div>
                    <label class="block text-green-700 text-sm font-semibold mb-1">Unidad</label>
                    <input type="text" name="unidad" id="edit_unidad" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                    <span class="text-xs text-red-500 error-unidad"></span>
                </div>
                <div>
                    <label class="block text-green-700 text-sm font-semibold mb-1">Precio</label>
                    <input type="number" step="0.01" name="precio" id="edit_precio" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                    <span class="text-xs text-red-500 error-precio"></span>
                </div>
                <div>
                    <label class="block text-green-700 text-sm font-semibold mb-1">Stock</label>
                    <input type="number" name="stock" id="edit_stock" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                    <span class="text-xs text-red-500 error-stock"></span>
                </div>
                <div>
                    <label class="block text-green-700 text-sm font-semibold mb-1">Estado</label>
                    <select name="estado" id="edit_estado" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <span class="text-xs text-red-500 error-estado"></span>
                </div>
                <div>
                    <label class="block text-green-700 text-sm font-semibold mb-1">Categoría</label>
                    <select name="categoria_id" id="edit_categoria_id" class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm" required>
                        <option value="">Seleccione</option>
                        {{-- @foreach ($categorias as $cat) --}}
                        {{-- <option value="{{ $cat->id }}">{{ $cat->nombre }}</option> --}}
                        {{-- @endforeach --}}
                    </select>
                    <span class="text-xs text-red-500 error-categoria_id"></span>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-2">
                <button type="button" class="close-modal px-4 py-2 rounded-md border border-green-200 bg-green-50 text-green-700 hover:bg-green-100 transition" data-modal="modalEditProduct">Cancelar</button>
                <button type="submit" class="px-6 py-2 rounded-md bg-green-600 text-white font-bold hover:bg-green-700 transition">Actualizar</button>
            </div>
        </form>
    </div>
</div>