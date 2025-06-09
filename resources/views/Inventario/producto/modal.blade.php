<div id="addProductModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Agregar Nuevo Producto</h3>
            <button class="text-gray-500 hover:text-gray-700 close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="addProductForm">
            <div class="mb-4">
                <label for="productName" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" id="productName" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="productBarcode" class="block text-sm font-medium text-gray-700 mb-1">Código de
                    Barras</label>
                <input type="text" id="productBarcode" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="productDescription" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="productDescription" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="productUnit" class="block text-sm font-medium text-gray-700 mb-1">Unidad</label>
                <input type="text" id="productUnit" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="productPrice" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                <input type="text" id="productPrice" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="productStock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                <input type="number" id="productStock" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="productStatus" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select id="productStatus"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="active">Activo</option>
                    <option value="inactive">Inactivo</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="productCategory" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select id="productCategory"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="electronics">Electrónicos</option>
                    <option value="clothing">Ropa</option>
                    <option value="food">Alimentos</option>
                </select>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button"
                    class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50 close-modal">Cancelar</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>
