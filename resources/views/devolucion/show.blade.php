@extends('layout.app')

@section('title', 'Comprobante de Devolución - #' . $devolucion->id)

@php
    $hideSidebar = true;
@endphp

@push('estilos')
<style>
    body { background-color: #f4f6f9; }
    .receipt-main-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 20px;
    }
    .receipt-modern-container {
        width: 100%;
        max-width: 800px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .receipt-modern-header {
        background-color: #f59e0b;
        color: #fff;
        padding: 30px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .receipt-logo img { max-height: 60px; border-radius: 8px; }
    .receipt-title h1 { margin: 0; font-size: 2rem; font-weight: 300; text-transform: uppercase; }
    .receipt-body { padding: 30px; }
    .receipt-section { margin-bottom: 25px; }
    .receipt-section h5 { font-size: 1rem; font-weight: 600; color: #b45309; border-bottom: 1px solid #fde68a; padding-bottom: 8px; }
    .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 10px 20px; }
    .receipt-table-wrapper { overflow-x: auto; }
    .receipt-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 0.95rem;
    }
    .receipt-table thead { background-color: #fef3c7; }
    .receipt-table th, .receipt-table td {
        padding: 10px 12px;
        text-align: left;
        white-space: nowrap;
    }
    .receipt-table .text-center { text-align: center; }
    .receipt-table .text-right { text-align: right; }
    .totals-table { width: 100%; max-width: 300px; font-size: 1rem; }
    .grand-total td {
        border-top: 2px solid #f59e0b;
        padding-top: 10px;
        font-size: 1.4rem;
        font-weight: bold;
        color: #b45309;
    }
    @media print {
        body { background-color: #fff; }
        .no-print { display: none !important; }
        .receipt-main-container { padding: 0; }
        .receipt-modern-container { box-shadow: none; border: none; max-width: 100%; }
    }
</style>
@endpush

@section('contenido')
<div class="receipt-main-container">
    <div class="receipt-modern-container">
        <div class="no-print p-4 border-b">
            <h1 class="text-xl font-bold">Detalle de Devolución</h1>
            <a href="{{ route('devoluciones.index') }}" class="text-blue-600 hover:underline">&larr; Volver al listado de devoluciones</a>
        </div>

        <div class="receipt-modern-header">
            <div class="receipt-logo">
                <img src="{{ asset('img/Logo-Tienda.jpg') }}" alt="Logo">
            </div>
            <div class="receipt-title">
                <h1>Devolución</h1>
            </div>
        </div>

        <div class="receipt-body">
            <div class="receipt-section">
                <div class="info-grid">
                    <p><strong>Nº Devolución:</strong> #{{ $devolucion->id }}</p>
                    <p><strong>Venta Original:</strong> <a href="{{ route('ventas.show', $devolucion->venta_id) }}" class="text-blue-600 hover:underline">#{{ $devolucion->venta_id }}</a></p>
                    <p><strong>Fecha:</strong> {{ $devolucion->fecha->format('d/m/Y h:i A') }}</p>
                    <p><strong>Procesado por:</strong> {{ $devolucion->usuario->name ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="receipt-section">
                <h5>Productos Devueltos</h5>
                <div class="receipt-table-wrapper">
                    <table class="receipt-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cant. Devuelta</th>
                                <th class="text-right">P. Unitario</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devolucion->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                <td class="text-right">S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="text-right">S/ {{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($devolucion->motivo)
            <div class="receipt-section">
                <h5>Motivo de la Devolución</h5>
                <p class="text-gray-600 italic">{{ $devolucion->motivo }}</p>
            </div>
            @endif

            <div class="flex justify-end mt-6">
                <table class="totals-table">
                    <tr class="grand-total">
                        <td><strong>Total Devuelto:</strong></td>
                        <td class="text-right">S/ {{ number_format($devolucion->total_devuelto, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="action-buttons no-print text-center p-4 border-t">
            <button onclick="window.print()" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-print mr-2"></i> Imprimir Comprobante
            </button>
        </div>
    </div>
</div>
@endsection
