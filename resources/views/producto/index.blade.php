@extends('layout.app')
@section('contenido')

<main class="flex-1 p-4 md:p-6">
    <div id="productsContent" class="tab-content">
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 border border-gray-100">
            
            <!-- ENCABEZADO -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-green-800 flex items-center gap-2">
                        <i class="fas fa-boxes-stacked text-green-500 text-xl"></i> Gestión de Productos
                    </h1>
                    <p class="text-green-600 text-sm mt-1 flex items-center gap-2">
                        <i class="fas fa-warehouse"></i> Administra los productos del inventario
                    </p>
                </div>
                <button id="addProductBtn"
                    class="flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                    <i class="fas fa-plus-circle mr-2"></i> Agregar Producto
                </button>
            </div>

            <!-- FILTROS -->
            <form method="GET" class="bg-green-50 p-4 rounded-lg mb-6 border border-green-100">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="md:col-span-5">
                        <label for="texto" class="block text-sm font-medium text-green-700 mb-1">Buscar producto</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-green-400">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="texto" name="texto" value="{{ request('texto') }}" placeholder="Nombre, código de barras o categoría"
                                class="w-full pl-10 pr-4 py-2 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400 text-sm shadow-sm">
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <label for="categoria_id" class="block text-sm font-medium text-green-700 mb-1">Categoría</label>
                        <select id="categoria_id" name="categoria_id" class="w-full px-3 py-2 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400 text-sm shadow-sm">
                            <option value="">Todas</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="estado" class="block text-sm font-medium text-green-700 mb-1">Estado</label>
                        <select id="estado" name="estado" class="w-full px-3 py-2 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400 text-sm shadow-sm">
                            <option value="">Todos</option>
                            <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex gap-2 mt-6 md:mt-0">
                        <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold shadow transition">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('productos.index') }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md font-semibold shadow transition">
                            <i class="fas fa-sync-alt"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>

            <!-- TABLA DE PRODUCTOS -->
            <div class="overflow-hidden rounded-lg border border-green-100 shadow-sm">
                <table class="min-w-full divide-y divide-green-100">
                    <thead class="bg-gradient-to-r from-green-100 via-green-50 to-green-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">Código de Barras</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">Unidad</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-green-600 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-green-50">
                        @forelse ($registros as $reg)
                        <tr class="hover:bg-green-50 transition-colors group">
                            <td class="px-6 py-4 text-sm font-medium text-green-700">#{{ $reg->id }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-green-900">{{ $reg->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-green-700">{{ $reg->codigo_barras }}</td>
                            <td class="px-6 py-4 text-sm text-green-700">{{ $reg->categoria->nombre ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-green-700">S/ {{ number_format($reg->precio, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-green-700">{{ $reg->stock }}</td>
                            <td class="px-6 py-4 text-sm text-green-700">{{ $reg->unidad }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if ($reg->estado == 1)
                                <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800 shadow-sm">
                                    <i class="fas fa-check-circle mr-1"></i> Activo
                                </span>
                                @else
                                <span class="px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800 shadow-sm">
                                    <i class="fas fa-times-circle mr-1"></i> Inactivo
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center text-sm">
                                <div class="flex justify-center gap-2">
                                    <button id="editProductBtn-{{ $reg->id }}" title="Editar"
                                        class="edit-product text-green-600 hover:text-green-900 p-1 rounded-full hover:bg-green-100 transition-all">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-id="{{ $reg->id }}" title="Eliminar"
                                        class="delete-product text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-100 transition-all">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center text-green-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <i class="fas fa-box-open text-5xl text-green-200 mb-2 animate-bounce"></i>
                                    <p class="text-green-500">No hay productos registrados</p>
                                    <button id="addProductBtn" class="mt-4 text-sm text-green-700 hover:text-green-900 flex items-center gap-2">
                                        <i class="fas fa-plus-circle"></i> Crear primer producto
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($registros->hasPages())
            <div class="flex flex-col md:flex-row items-center justify-between mt-6 pt-4 border-t border-green-100">
                <div class="text-sm text-green-500 mb-4 md:mb-0">
                    {{-- Mostrando {{ $registros->firstItem() }} a {{ $registros->lastItem() }} de {{ $registros->total() }} resultados --}}
                </div>
                <div class="flex items-center space-x-1">
                    {{ $registros->links('vendor.pagination.tailwind') }}
                </div>
            </div>
            @endif

        </div>
    </div>
</main>

{{-- MODALES CRUD --}}
@include('producto.create')
@include('producto.edit')
@include('producto.delete')

@endsection

@push('scripts')
<script>
    function getCSRFToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    async function fillSelectCategorias(selectId, selected = null) {
        try {
            const res = await fetch("{{ route('productos.categorias') }}");
            const data = await res.json();
            const select = document.getElementById(selectId) || document.querySelector('select[name="' + selectId + '"]');
            if (!select) return;
            select.innerHTML = '<option value="">Seleccione</option>';
            data.forEach(cat => {
                const selectedAttr = selected == cat.id ? 'selected' : '';
                select.innerHTML += `<option value="${cat.id}" ${selectedAttr}>${cat.nombre}</option>`;
            });
        } catch (err) {
            console.error('Error al cargar categorías', err);
        }
    }

    function showModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function hideModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function clearForm(form) {
        form.reset();
        form.querySelectorAll('span.text-red-500').forEach(e => e.textContent = '');
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Abrir crear
        document.querySelectorAll('#addProductBtn').forEach(btn => {
            btn.addEventListener('click', async () => {
                clearForm(document.getElementById('formCreateProduct'));
                await fillSelectCategorias('categoria_id');
                showModal('modalCreateProduct');
            });
        });

        // Cerrar modales
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.getAttribute('data-modal');
                hideModal(modal);
            });
        });

        // Crear producto (AJAX)
        const formCreate = document.getElementById('formCreateProduct');
        if (formCreate) {
            formCreate.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                form.querySelectorAll('span.text-red-500').forEach(e => e.textContent = '');
                const data = new FormData(form);
                fetch("{{ route('productos.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCSRFToken()
                    },
                    body: data
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        hideModal('modalCreateProduct');
                        Swal.fire('¡Éxito!', res.mensaje, 'success').then(() => location.reload());
                    } else {
                        if (res.errors) {
                            Object.keys(res.errors).forEach(key => {
                                form.querySelector('.error-' + key).textContent = res.errors[key][0];
                            });
                        } else {
                            Swal.fire('Error', res.mensaje || 'Ocurrió un error', 'error');
                        }
                    }
                })
                .catch(() => Swal.fire('Error', 'Ocurrió un error inesperado', 'error'));
            });
        }

        // Editar producto (abrir modal y cargar datos)
        document.querySelectorAll('.edit-product').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.id.replace('editProductBtn-', '');
                const res = await fetch(`/inventario/productos/${id}/edit`);
                const data = await res.json();
                const form = document.getElementById('formEditProduct');
                form.querySelector('#edit_id').value = data.id;
                form.querySelector('#edit_nombre').value = data.nombre;
                form.querySelector('#edit_codigo_barras').value = data.codigo_barras;
                form.querySelector('#edit_descripcion').value = data.descripcion || '';
                form.querySelector('#edit_unidad').value = data.unidad;
                form.querySelector('#edit_precio').value = data.precio;
                form.querySelector('#edit_stock').value = data.stock;
                form.querySelector('#edit_estado').value = data.estado;
                await fillSelectCategorias('edit_categoria_id', data.categoria_id);
                form.querySelectorAll('span.text-red-500').forEach(e => e.textContent = '');
                showModal('modalEditProduct');
            });
        });

        // Editar producto (AJAX)
        const formEdit = document.getElementById('formEditProduct');
        if (formEdit) {
            formEdit.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                form.querySelectorAll('span.text-red-500').forEach(e => e.textContent = '');
                const id = form.querySelector('#edit_id').value;
                const data = new FormData(form);
                data.append('_method', 'PUT');
                fetch(`/inventario/productos/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCSRFToken()
                    },
                    body: data
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        hideModal('modalEditProduct');
                        Swal.fire('¡Actualizado!', res.mensaje, 'success').then(() => location.reload());
                    } else {
                        if (res.errors) {
                            Object.keys(res.errors).forEach(key => {
                                form.querySelector('.error-' + key).textContent = res.errors[key][0];
                            });
                        } else {
                            Swal.fire('Error', res.mensaje || 'Ocurrió un error', 'error');
                        }
                    }
                })
                .catch(() => Swal.fire('Error', 'Ocurrió un error inesperado', 'error'));
            });
        }

        // Eliminar producto (abrir modal)
        document.querySelectorAll('.delete-product').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                document.getElementById('delete_id').value = id;
                showModal('modalDeleteProduct');
            });
        });

        // Eliminar producto (AJAX)
        const formDelete = document.getElementById('formDeleteProduct');
        if (formDelete) {
            formDelete.addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('delete_id').value;
                fetch(`/inventario/productos/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': getCSRFToken(),
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: '_method=DELETE'
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        hideModal('modalDeleteProduct');
                        Swal.fire('¡Eliminado!', res.mensaje, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error', res.mensaje || 'Ocurrió un error', 'error');
                    }
                })
                .catch(() => Swal.fire('Error', 'Ocurrió un error inesperado', 'error'));
            });
        }

        // Filtros
        fillSelectCategorias('categoria_id');
    });
</script>
@endpush
