@extends('layout.app')

@section('titulo', 'Reporte de Ganancias')

@section('contenido')
<div class="container mx-auto px-4 py-8 animate-fade-in">
    <!-- Header con icono y animación -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div class="mb-4 md:mb-0">
            <div class="flex items-center">
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white p-3 rounded-xl shadow-md mr-4">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Reporte de Ganancias</h1>
                    <p class="text-gray-600 mt-1">Análisis completo de rentabilidad y métricas financieras</p>
                </div>
            </div>
        </div>
        <a href="{{ route('reportes.index') }}" class="flex items-center justify-center bg-white border border-gray-300 hover:border-indigo-500 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
            <i class="fas fa-arrow-left mr-2"></i>Volver al módulo
        </a>
    </div>

    <!-- Filtros mejorados -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
        <form method="GET" action="{{ route('reportes.ganancias') }}" class="space-y-4 md:space-y-0 md:flex md:items-end md:justify-between gap-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-grow">
                <div>
                    <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha Inicio</label>
                    <div class="relative">
                        <input type="date" name="fecha_inicio" id="fecha_inicio" 
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition duration-300 pl-10"
                               value="{{ $fechaInicio->format('Y-m-d') }}">
                        <i class="fas fa-calendar-day absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-1">Fecha Fin</label>
                    <div class="relative">
                        <input type="date" name="fecha_fin" id="fecha_fin" 
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition duration-300 pl-10"
                               value="{{ $fechaFin->format('Y-m-d') }}">
                        <i class="fas fa-calendar-day absolute left-3 top-3 text-gray-400"></i>
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
                        <i class="fas fa-calendar-week absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button type="submit" class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-md">
                    <i class="fas fa-filter mr-2"></i>Filtrar
                </button>
                <a href="{{ route('reportes.exportar.ganancias', request()->query()) }}" 
                   class="flex items-center justify-center bg-white border border-red-500 hover:border-red-600 text-red-500 hover:text-red-600 px-4 py-2 rounded-lg transition-all duration-300 hover:shadow-md" 
                   target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar
                </a>
            </div>
        </form>
    </div>

    <!-- Resumen Financiero con KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach([
            ['title' => 'Ingresos Totales', 'value' => 'S/ '.number_format($ingresos, 2), 'icon' => 'fas fa-money-bill-wave', 'trend' => 'up', 'color' => 'text-green-600 bg-green-50'],
            ['title' => 'Costos Totales', 'value' => 'S/ '.number_format($costos, 2), 'icon' => 'fas fa-file-invoice-dollar', 'trend' => 'down', 'color' => 'text-red-600 bg-red-50'],
            ['title' => 'Ganancia Bruta', 'value' => 'S/ '.number_format($gananciaBruta, 2), 'icon' => 'fas fa-hand-holding-usd', 'trend' => $gananciaBruta >= 0 ? 'up' : 'down', 'color' => $gananciaBruta >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50'],
            ['title' => 'Margen de Ganancia', 'value' => number_format($margenGanancia, 1).'%', 'icon' => 'fas fa-percentage', 'trend' => $margenGanancia >= 0 ? 'up' : 'down', 'color' => $margenGanancia >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50']
        ] as $card)
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all duration-300 hover:shadow-md hover:border-indigo-100">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">{{ $card['title'] }}</h4>
                    <p class="text-2xl font-bold mt-2 {{ strpos($card['color'], 'text-') }}">{{ $card['value'] }}</p>
                </div>
                <div class="{{ $card['color'] }} p-3 rounded-lg">
                    <i class="{{ $card['icon'] }}"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm {{ $card['trend'] == 'up' ? 'text-green-600' : 'text-red-600' }}">
                <i class="fas fa-arrow-{{ $card['trend'] }} mr-1"></i>
                <span>{{ $card['trend'] == 'up' ? 'Positivo' : 'Negativo' }} vs período anterior</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Gráficos de Tendencias y Margen -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Tendencias Financieras -->
        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in-left">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Tendencias Financieras</h3>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ ucfirst($tipoReporte) }}</span>
            </div>
            <div class="h-64">
                <canvas id="financialTrendsChart"></canvas>
            </div>
        </div>

        <!-- Evolución del Margen -->
        <div class="bg-white rounded-xl shadow-sm p-6 animate-fade-in-right">
             <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Evolución del Margen</h3>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Meta: 20%</span>
            </div>
            <div class="h-64">
                <canvas id="marginEvolutionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Análisis de Productos -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Rentabilidad por Producto</h3>
            <div class="flex items-center space-x-2 mt-2 sm:mt-0">
                <span class="text-sm text-gray-500">{{ count($analisisProductos) }} productos analizados</span>
                <div class="relative">
                    <select id="productFilter" class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 py-1 px-3 pr-8 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        <option value="all">Todos los productos</option>
                        <option value="high">Alto margen (>20%)</option>
                        <option value="medium">Margen medio (10-20%)</option>
                        <option value="low">Bajo margen (<10%)</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-2 top-2 text-xs text-gray-500"></i>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="productsTable">
                <thead>
                    <tr class="text-left text-gray-700 bg-gray-50">
                        <th class="py-3 px-4 rounded-tl-lg">Producto</th>
                        <th class="py-3 px-4 text-right">Ventas</th>
                        <th class="py-3 px-4 text-right">Ingresos</th>
                        <th class="py-3 px-4 text-right">Costos</th>
                        <th class="py-3 px-4 text-right">Ganancia</th>
                        <th class="py-3 px-4 text-right rounded-tr-lg">Margen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($analisisProductos as $analisis)
                    <tr class="product-row hover:bg-gray-50 transition-colors duration-200" 
                        data-margin="{{ $analisis['margen'] }}">
                        <td class="py-3 px-4 font-medium text-gray-900">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                                    <i class="fas fa-box text-sm"></i>
                                </div>
                                {{ $analisis['producto']->nombre ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="py-3 px-4 text-right">{{ number_format($analisis['cantidad_vendida']) }}</td>
                        <td class="py-3 px-4 text-right">S/ {{ number_format($analisis['ingresos'], 2) }}</td>
                        <td class="py-3 px-4 text-right">S/ {{ number_format($analisis['costos'], 2) }}</td>
                        <td class="py-3 px-4 text-right font-bold {{ $analisis['ganancia'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            S/ {{ number_format($analisis['ganancia'], 2) }}
                        </td>
                        <td class="py-3 px-4 text-right">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $analisis['margen'] >= 20 ? 'bg-green-100 text-green-800' : ($analisis['margen'] >= 10 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ number_format($analisis['margen'], 1) }}%
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const gananciaData = @json($gananciaPorPeriodo);
    const labels = Object.keys(gananciaData);
    const ingresos = labels.map(l => gananciaData[l].ingresos);
    const costos = labels.map(l => gananciaData[l].costos);
    const ganancias = labels.map(l => gananciaData[l].ganancia);
    const margenes = labels.map(l => {
        const ingreso = gananciaData[l].ingresos;
        const ganancia = gananciaData[l].ganancia;
        return ingreso > 0 ? (ganancia / ingreso) * 100 : 0;
    });

    // Gráfico de Tendencias Financieras
    const ctxTrends = document.getElementById('financialTrendsChart').getContext('2d');
    new Chart(ctxTrends, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Ingresos',
                    data: ingresos,
                    borderColor: '#22C55E', // Verde
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Costos',
                    data: costos,
                    borderColor: '#EF4444', // Rojo
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Ganancia',
                    data: ganancias,
                    borderColor: '#3B82F6', // Azul
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });

    // Gráfico de Evolución del Margen
    const ctxMargin = document.getElementById('marginEvolutionChart').getContext('2d');
    new Chart(ctxMargin, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Margen de Ganancia (%)',
                data: margenes,
                borderColor: '#8B5CF6', // Púrpura
                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    ticks: { callback: value => `${value.toFixed(1)}%` }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: { label: context => `${context.dataset.label}: ${context.raw.toFixed(2)}%` }
                }
            }
        }
    });

    // Filtro de productos por margen
    document.getElementById('productFilter').addEventListener('change', function() {
        const value = this.value;
        const rows = document.querySelectorAll('#productsTable .product-row');
        
        rows.forEach(row => {
            const margin = parseFloat(row.dataset.margin);
            let show = true;
            
            if (value === 'high' && margin < 20) show = false;
            if (value === 'medium' && (margin >= 20 || margin < 10)) show = false;
            if (value === 'low' && margin >= 10) show = false;
            
            row.style.display = show ? '' : 'none';
        });
    });
});
</script>

<!-- Animaciones CSS -->
<style>
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
@endsection