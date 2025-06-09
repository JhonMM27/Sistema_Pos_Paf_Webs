<div id="categoriesContent" class="tab-content hidden">
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Gestión de Categorías</h2>
        <button id="addCategoryBtn" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 mr-2">
            <i class="fas fa-plus mr-2"></i>Agregar Categoría
        </button>
        <button id="exportCategoriesBtn" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
            <i class="fas fa-file-export mr-2"></i>Exportar
        </button>

        <!-- Category Filters -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="categorySearch" class="block text-sm font-medium text-gray-700 mb-1">Buscar
                    categoría</label>
                <input type="text" id="categorySearch" placeholder="Nombre o ID de categoría"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="categoryStatus" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select id="categoryStatus"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Todos</option>
                    <option value="active">Activo</option>
                    <option value="inactive">Inactivo</option>
                </select>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($registros->isEmpty())
                        <p>No hay categorías registradas.</p>
                    @else
                        @foreach ($registros as $reg)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reg->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $reg->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reg->descripcion }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($reg->estado == 1)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $reg->estado == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                    @endif
                                    @if ($reg->estado == 0)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ $reg->estado == 1 ? 'Activo' : 'Inactivo' }}
                                        
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-blue-600 hover:text-blue-900 mr-2 edit-category"
                                        data-id="{{ $reg->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 delete-category"
                                        data-id="{{ $reg->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $registros->links() }}
        </div>
    </div>
</div>




{{-- Cuerpo de la tarjeta --}}
<div class="card-body">
    {{-- Mensajes de alerta --}}
    @if (Session::has('mensaje'))
        <div id="successModal" class="fixed top-4 right-4 z-50 bg-green-500 text-white py-2 px-4 rounded-md shadow-md opacity-0 transition-opacity duration-1000">
            <div class="flex items-center">
                <i class="bi bi-check-circle mr-2"></i>
                <span>{{ Session::get('mensaje') }}</span>
            </div>
        </div>
    @endif

    @if (Session::has('error'))
        <div id="errorModal" class="fixed top-4 right-4 z-50 bg-red-500 text-white py-2 px-4 rounded-md shadow-md opacity-0 transition-opacity duration-1000">
            <div class="flex items-center">
                <i class="bi bi-exclamation-triangle mr-2"></i>
                <span>{{ Session::get('error') }}</span>
            </div>
        </div>
    @endif
</div>


<script>
    // Mostrar el modal si hay un mensaje
    window.onload = function() {
        // Success message
        const successModal = document.getElementById("successModal");
        const errorModal = document.getElementById("errorModal");

        if (successModal) {
            successModal.classList.remove("opacity-0");
            successModal.classList.add("opacity-100");
            setTimeout(() => {
                successModal.classList.remove("opacity-100");
                successModal.classList.add("opacity-0");
            }, 3000);
        }

        if (errorModal) {
            errorModal.classList.remove("opacity-0");
            errorModal.classList.add("opacity-100");
            setTimeout(() => {
                errorModal.classList.remove("opacity-100");
                errorModal.classList.add("opacity-0");
            }, 3000);
        }
    }
</script>
