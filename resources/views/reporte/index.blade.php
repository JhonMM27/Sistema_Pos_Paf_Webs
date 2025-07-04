@extends('layout.app')

@section('titulo', 'Reportes Analíticos')

@section('contenido')
<div class="container mx-auto px-4 py-12">
    <!-- Encabezado mejorado -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full shadow-lg mb-4">
            <i class="fas fa-chart-pie text-white text-2xl"></i>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Modulo Reportes</h1>
        <p class="text-gray-500 max-w-2xl mx-auto">Visualiza datos clave para la toma de decisiones estratégicas</p>
    </div>

    <!-- Grid de reportes optimizado -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @php
            $reportes = [
                [
                    'titulo' => 'Reporte de Ventas',
                    'descripcion' => 'Tendencias, productos estrella y rendimiento por categoría',
                    'icono' => 'fas fa-cash-register',
                    'color' => 'from-green-500 to-teal-500',
                    'ruta' => route('reportes.ventas')
                ],
                [
                    'titulo' => 'Reporte de Compras',
                    'descripcion' => 'Patrones de compra y eficiencia en adquisiciones',
                    'icono' => 'fas fa-boxes-stacked',
                    'color' => 'from-purple-500 to-fuchsia-500',
                    'ruta' => route('reportes.compras')
                ],
                [
                    'titulo' => 'Reporte de Ganancias',
                    'descripcion' => 'Margenes brutos y análisis de rentabilidad por producto',
                    'icono' => 'fas fa-coins',
                    'color' => 'from-amber-500 to-orange-500',
                    'ruta' => route('reportes.ganancias')
                ],
                [
                    'titulo' => 'Reporte de Inventario',
                    'descripcion' => 'Productos sin stock y análisis de inventario crítico',
                    'icono' => 'fas fa-box-open',
                    'color' => 'from-red-500 to-yellow-500',
                    'ruta' => route('reportes.inventario')
                ],
            ];
        @endphp

        @foreach ($reportes as $reporte)
            <a href="{{ $reporte['ruta'] }}" class="group">
                <div class="h-full bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="h-2 bg-gradient-to-r {{ $reporte['color'] }}"></div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="mr-4">
                                <div class="bg-gradient-to-br {{ $reporte['color'] }} p-3 rounded-lg text-white">
                                    <i class="{{ $reporte['icono'] }} text-xl"></i>
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-900">{{ $reporte['titulo'] }}</h3>
                        </div>
                        <p class="text-gray-500 text-sm">{{ $reporte['descripcion'] }}</p>
                        <div class="mt-4 flex items-center text-sm font-medium text-indigo-600 group-hover:text-indigo-700">
                            Ver reporte
                            <i class="fas fa-chevron-right ml-1 text-xs mt-0.5"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- <!-- Sección adicional para filtros rápidos -->
    <div class="mt-16 bg-gray-50 rounded-xl p-6">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Generar reporte personalizado</h3>
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Rango de fechas</label>
                <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Seleccionar rango">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de reporte</label>
                <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>Comparativo mensual</option>
                    <option>Análisis anual</option>
                    <option>Detalle por producto</option>
                </select>
            </div>
            <div class="self-end">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Generar
                </button>
            </div>
        </div>
    </div> --}}
</div>
@endsection