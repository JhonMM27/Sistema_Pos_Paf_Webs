@extends('layout.app')

@section('titulo', 'Reporte de Ventas')
@section('estilos')
<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.6s ease-out forwards;
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    .animate-fade-in-left {
        animation: fadeInLeft 0.6s ease-out forwards;
    }
    .animate-fade-in-right {
        animation: fadeInRight 0.6s ease-out forwards;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
@endsection

@section('contenido')
<div class="container mx-auto px-4 py-8">
    <!-- Header con animación -->
    <div class="flex items-center justify-between mb-8 animate-fade-in-down">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Reporte de Ventas</h1>
            <p class="text-gray-600">Análisis detallado de las ventas del negocio</p>
        </div>
        <a href="{{ route('reportes.index') }}" class="flex items-center bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg transition-all duration-300 transform hover:-translate-x-1">
            <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
    </div>

    <!-- Filtros con animación -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 animate-fade-in-up">
        <form method="GET" action="{{ route('reportes.ventas') }}" class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-grow">
                <div>
                    <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-300" value="{{ $fechaInicio->format('Y-m-d') }}">
                </div>
                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-1">Fecha Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-300" value="{{ $fechaFin->format('Y-m-d') }}">
                </div>
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Agrupar por</label>
                    <select name="tipo" id="tipo" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-300">
                        <option value="diario" {{ $tipoReporte == 'diario' ? 'selected' : '' }}>Diario</option>
                        <option value="semanal" {{ $tipoReporte == 'semanal' ? 'selected' : '' }}>Semanal</option>
                        <option value="mensual" {{ $tipoReporte == 'mensual' ? 'selected' : '' }}>Mensual</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-md">
                    <i class="fas fa-filter mr-2"></i>Filtrar
                </button>
                <a href="{{ route('reportes.exportar.ventas', request()->query()) }}" class="flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-md" target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar
                </a>
            </div>
        </form>
    </div>

    <!-- Estadísticas con animaciones escalonadas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach([
            ['title' => 'Total Ventas', 'value' => 'S/ '.number_format($totalVentas, 2), 'icon' => 'fas fa-wallet', 'color' => 'bg-blue-100 text-blue-600'],
            ['title' => 'Transacciones', 'value' => number_format($totalTransacciones), 'icon' => 'fas fa-receipt', 'color' => 'bg-green-100 text-green-600'],
            ['title' => 'Promedio por Venta', 'value' => 'S/ '.number_format($promedioVenta, 2), 'icon' => 'fas fa-chart-line', 'color' => 'bg-purple-100 text-purple-600'],
            ['title' => 'Agrupación', 'value' => ucfirst($tipoReporte), 'icon' => 'fas fa-calendar', 'color' => 'bg-amber-100 text-amber-600']
        ] as $index => $stat)
        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms">
            <div class="flex items-center">
                <div class="{{ $stat['color'] }} p-3 rounded-lg mr-4">
                    <i class="{{ $stat['icon'] }}"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">{{ $stat['title'] }}</h4>
                    <p class="text-2xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Gráfico y Productos más vendidos -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Gráfico circular de métodos de pago -->
        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in-left">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Métodos de Pago</h3>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-circle text-blue-500 mr-1 text-xs"></i> Efectivo
                    <i class="fas fa-circle text-green-500 mx-2 text-xs"></i> Tarjeta
                    <i class="fas fa-circle text-purple-500 ml-1 text-xs"></i> Transferencia
                </div>
            </div>
            <div class="h-64">
                <canvas id="paymentMethodsChart"></canvas>
            </div>
        </div>

        <!-- Productos más vendidos -->
        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in-right">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Productos Más Vendidos</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-4 text-left">Producto</th>
                            <th scope="col" class="py-3 px-4 text-right">Cantidad</th>
                            <th scope="col" class="py-3 px-4 text-right">Ingresos</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($productosMasVendidos as $producto)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $producto->producto->nombre ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-right">{{ number_format($producto->total_vendido) }}</td>
                            <td class="py-3 px-4 text-right font-medium">S/ {{ number_format($producto->total_ingresos, 2) }}</td>
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

    <!-- Tabla de Ventas Detalladas -->
    <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in-up">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Listado de Ventas</h3>
            <span class="text-sm text-gray-500">{{ $ventas->count() }} registros</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-4 text-left">ID</th>
                        <th scope="col" class="py-3 px-4 text-left">Fecha</th>
                        <th scope="col" class="py-3 px-4 text-left">Cliente</th>
                        <th scope="col" class="py-3 px-4 text-left">Total</th>
                        <th scope="col" class="py-3 px-4 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($ventas as $venta)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="py-3 px-4 font-medium text-blue-600">#{{ $venta->id }}</td>
                        <td class="py-3 px-4">{{ $venta->fecha->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-4">{{ $venta->cliente ? $venta->cliente->name : 'Cliente General' }}</td>
                        <td class="py-3 px-4 font-bold">S/ {{ number_format($venta->total, 2) }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $venta->estado == 'completada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($venta->estado) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 px-6 text-center text-gray-500">No hay ventas en el período seleccionado</td>
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
        // Datos para el gráfico
        const paymentData = {
            labels: {!! json_encode($ventasPorMetodo->keys()->map(fn($m) => ucfirst($m))) !!},
            datasets: [{
                label: 'Ventas por Método de Pago',
                data: {!! json_encode($ventasPorMetodo->pluck('total')) !!},
                backgroundColor: [
                    '#2563EB', // Azul
                    '#14B8A6', // Turquesa
                    '#64748B', // Gris Pizarra
                    '#22C55E', // Verde
                    '#84CC16'  // Verde Lima
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        };

        // Configuración del gráfico
        const ctx = document.getElementById('paymentMethodsChart').getContext('2d');
        const paymentMethodsChart = new Chart(ctx, {
            type: 'doughnut',
            data: paymentData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: S/ ${value.toFixed(2)} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '70%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });
</script>
@endpush
@endsection