@extends('layout.app')

@section('title', 'Listado de Devoluciones')

@section('contenido')
<div class="w-full px-4 py-6">
    <main class="w-full px-4 md:px-6 py-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Historial de Devoluciones</h1>
                    <p class="text-gray-600 mt-2">Consulta todas las devoluciones procesadas en el sistema.</p>
                </div>
                <a href="{{ route('ventas.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a Ventas
                </a>
            </div>
        </div>

        <!-- Devolutions Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Devolución</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Venta Original</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Procesado por</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total Devuelto</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($devoluciones as $devolucion)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">#{{ $devolucion->id }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('ventas.show', $devolucion->venta_id) }}" class="text-blue-600 hover:underline">
                                    Venta #{{ $devolucion->venta_id }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ $devolucion->fecha->format('d/m/Y h:i A') }}</td>
                            <td class="px-6 py-4">{{ $devolucion->usuario->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-right font-semibold text-red-600">- S/ {{ number_format($devolucion->total_devuelto, 2) }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('devoluciones.show', $devolucion->id) }}" class="text-blue-600 hover:text-blue-800" title="Ver Detalle de Devolución">
                                    <i class="fas fa-receipt"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-box-open fa-3x mb-4"></i>
                                <p class="text-lg">No se han registrado devoluciones aún.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="p-6">
                {{ $devoluciones->links() }}
            </div>
        </div>
    </main>
</div>
@endsection 