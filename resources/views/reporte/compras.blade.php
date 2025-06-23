@extends('layout.app')

@section('titulo', 'Reporte de Compras')

@section('contenido')
<div class="container mx-auto px-4 py-8 animate-fade-in">
    <!-- Header con animación -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-shopping-cart text-indigo-600 mr-3"></i>
                Reporte de Compras
            </h1>
            <p class="text-gray-600 mt-2">Análisis detallado de las adquisiciones del negocio</p>
        </div>
        <a href="{{ route('reportes.index') }}" class="flex items-center justify-center md:justify-start bg-white border border-gray-300 hover:border-indigo-500 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
            <i class="fas fa-arrow-left mr-2"></i>Volver al módulo
        </a>
    </div>

    <!-- Filtros mejorados -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
        <form method="GET" action="{{ route('reportes.compras') }}" class="space-y-4 md:space-y-0 md:flex md:items-end md:justify-between gap-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-grow">
                <div>
                    <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha Inicio</label>
                    <div class="relative">
                        <input type="date" name="fecha_inicio" id="fecha_inicio" 
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition duration-300 pl-10"
                               value="{{ $fechaInicio->format('Y-m-d') }}">
                        <i class="fas fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-1">Fecha Fin</label>
                    <div class="relative">
                        <input type="date" name="fecha_fin" id="fecha_fin" 
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition duration-300 pl-10"
                               value="{{ $fechaFin->format('Y-m-d') }}">
                        <i class="fas fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Agrupar por</label>
                    <div class="relative">
                        <select name="tipo" id="tipo" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition duration-300 pl-10">
                            <option value="diario" {{ $tipoReporte == 'diario' ? 'selected' : '' }}>Diario</option>
                            <option value="semanal" {{ $tipoReporte == 'semanal' ? 'selected' : '' }}>Semanal</option>
                            <option value="mensual" {{ $tipoReporte == 'mensual' ? 'selected' : '' }}>Mensual</option>
                        </select>
                        <i class="fas fa-layer-group absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button type="submit" class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-md">
                    <i class="fas fa-filter mr-2"></i>Filtrar
                </button>
                <a href="{{ route('reportes.exportar.compras', request()->query()) }}" 
                   class="flex items-center justify-center bg-white border border-red-500 hover:border-red-600 text-red-500 hover:text-red-600 px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-md" 
                   target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar
                </a>
            </div>
        </form>
    </div>

    <!-- Estadísticas con iconos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach([
            ['title' => 'Total Compras', 'value' => 'S/ '.number_format($totalCompras, 2), 'icon' => 'fas fa-receipt', 'color' => 'text-blue-500 bg-blue-50'],
            ['title' => 'Transacciones', 'value' => number_format($totalTransacciones), 'icon' => 'fas fa-exchange-alt', 'color' => 'text-green-500 bg-green-50'],
            ['title' => 'Promedio por Compra', 'value' => 'S/ '.number_format($promedioCompra, 2), 'icon' => 'fas fa-calculator', 'color' => 'text-purple-500 bg-purple-50'],
            ['title' => 'Agrupación', 'value' => ucfirst($tipoReporte), 'icon' => 'fas fa-calendar-alt', 'color' => 'text-amber-500 bg-amber-50']
        ] as $index => $stat)
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-indigo-100">
            <div class="flex items-center">
                <div class="{{ $stat['color'] }} p-3 rounded-lg mr-4">
                    <i class="{{ $stat['icon'] }} text-lg"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">{{ $stat['title'] }}</h4>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stat['value'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Gráfico de barras y Productos más comprados -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Gráfico de barras por proveedor -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Distribución por Proveedor</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">Total: S/ {{ number_format($totalCompras, 2) }}</span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="supplierBarChart"></canvas>
            </div>
        </div>

        <!-- Productos más comprados -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Productos Más Comprados</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-700 bg-gray-50">
                            <th class="py-3 px-4 rounded-tl-lg">Producto</th>
                            <th class="py-3 px-4 text-right">Cantidad</th>
                            <th class="py-3 px-4 text-right rounded-tr-lg">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($productosMasComprados as $producto)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-3 px-4 font-medium text-gray-900">
                                <div class="flex items-center">
                                    <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                                        <i class="fas fa-box-open text-sm"></i>
                                    </div>
                                    {{ $producto->producto->nombre ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-3 px-4 text-right">{{ number_format($producto->total_comprado) }}</td>
                            <td class="py-3 px-4 text-right font-bold text-indigo-600">S/ {{ number_format($producto->total_gastado, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-4 px-6 text-center text-gray-500">No hay productos para mostrar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabla de Compras Detalladas -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">Historial de Compras</h3>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">{{ $compras->count() }} registros</span>
                <div class="relative">
                    <select class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 py-1 px-3 pr-8 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        <option>Ordenar por fecha</option>
                        <option>Ordenar por monto</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-2 top-2 text-xs text-gray-500"></i>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-700 bg-gray-50">
                        <th class="py-3 px-4 rounded-tl-lg">ID</th>
                        <th class="py-3 px-4">Fecha</th>
                        <th class="py-3 px-4">Proveedor</th>
                        <th class="py-3 px-4">Registrado por</th>
                        <th class="py-3 px-4 text-right">Total</th>
                        <th class="py-3 px-4 text-right rounded-tr-lg">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($compras as $compra)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="py-3 px-4 font-medium text-indigo-600">#{{ $compra->id }}</td>
                        <td class="py-3 px-4">{{ $compra->fecha->format('d/m/Y') }}</td>
                        <td class="py-3 px-4">{{ $compra->proveedor ? $compra->proveedor->nombre : 'N/A' }}</td>
                        <td class="py-3 px-4">{{ $compra->user ? $compra->user->name : 'Sistema' }}</td>
                        <td class="py-3 px-4 text-right font-bold">S/ {{ number_format($compra->total, 2) }}</td>
                        <td class="py-3 px-4 text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $compra->estado == 'recibido' ? 'bg-green-100 text-green-800' : 
                                   ($compra->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($compra->estado) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-4 px-6 text-center text-gray-500">No hay compras en el período seleccionado</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos para el gráfico de barras
        const supplierData = {
            labels: {!! json_encode($comprasPorProveedor->keys()) !!},
            datasets: [{
                label: 'Total en S/',
                data: {!! json_encode($comprasPorProveedor->pluck('total')) !!},
                backgroundColor: [
                    'rgba(79, 70, 229, 0.7)',
                    'rgba(99, 102, 241, 0.7)',
                    'rgba(129, 140, 248, 0.7)',
                    'rgba(165, 180, 252, 0.7)',
                    'rgba(199, 210, 254, 0.7)'
                ],
                borderColor: [
                    'rgba(79, 70, 229, 1)',
                    'rgba(99, 102, 241, 1)',
                    'rgba(129, 140, 248, 1)',
                    'rgba(165, 180, 252, 1)',
                    'rgba(199, 210, 254, 1)'
                ],
                borderWidth: 1,
                borderRadius: 6,
                hoverBackgroundColor: [
                    'rgba(79, 70, 229, 1)',
                    'rgba(99, 102, 241, 1)',
                    'rgba(129, 140, 248, 1)',
                    'rgba(165, 180, 252, 1)',
                    'rgba(199, 210, 254, 1)'
                ]
            }]
        };

        // Configuración del gráfico de barras
        const ctx = document.getElementById('supplierBarChart').getContext('2d');
        const supplierBarChart = new Chart(ctx, {
            type: 'bar',
            data: supplierData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `S/ ${context.raw.toFixed(2)}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'S/ ' + value.toLocaleString();
                            }
                        },
                        grid: {
                            drawBorder: false,
                            color: "rgba(0, 0, 0, 0.05)"
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
    });
</script>

<!-- Animaciones CSS -->
<style>
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endpush
@endsection