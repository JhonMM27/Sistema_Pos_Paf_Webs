<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; }
        @page { margin: 180px 50px; }
        header { position: fixed; top: -140px; left: 0; right: 0; height: 120px; text-align: center; }
        header .logo { width: 100px; height: auto; position: absolute; left: 0; }
        header .title-container { position: absolute; top: 0; left: 120px; right: 0; text-align: center; }
        header h1 { font-size: 24px; margin: 0; color: #5a32a3; }
        header h2 { font-size: 16px; margin: 5px 0; }
        header p { font-size: 12px; margin: 5px 0; }
        footer { position: fixed; bottom: -60px; left: 0; right: 0; height: 50px; font-size: 10px; text-align: center; }
        footer .page-number:before { content: "Página " counter(page); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #5a32a3; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .summary { background-color: #f3e8ff; padding: 15px; border-left: 5px solid #5a32a3; margin-bottom: 20px; }
        .summary h3 { margin-top: 0; font-size: 16px; color: #5a32a3;}
        .summary p { margin: 5px 0; font-size: 14px; }
    </style>
</head>
<body>
    <header>
        <img src="{{ public_path('img/Logo-Tienda.jpg') }}" alt="Logo" class="logo">
        <div class="title-container">
            <h1>Reporte de Compras</h1>
            <h2>Nombre de la Tienda</h2>
            <p>Período del {{ $data['fechaInicio']->format('d/m/Y') }} al {{ $data['fechaFin']->format('d/m/Y') }}</p>
            <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </header>

    <footer>
        Sistema de Punto de Venta | <span class="page-number"></span>
    </footer>

    <main>
        <div class="summary">
            <h3>Resumen del Período</h3>
            <p><strong>Total de Compras:</strong> S/ {{ number_format($data['totalCompras'], 2) }}</p>
            <p><strong>Total de Transacciones:</strong> {{ number_format($data['totalTransacciones']) }}</p>
            <p><strong>Compra Promedio:</strong> S/ {{ number_format($data['promedioCompra'], 2) }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha y Hora</th>
                    <th>Proveedor</th>
                    <th>Registrado por</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['compras'] as $compra)
                    <tr>
                        <td>#{{ $compra->id }}</td>
                        <td>{{ $compra->fecha->format('d/m/Y H:i') }}</td>
                        <td>{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                        <td>{{ $compra->user->name ?? 'N/A' }}</td>
                        <td>S/ {{ number_format($compra->total, 2) }}</td>
                        <td>{{ ucfirst($compra->estado) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">No se encontraron compras en el período seleccionado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html> 