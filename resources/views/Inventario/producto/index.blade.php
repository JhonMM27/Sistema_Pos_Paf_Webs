<div id="productsContent" class="tab-content">
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Gestión de Productos</h2>
        <button id="addProductBtn" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 mr-2">
            <i class="fas fa-plus mr-2"></i>Agregar Producto
        </button>
        <button id="exportProductsBtn" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
            <i class="fas fa-file-export mr-2"></i>Exportar
        </button>

        <!-- Product Filters -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="md:col-span-2">
                <label for="productSearch" class="block text-sm font-medium text-gray-700 mb-1">Buscar producto</label>
                <input type="text" id="productSearch" placeholder="Nombre, código de barras o categoría"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="productCategory" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select id="productCategory"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todas</option>
                    <option value="electronics">Electrónicos</option>
                    <option value="clothing">Ropa</option>
                    <option value="food">Alimentos</option>
                </select>
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Mostrar solo bajo stock</span>
                </label>
            </div>
        </div>

        <!-- Products Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Código de Barras</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{-- @if (count($registros) <= 0)
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle fs-4"></i> No hay registros disponibles
                            </td>
                        </tr>
                    @else --}}
                    {{-- @foreach ($registros as $reg) --}}
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1234567890123</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Electrónicos</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$1,299.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-2"><i
                                    class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                    {{-- @endif --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
