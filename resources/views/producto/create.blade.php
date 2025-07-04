<div id="modalCreateProduct" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 md:mx-6 sm:mx-2 overflow-y-auto max-h-[90vh]">
        <!-- Botón cerrar -->
        <button type="button" class="absolute top-3 right-3 text-green-600 hover:text-green-900 text-2xl close-modal"
            data-modal="modalCreateProduct">
            <i class="fas fa-times"></i>
        </button>

        <!-- Título -->
        <h2 class="text-xl font-bold text-green-800 mb-4 flex items-center gap-2">
            <i class="fas fa-plus-circle text-green-500"></i> Nuevo Producto
        </h2>

        <!-- Formulario -->
        <form id="formCreateProduct" method="POST" action="{{ route('productos.store') }}" autocomplete="off">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <!-- Nombre -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('nombre') border-red-500 @enderror"
                        required>
                    @error('nombre')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Código de Barras -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Código de Barras</label>
                    <input type="text" name="codigo_barras" value="{{ old('codigo_barras') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('codigo_barras') border-red-500 @enderror"
                        required>
                    @error('codigo_barras')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="sm:col-span-2">
                    <label class="block text-green-700 text-sm font-medium mb-1">Descripción</label>
                    <textarea name="descripcion" rows="2"
                        class="w-full rounded-md border border-green-300 px-3 py-2 focus:ring-2 focus:ring-green-400 text-sm resize-none @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Precio Venta -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Precio Venta</label>
                    <input type="number" step="0.01" name="precio" value="{{ old('precio') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('precio') border-red-500 @enderror"
                        required>
                    @error('precio')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Precio Compra -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Precio Compra</label>
                    <input type="number" step="0.01" name="precio_compra" value="{{ old('precio_compra') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('precio_compra') border-red-500 @enderror"
                        required>
                    @error('precio_compra')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock') }}"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('stock') border-red-500 @enderror"
                        required>
                    @error('stock')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label class="block text-green-700 text-sm font-medium mb-1">Estado</label>
                    <select name="estado"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('estado') border-red-500 @enderror"
                        required>
                        <option value="1" {{ old('estado', '1') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Categoría -->
                <div class="sm:col-span-2">
                    <label class="block text-green-700 text-sm font-medium mb-1">Categoría</label>
                    <select name="categoria_id"
                        class="w-full rounded-md border border-green-300 px-3 py-1.5 focus:ring-2 focus:ring-green-400 text-sm @error('categoria_id') border-red-500 @enderror"
                        required>
                        <option value="">Seleccione</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex flex-col sm:flex-row justify-end gap-2">
                <button type="button"
                    class="close-modal px-4 py-2 rounded-md border border-green-200 bg-green-50 text-green-700 hover:bg-green-100 transition"
                    data-modal="modalCreateProduct">Cancelar</button>
                <button type="submit"
                    class="px-6 py-2 rounded-md bg-green-600 text-white font-bold hover:bg-green-700 transition">Guardar</button>
            </div>
        </form>
    </div>
</div>
