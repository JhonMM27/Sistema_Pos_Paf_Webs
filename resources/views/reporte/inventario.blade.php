@extends('layout.app')

@section('titulo', 'Reporte de Inventario')

@section('contenido')
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-red-500 to-yellow-500 rounded-full shadow-lg mb-4">
            <i class="fas fa-box-open text-white text-2xl"></i>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Productos sin Stock</h1>
        <p class="text-gray-500 max-w-2xl mx-auto">Visualiza los productos agotados y los más críticos en inventario</p>
    </div>

    <div class="flex justify-end mb-6">
        <a href="{{ route('compras.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center transition duration-300">
            <i class="fas fa-plus mr-2"></i> Comprar Productos
        </a>
    </div>

    <!-- Tabla de productos sin stock -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 animate-fade-in-up">
        <h2 class="text-xl font-semibold text-red-600 mb-4"><i class="fas fa-exclamation-triangle mr-2"></i>Sin Stock</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($productosSinStock as $producto)
                        <tr>
                            <td class="px-4 py-2">{{ $producto->nombre }}</td>
                            <td class="px-4 py-2">{{ $producto->categoria->nombre ?? '-' }}</td>
                            <td class="px-4 py-2 text-red-600 font-bold">{{ $producto->stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-400">No hay productos sin stock.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Gráfico de productos críticos -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 animate-fade-in-up">
        <h2 class="text-xl font-semibold text-yellow-600 mb-4"><i class="fas fa-chart-bar mr-2"></i>Productos con Menor Stock</h2>
        <div class="h-96">
            <canvas id="stockChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($productosCriticos->pluck('nombre')) !!},
                datasets: [{
                    label: 'Stock actual',
                    data: {!! json_encode($productosCriticos->pluck('stock')) !!},
                    backgroundColor: '#fbbf24',
                    borderColor: '#f59e42',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endpush 