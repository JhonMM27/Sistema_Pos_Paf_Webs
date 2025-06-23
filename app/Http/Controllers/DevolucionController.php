<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devoluciones = Devolucion::with(['venta', 'usuario'])
            ->orderBy('fecha', 'desc')
            ->paginate(15);
        
        return view('devolucion.index', compact('devoluciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Venta $venta)
    {
        // Cargar detalles necesarios de la venta
        $venta->load('detalles.producto', 'devoluciones.detalles');

        // No permitir devoluciones de ventas anuladas
        if ($venta->estado === 'anulada') {
            return redirect()->route('ventas.show', $venta)->with('error', 'No se pueden realizar devoluciones de una venta anulada.');
        }

        return view('devolucion.create', compact('venta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Venta $venta)
    {
        $productosADevolver = $request->input('productos', []);
        $motivo = $request->input('motivo');

        // Filtrar productos con cantidad > 0
        $productosFiltrados = array_filter($productosADevolver, function ($producto) {
            return isset($producto['cantidad']) && $producto['cantidad'] > 0;
        });

        if (empty($productosFiltrados)) {
            return back()->with('error', 'Debes especificar una cantidad para al menos un producto.');
        }

        DB::beginTransaction();
        try {
            $totalDevuelto = 0;
            $detallesDevolucionParaGuardar = [];

            // 1. Validar cantidades y calcular total
            foreach ($productosFiltrados as $productoId => $data) {
                $cantidadADevolver = (int)$data['cantidad'];
                
                $detalleVenta = $venta->detalles()->where('producto_id', $productoId)->first();
                if (!$detalleVenta) {
                    throw new \Exception("El producto con ID {$productoId} no pertenece a esta venta.");
                }

                $cantidadDevueltaPreviamente = $detalleVenta->cantidad_devuelta;
                $cantidadVendida = $detalleVenta->cantidad;

                if ($cantidadADevolver > ($cantidadVendida - $cantidadDevueltaPreviamente)) {
                    throw new \Exception("La cantidad a devolver para el producto {$detalleVenta->producto->nombre} excede la cantidad permitida.");
                }

                $subtotal = $cantidadADevolver * $detalleVenta->precio_unitario;
                $totalDevuelto += $subtotal;

                // Añadir al array para guardar más tarde
                $detallesDevolucionParaGuardar[] = [
                    'producto_id' => $productoId,
                    'cantidad' => $cantidadADevolver,
                    'precio_unitario' => $detalleVenta->precio_unitario,
                    'subtotal' => $subtotal,
                ];
            }
            
            // 2. Crear la devolución
            $devolucion = $venta->devoluciones()->create([
                'user_id' => Auth::id(),
                'fecha' => now(),
                'motivo' => $motivo,
                'total_devuelto' => $totalDevuelto,
            ]);

            // 3. Crear los detalles y restaurar stock
            foreach ($detallesDevolucionParaGuardar as $detalleData) {
                $devolucion->detalles()->create($detalleData);
                
                $producto = Producto::find($detalleData['producto_id']);
                $producto->aumentarStock($detalleData['cantidad']);
            }

            DB::commit();

            return redirect()->route('ventas.show', $venta->id)->with('success', 'Devolución registrada correctamente y stock restaurado.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar devolución: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al procesar la devolución: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Devolucion $devolucion)
    {
        $devolucion->load('venta.cliente', 'usuario', 'detalles.producto');
        return view('devolucion.show', compact('devolucion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
