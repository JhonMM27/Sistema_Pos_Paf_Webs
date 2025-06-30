<div id="modalEditProduct" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-30 hidden overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto my-10 p-4 sm:p-6 relative max-h-[90vh] overflow-y-auto">
        <!-- Botón cerrar -->
        <button type="button" class="absolute top-3 right-3 text-green-600 hover:text-green-900 text-2xl close-modal"
            data-modal="modalEditProduct">
            <i class="fas fa-times"></i>
        </button>

        <!-- Título -->
        <h2 class="text-xl font-bold text-green-800 mb-4 flex items-center gap-2">
            <i class="fas fa-edit text-green-500"></i> Editar Producto
        </h2>

        <!-- Formulario -->
        <form id="formEditProduct" method="POST" action="" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_id">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <!-- Nombre -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" id="edit_nombre" value="{{ old('nombre') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('nombre') border-red-500 @enderror"
                        required>
                    @error('nombre') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Código de Barras -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Código de Barras</label>
                    <input type="text" name="codigo_barras" id="edit_codigo_barras" value="{{ old('codigo_barras') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('codigo_barras') border-red-500 @enderror"
                        required>
                    @error('codigo_barras') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Descripción -->
                <div class="sm:col-span-2">
                    <label class="block text-green-700 text-sm font-medium mb-1">Descripción</label>
                    <textarea name="descripcion" id="edit_descripcion" rows="2"
                        class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm resize-none @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Precio Venta -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Precio Venta</label>
                    <input type="number" step="0.01" name="precio" id="edit_precio" value="{{ old('precio') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('precio') border-red-500 @enderror"
                        required>
                    @error('precio') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Precio Compra -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Precio Compra</label>
                    <input type="number" step="0.01" name="precio_compra" id="edit_precio_compra" value="{{ old('precio_compra') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('precio_compra') border-red-500 @enderror"
                        required>
                    @error('precio_compra') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Stock</label>
                    <input type="number" name="stock" id="edit_stock" value="{{ old('stock') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('stock') border-red-500 @enderror"
                        required>
                    @error('stock') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Estado</label>
                    <select name="estado" id="edit_estado"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('estado') border-red-500 @enderror"
                        required>
                        <option value="1" {{ old('estado', '1') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Categoría -->
                <div class="sm:col-span-2">
                    <label class="block text-green-700 text-sm font-medium mb-1">Categoría</label>
                    <select name="categoria_id" id="edit_categoria_id"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('categoria_id') border-red-500 @enderror"
                        required>
                        <option value="">Seleccione</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex flex-col sm:flex-row justify-end gap-2">
                <button type="button"
                    class="close-modal px-4 py-2 rounded-md border border-green-200 bg-green-50 text-green-700 hover:bg-green-100 transition"
                    data-modal="modalEditProduct">Cancelar</button>
                <button type="submit"
                    class="px-6 py-2 rounded-md bg-green-600 text-white font-bold hover:bg-green-700 transition">Actualizar</button>
            </div>
        </form>
    </div>
</div>
