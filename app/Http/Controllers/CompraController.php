<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Provedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with(['proveedor', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $proveedores = Provedor::all();
        
        return view('compra.index', compact('compras', 'proveedores'));
    }

    public function create()
    {
        $proveedores = Provedor::all();
        $productos = Producto::all();
        $categorias = \App\Models\Categoria::all();
        // Productos sin stock
        $productosSinStock = Producto::with('categoria')->where('stock', '<=', 0)->get();
        // Top 10 productos con menor stock
        $productosCriticos = Producto::with('categoria')->orderBy('stock', 'asc')->limit(10)->get();
        return view('compra.create', compact('proveedores', 'productos', 'categorias', 'productosSinStock', 'productosCriticos'));
    }

    public function store(Request $request)
    {
        $rules = [
            'proveedor_id' => 'required|exists:provedors,id',
            'fecha' => 'required|date',
            'productos' => 'required|array|min:1',
        ];

        $messages = [
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'productos.required' => 'Debe agregar al menos un producto a la compra.',
        ];

        foreach ($request->input('productos', []) as $index => $producto) {
            $rules["productos.{$index}.cantidad"] = 'required|numeric|min:1';
            $rules["productos.{$index}.precio_unitario"] = 'required|numeric|min:0';

            if (isset($producto['es_nuevo']) && $producto['es_nuevo'] === 'true') {
                $rules["productos.{$index}.nombre"] = 'required|string|max:255';
                $rules["productos.{$index}.codigo"] = 'required|string|max:255|unique:productos,codigo_barras';
                $rules["productos.{$index}.categoria_id"] = 'required|exists:categorias,id';
                $rules["productos.{$index}.precio"] = 'required|numeric|min:0';
                
                $messages["productos.{$index}.codigo.unique"] = "El código del producto '{$producto['nombre']}' ya existe.";
                $messages["productos.{$index}.nombre.required"] = "El nombre del producto nuevo es obligatorio.";

            } else {
                $rules["productos.{$index}.producto_id"] = 'required|exists:productos,id';
            }
        }

        $request->validate($rules, $messages);

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($request->productos as $producto) {
                $total += $producto['cantidad'] * $producto['precio_unitario'];
            }

            $compra = Compra::create([
                'proveedor_id' => $request->proveedor_id,
                'user_id' => Auth::id(),
                'fecha' => $request->fecha,
                'total' => $total,
                'estado' => 'activo'
            ]);

            foreach ($request->productos as $producto) {
                if (isset($producto['es_nuevo']) && $producto['es_nuevo'] == 'true') {
                    // Crear nuevo producto
                    $nuevoProducto = Producto::create([
                        'nombre' => $producto['nombre'],
                        'codigo_barras' => $producto['codigo'],
                        'descripcion' => $producto['descripcion'] ?? null,
                        'precio' => $producto['precio'],
                        'precio_compra' => $producto['precio_unitario'],
                        'stock' => $producto['cantidad'],
                        'categoria_id' => $producto['categoria_id'],
                        'estado' => true
                    ]);

                    DetalleCompra::create([
                        'compra_id' => $compra->id,
                        'producto_id' => $nuevoProducto->id,
                        'cantidad' => $producto['cantidad'],
                        'precio_unitario' => $producto['precio_unitario'],
                        'subtotal' => $producto['cantidad'] * $producto['precio_unitario']
                    ]);
                } else {
                    // Producto existente
                    $productoModel = Producto::find($producto['producto_id']);
                    $productoModel->stock += $producto['cantidad'];
                    $productoModel->precio_compra = $producto['precio_unitario']; // Actualizar precio de compra
                    $productoModel->save();

                    DetalleCompra::create([
                        'compra_id' => $compra->id,
                        'producto_id' => $producto['producto_id'],
                        'cantidad' => $producto['cantidad'],
                        'precio_unitario' => $producto['precio_unitario'],
                        'subtotal' => $producto['cantidad'] * $producto['precio_unitario']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('compras.index')
                ->with('success', 'Compra registrada exitosamente');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al registrar la compra: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Compra $compra)
    {
        $compra->load('proveedor', 'detalles.producto', 'user');
        return view('compra.show', compact('compra'));
    }

    /**
     * Anula la compra especificada y revierte el stock.
     * En lugar de borrar el registro, cambia su estado a 'anulada'.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Compra $compra)
    {
        // Verificar si la compra ya está anulada para evitar dobles operaciones
        if ($compra->estado === 'anulada') {
            return redirect()->route('compras.index')
                ->with('error', 'Esta compra ya ha sido anulada anteriormente.');
        }

        DB::beginTransaction();

        try {
            // Revertir el stock de cada producto en la compra
            foreach ($compra->detalles as $detalle) {
                $producto = Producto::find($detalle->producto_id);
                if ($producto) {
                    $producto->stock += $detalle->cantidad;
                    $producto->save();
                }
            }

            // Cambiar el estado de la compra a 'anulada'
            $compra->estado = 'anulada';
            $compra->save();

            DB::commit();

            return redirect()->route('compras.index')
                ->with('success', 'La compra ha sido anulada correctamente y el stock ha sido revertido.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Error al anular compra: ' . $e->getMessage()); // Opcional: Loguear el error
            return redirect()->route('compras.index')
                ->with('error', 'Ocurrió un error al intentar anular la compra.');
        }
    }

    // API methods for AJAX requests
    public function buscarProducto(Request $request)
    {
        $queryTerm = $request->get('q');
        $exact = $request->boolean('exact');

        $query = Producto::query();

        if ($exact && !empty($queryTerm)) {
            $query->where('codigo_barras', $queryTerm);
        } else if (!empty($queryTerm)) {
            $query->where(function($q) use ($queryTerm) {
                $q->where('nombre', 'like', "%{$queryTerm}%")
                ->orWhere('codigo_barras', 'like', "%{$queryTerm}%");
            });
        } else {
            return response()->json([]);
        }
        
        $productos = $query->select('id', 'nombre', 'codigo_barras as codigo', 'precio_compra', 'stock')->get();
        
        return response()->json($productos);
    }

    public function buscarProveedor(Request $request)
    {
        $query = $request->get('q');
        
        $proveedores = Provedor::where('nombre', 'like', "%{$query}%")
            ->orWhere('ruc_dni', 'like', "%{$query}%")
            ->select('id', 'nombre', 'ruc_dni as ruc', 'telefono')
            ->get();
        
        return response()->json($proveedores);
    }
}
