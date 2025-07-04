<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\User;
use App\Models\TipoUsuario;
use App\Http\Requests\VentaRequest;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['vendedor', 'cliente', 'detalles.producto'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('venta.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener el ID del tipo de usuario "Cliente"
        $tipoClienteId = TipoUsuario::where('name', 'Cliente')->value('id');

        // Obtener clientes para el selector
        $clientes = User::where('TipoUsuario_id', $tipoClienteId)
            ->select('id', 'name', 'email', 'documento')
            ->get();

        return view('venta.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VentaRequest $request)
    {
        try {
            DB::beginTransaction();

            // Validar que el cliente existe si se proporciona
            if ($request->cliente_id) {
                $cliente = User::find($request->cliente_id);
                if (!$cliente) {
                    throw new \Exception('El cliente seleccionado no existe');
                }
            }

            // Crear la venta
            $venta = Venta::create([
                'user_id' => Auth::id(),
                'cliente_id' => $request->cliente_id,
                'fecha' => now(),
                'metodo_pago' => $request->metodo_pago,
                'total' => $request->total,
                'estado' => $request->estado,
            ]);

            // Crear los detalles de venta y actualizar stock
            foreach ($request->productos as $productoData) {
                $producto = Producto::findOrFail($productoData['producto_id']);

                // Verificar stock
                if (!$producto->tieneStock($productoData['cantidad'])) {
                    throw new \Exception("Stock insuficiente para el producto: {$producto->nombre}");
                }

                // Crear detalle de venta
                $venta->detalles()->create([
                    'producto_id' => $productoData['producto_id'],
                    'cantidad' => $productoData['cantidad'],
                    'precio_unitario' => $productoData['precio_unitario'],
                    'subtotal' => $productoData['cantidad'] * $productoData['precio_unitario'],
                ]);

                // Reducir stock
                $producto->reducirStock($productoData['cantidad']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venta registrada correctamente',
                'venta_id' => $venta->id,
                'redirect_url' => route('ventas.show', $venta->id)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar venta: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la venta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->load('cliente', 'vendedor', 'detalles.producto');
        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        // Solo permitir editar ventas pendientes
        if ($venta->estado !== Venta::ESTADO_PENDIENTE) {
            return redirect()->route('ventas.index')
                ->with('error', 'Solo se pueden editar ventas pendientes.');
        }

        $venta->load(['detalles.producto']);

        $tipoClienteId = TipoUsuario::where('name', 'Cliente')->value('id');
        $clientes = User::where('TipoUsuario_id', $tipoClienteId)
            ->select('id', 'name', 'email', 'documento')
            ->get();

        return view('venta.edit', compact('venta', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VentaRequest $request, Venta $venta)
    {
        // Solo permitir actualizar ventas pendientes
        if ($venta->estado !== Venta::ESTADO_PENDIENTE) {
            return response()->json([
                'success' => false,
                'message' => 'Solo se pueden actualizar ventas pendientes.'
            ], 400);
        }

        DB::beginTransaction();
        try {
            // 1. Restaurar el stock de los productos originales de la venta pendiente
            foreach ($venta->detalles as $detalle) {
                $producto = $detalle->producto;
                if ($producto) {
                    $producto->aumentarStock($detalle->cantidad);
                }
            }

            // 2. Eliminar los detalles de venta anteriores
            $venta->detalles()->delete();

            // 3. Actualizar la venta principal
            $venta->update([
                'cliente_id' => $request->cliente_id,
                'metodo_pago' => $request->metodo_pago,
                'total' => $request->total,
                'estado' => Venta::ESTADO_COMPLETADA, // La venta ahora se completa
                'fecha' => now(), // Actualizar la fecha a la de finalización
            ]);

            // 4. Crear los nuevos detalles de venta y reducir stock
            foreach ($request->productos as $productoData) {
                $producto = Producto::findOrFail($productoData['producto_id']);

                if (!$producto->tieneStock($productoData['cantidad'])) {
                    throw new \Exception("Stock insuficiente para el producto: {$producto->nombre}");
                }

                $venta->detalles()->create([
                    'producto_id' => $productoData['producto_id'],
                    'cantidad' => $productoData['cantidad'],
                    'precio_unitario' => $productoData['precio_unitario'],
                    'subtotal' => $productoData['cantidad'] * $productoData['precio_unitario'],
                ]);

                $producto->reducirStock($productoData['cantidad']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venta actualizada y completada correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar la venta: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la venta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        try {
            DB::beginTransaction();

            // Solo permitir eliminar ventas pendientes
            if ($venta->estado !== Venta::ESTADO_PENDIENTE) {
                return response()->json([
                    'success' => false,
                    'message' => 'Solo se pueden eliminar ventas pendientes'
                ], 400);
            }

            // Restaurar stock
            foreach ($venta->detalles as $detalle) {
                $producto = $detalle->producto;
                $producto->aumentarStock($detalle->cantidad);
            }

            // Eliminar venta y detalles
            $venta->detalles()->delete();
            $venta->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venta eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la venta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar producto por código de barras
     */
    public function buscarProducto(Request $request)
    {
        $codigo = $request->get('codigo');

        if (!$codigo) {
            return response()->json([
                'success' => false,
                'message' => 'Código de barras requerido'
            ], 400);
        }

        // Log para debugging
        Log::info('Buscando producto por código de barras: ' . $codigo);

        // Primero buscar sin filtros para ver si existe
        $producto = Producto::where('codigo_barras', $codigo)->first();

        if (!$producto) {
            Log::info('Producto no encontrado con código: ' . $codigo);
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        Log::info('Producto encontrado: ' . $producto->nombre . ', Stock: ' . $producto->stock . ', Estado: ' . $producto->estado);

        // Verificar si tiene stock
        if ($producto->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Producto sin stock disponible'
            ], 404);
        }

        Log::info('Estado real del producto: ' . var_export($producto->estado, true));

        // Verificar si está activo (si el campo estado existe)
        if (!$producto->estado) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no disponible'
            ], 404);
        }
        


        return response()->json([
            'success' => true,
            'producto' => [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'codigo_barras' => $producto->codigo_barras,
                'precio' => $producto->precio,
                'precio_formateado' => $producto->precio_formateado,
                'stock' => $producto->stock,
                'categoria' => $producto->categoria ? $producto->categoria->nombre : 'Sin categoría',
                'descripcion' => $producto->descripcion
            ]
        ]);
    }

    /**
     * Buscar productos por término
     */
    public function buscarProductos(Request $request)
    {
        $termino = $request->get('termino');

        if (!$termino || strlen($termino) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Término de búsqueda debe tener al menos 2 caracteres'
            ], 400);
        }

        // Log para debugging
        Log::info('Buscando productos por término: ' . $termino);

        // Búsqueda más simple sin filtros estrictos
        $productos = Producto::where(function ($query) use ($termino) {
            $query->where('nombre', 'LIKE', "%{$termino}%")
                ->orWhere('codigo_barras', 'LIKE', "%{$termino}%")
                ->orWhere('descripcion', 'LIKE', "%{$termino}%");
        })
            ->where('stock', '>', 0)
            ->with('categoria')
            ->limit(10)
            ->get();

        Log::info('Productos encontrados: ' . $productos->count());

        return response()->json([
            'success' => true,
            'productos' => $productos->map(function ($producto) {
                return [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'codigo_barras' => $producto->codigo_barras,
                    'precio' => $producto->precio,
                    'precio_formateado' => $producto->precio_formateado,
                    'stock' => $producto->stock,
                    'categoria' => $producto->categoria ? $producto->categoria->nombre : 'Sin categoría',
                    'descripcion' => $producto->descripcion
                ];
            })
        ]);
    }

    /**
     * Registrar cliente rápidamente durante la venta
     */
    public function registrarCliente(ClienteRequest $request)
    {
        try {
            // Obtener el ID del tipo de usuario "Cliente"
            $tipoClienteId = TipoUsuario::where('name', 'Cliente')->value('id');

            $cliente = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('cliente123'), // Contraseña temporal
                'documento' => $request->documento,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'TipoUsuario_id' => $tipoClienteId,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cliente registrado correctamente',
                'cliente' => [
                    'id' => $cliente->id,
                    'name' => $cliente->name,
                    'email' => $cliente->email,
                    'documento' => $cliente->documento
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener resumen de ventas
     */
    public function resumen()
    {
        $hoy = now()->format('Y-m-d');

        $resumen = [
            'ventas_hoy' => Venta::completadas()->whereDate('created_at', $hoy)->count(),
            'total_hoy' => Venta::completadas()->whereDate('created_at', $hoy)->sum('total'),
            'ventas_pendientes' => Venta::pendientes()->count(),
            'productos_bajo_stock' => Producto::where('stock', '<=', 10)->count(),
        ];

        return response()->json([
            'success' => true,
            'resumen' => $resumen
        ]);
    }

    public function anular(Venta $venta)
    {
        if ($venta->estado === Venta::ESTADO_ANULADA) {
            return back()->with('error', 'Esta venta ya ha sido anulada.');
        }

        DB::beginTransaction();
        try {
            foreach ($venta->detalles as $detalle) {
                $producto = $detalle->producto;
                if ($producto) {
                    $producto->aumentarStock($detalle->cantidad);
                }
            }

            $venta->estado = Venta::ESTADO_ANULADA;
            $venta->save();

            DB::commit();

            return back()->with('success', 'Venta anulada y stock restaurado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al anular la venta: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al anular la venta.');
        }
    }

    /**
     * Buscar clientes por nombre o DNI (AJAX)
     */
    public function buscarCliente(Request $request)
    {
        Log::info('Buscando cliente AJAX', ['user_id' => Auth::id(), 'q' => $request->input('q')]);
        $q = $request->input('q');
        $tipoClienteId = \App\Models\TipoUsuario::where('name', 'Cliente')->value('id');
        $clientes = \App\Models\User::where('TipoUsuario_id', $tipoClienteId)
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhere('documento', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%") ;
            })
            ->select('id', 'name', 'email', 'documento')
            ->limit(10)
            ->get();
        return response()->json($clientes);
    }
}
