@extends('layout.app')

@section('title', 'Gestión de Compras')

@section('contenido')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-shopping-cart text-purple-600 mr-3"></i>
            Gestión de Compras
        </h1>
        <a href="{{ route('compras.create') }}" 
           class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Nueva Compra
        </a>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Proveedor</label>
                <select id="filtroProveedor" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Todos los proveedores</option>
                    @foreach($proveedores ?? [] as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select id="filtroEstado" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="anulado">Anulado</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Desde</label>
                <input type="date" id="fechaDesde" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha Hasta</label>
                <input type="date" id="fechaHasta" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
        </div>
    </div>

    <!-- Tabla de Compras -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                            N° Compra
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                            Proveedor
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                            Fecha
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                            Usuario
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($compras as $compra)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $compra->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $compra->proveedor->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                ${{ number_format($compra->total, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $compra->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($compra->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $compra->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('compras.show', $compra) }}" 
                                        class="text-blue-600 hover:text-blue-900" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($compra->estado !== 'anulado')
                                    <form action="{{ route('compras.destroy', $compra) }}" method="POST" 
                                            class="inline" onsubmit="return confirm('¿Estás seguro de anular esta compra?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Anular">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-2"></i>
                                    <p>No hay compras registradas</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if($compras->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $compras->links() }}
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#34D399',
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '¡Error!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#F87171',
    });
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtros
    const filtroProveedor = document.getElementById('filtroProveedor');
    const filtroEstado = document.getElementById('filtroEstado');
    const fechaDesde = document.getElementById('fechaDesde');
    const fechaHasta = document.getElementById('fechaHasta');

    function aplicarFiltros() {
        const params = new URLSearchParams(window.location.search);
        
        if (filtroProveedor.value) params.set('proveedor', filtroProveedor.value);
        if (filtroEstado.value) params.set('estado', filtroEstado.value);
        if (fechaDesde.value) params.set('fecha_desde', fechaDesde.value);
        if (fechaHasta.value) params.set('fecha_hasta', fechaHasta.value);

        window.location.search = params.toString();
    }

    filtroProveedor.addEventListener('change', aplicarFiltros);
    filtroEstado.addEventListener('change', aplicarFiltros);
    fechaDesde.addEventListener('change', aplicarFiltros);
    fechaHasta.addEventListener('change', aplicarFiltros);
});
</script>
@endsection 