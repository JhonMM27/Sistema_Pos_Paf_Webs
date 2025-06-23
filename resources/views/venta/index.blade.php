@extends('layout.app')

@section('contenido')
    @push('estilos')
        <style>
            .status-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .status-completada {
                background-color: #dcfce7;
                color: #166534;
            }

            .status-pendiente {
                background-color: #fef3c7;
                color: #92400e;
            }

            .status-cancelada {
                background-color: #fee2e2;
                color: #991b1b;
            }

            .payment-badge {
                padding: 0.25rem 0.5rem;
                border-radius: 0.375rem;
                font-size: 0.75rem;
                font-weight: 500;
            }

            .payment-efectivo {
                background-color: #dbeafe;
                color: #1d4ed8;
            }

            .payment-tarjeta {
                background-color: #f3e8ff;
                color: #7c3aed;
            }

            .payment-transferencia {
                background-color: #ecfdf5;
                color: #047857;
            }

            .payment-yape {
                background-color: #f5f3ff;
                /* Un lila claro */
                color: #6d28d9;
                /* Un morado oscuro */
            }

            .payment-plin {
                background-color: #eff6ff;
                /* Un azul muy claro */
                color: #3b82f6;
                /* Un azul medio */
            }

            .table-hover tbody tr:hover {
                background-color: #f8fafc;
                transition: background-color 0.2s ease;
            }

            .search-input {
                transition: all 0.3s ease;
            }

            .search-input:focus {
                transform: scale(1.02);
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            }
        </style>
    @endpush

    <div class="w-full px-4 py-6">
        <main class="w-full px-4 md:px-6 py-6">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Gestión de Ventas</h1>
                        <p class="text-gray-600 mt-2">Administra y visualiza todas las ventas del sistema</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('ventas.create') }}"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center shadow-lg hover:shadow-xl">
                            <i class="fas fa-plus mr-2"></i>
                            Nueva Venta
                        </a>
                        <a href="{{ route('devoluciones.index') }}"
                            class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors flex items-center shadow-lg hover:shadow-xl">
                            <i class="fas fa-history mr-2"></i>
                            Ver Devoluciones
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Ventas Hoy</p>
                            <p class="text-2xl font-bold text-gray-900" id="ventasHoy">-</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Hoy</p>
                            <p class="text-2xl font-bold text-gray-900" id="totalHoy">-</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pendientes</p>
                            <p class="text-2xl font-bold text-gray-900" id="ventasPendientes">-</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Bajo Stock</p>
                            <p class="text-2xl font-bold text-gray-900" id="productosBajoStock">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-gray-100">
                <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <!-- Search -->
                        <div class="relative flex-1 max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="searchInput"
                                placeholder="Buscar por cliente, vendedor o ID de venta..."
                                class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Status Filter -->
                        <select id="statusFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Todos los estados</option>
                            <option value="completada">Completadas</option>
                            <option value="pendiente">Pendientes</option>
                            <option value="cancelada">Canceladas</option>
                        </select>

                        <!-- Date Range -->
                        <div class="flex gap-2">
                            <input type="date" id="dateFrom"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <span class="flex items-center text-gray-500">a</span>
                            <input type="date" id="dateTo"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <button id="clearFilters" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-times mr-2"></i>Limpiar
                    </button>
                </div>
            </div>

            <!-- Sales Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-hover">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cliente
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Vendedor
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Método Pago
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($ventas as $venta)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $venta->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($venta->cliente)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <img class="h-8 w-8 rounded-full object-cover"
                                                        src="https://ui-avatars.com/api/?name={{ urlencode($venta->cliente->name) }}&background=random"
                                                        alt="{{ $venta->cliente->name }}">
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $venta->cliente->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $venta->cliente->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 italic">Cliente general</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    src="https://ui-avatars.com/api/?name={{ urlencode($venta->vendedor->name) }}&background=random"
                                                    alt="{{ $venta->vendedor->name }}">
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $venta->vendedor->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $venta->fecha->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $venta->total_formateado }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $metodo = $venta->metodo_pago;
                                            $icon = '';
                                            switch ($metodo) {
                                                case 'efectivo':
                                                    $icon = 'fas fa-money-bill-wave';
                                                    break;
                                                case 'tarjeta':
                                                    $icon = 'fas fa-credit-card';
                                                    break;
                                                case 'transferencia':
                                                    $icon = 'fas fa-university';
                                                    break;
                                                case 'yape':
                                                    $icon = 'fas fa-mobile-alt';
                                                    break;
                                                case 'plin':
                                                    $icon = 'fas fa-bolt';
                                                    break;
                                            }
                                        @endphp
                                        <span class="payment-badge payment-{{ $metodo }} inline-flex items-center">
                                            <i class="{{ $icon }} mr-2"></i>
                                            {{ ucfirst($metodo) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-{{ $venta->estado }}">
                                            <i
                                                class="fas fa-{{ $venta->estado === 'completada' ? 'check-circle' : ($venta->estado === 'pendiente' ? 'clock' : 'times-circle') }} mr-1"></i>
                                            {{ ucfirst($venta->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('ventas.show', $venta->id) }}"
                                                class="text-blue-600 hover:text-blue-900" title="Ver Recibo">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if ($venta->estado === 'pendiente')
                                                <a href="{{ route('ventas.edit', $venta->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900" title="Editar Venta">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif

                                            @if ($venta->estado !== 'anulada')
                                                <form action="{{ route('ventas.anular', $venta->id) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de que quieres anular esta venta? El stock de los productos será restaurado.')"
                                                    class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        title="Anular Venta">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <i class="fas fa-box-open fa-3x mb-4"></i>
                                            <p class="text-lg font-medium">No se encontraron ventas</p>
                                            <p class="text-sm">Intenta ajustar los filtros o registra una nueva venta.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="p-6">
                    {{ $ventas->links() }}
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar resumen de ventas
            cargarResumen();

            // Event listeners para filtros
            document.getElementById('searchInput').addEventListener('input', filtrarVentas);
            document.getElementById('statusFilter').addEventListener('change', filtrarVentas);
            document.getElementById('dateFrom').addEventListener('change', filtrarVentas);
            document.getElementById('dateTo').addEventListener('change', filtrarVentas);
            document.getElementById('clearFilters').addEventListener('click', limpiarFiltros);

            // Mostrar notificaciones de sesión
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{{ session('error') }}',
                });
            @endif

            const forms = document.querySelectorAll('.form-anular');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro de anular esta venta?',
                        text: "Esta acción no se puede revertir. El stock de los productos será restaurado.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, anular',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });

        function cargarResumen() {
            fetch('{{ route('ventas.resumen') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('ventasHoy').textContent = data.resumen.ventas_hoy;
                        document.getElementById('totalHoy').textContent = 'S/ ' + parseFloat(data.resumen.total_hoy)
                            .toFixed(2);
                        document.getElementById('ventasPendientes').textContent = data.resumen.ventas_pendientes;
                        document.getElementById('productosBajoStock').textContent = data.resumen.productos_bajo_stock;
                    }
                })
                .catch(error => console.error('Error cargando resumen:', error));
        }

        function filtrarVentas() {
            const search = document.getElementById('searchInput').value;
            const status = document.getElementById('statusFilter').value;
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            // Construir URL con parámetros
            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (status) params.append('status', status);
            if (dateFrom) params.append('date_from', dateFrom);
            if (dateTo) params.append('date_to', dateTo);

            // Redirigir con filtros
            window.location.href = '{{ route('ventas.index') }}?' + params.toString();
        }

        function limpiarFiltros() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';

            window.location.href = '{{ route('ventas.index') }}';
        }

        function eliminarVenta(ventaId) {
            Swal.fire({
                title: '¿Eliminar venta?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/ventas/${ventaId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Eliminado!',
                                    text: data.message,
                                    timer: 2000,
                                    timerProgressBar: true
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error al eliminar la venta'
                            });
                        });
                }
            });
        }
    </script>
@endpush
