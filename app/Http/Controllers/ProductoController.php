<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $texto = $request->get('texto');
        $categoria_id = $request->get('categoria_id');
        $estado = $request->get('estado');

        $query = Producto::query();

        if ($texto) {
            $query->where(function ($q) use ($texto) {
                $q->where('nombre', 'LIKE', "%$texto%")
                    ->orWhere('codigo_barras', 'LIKE', "%$texto%");
            });
        }
        if ($categoria_id) {
            $query->where('categoria_id', $categoria_id);
        }
        if ($estado !== null && $estado !== '') {
            $query->where('estado', $estado);
        }

        $registros = $query->orderBy('id', 'desc')->paginate(10)->appends($request->query());
        $categorias = Categoria::where('estado', 1)->orderBy('nombre')->get(['id', 'nombre']);
        
        // Opciones para el campo unidad
        // $unidades = ['Kg', 'G', 'Ml', 'L'];
        
        return view('producto.index', compact(['registros', 'texto', 'categoria_id', 'estado', 'categorias']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(ProductoRequest $request)
    {
        try {
            $producto = Producto::create($request->validated());
            return redirect()->route('productos.index')
                ->with('mensaje', 'Producto creado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')
                ->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Categoria $categoria)
    // {
    //     //
    // }

    public function edit($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, $id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->update($request->validated());
            return redirect()->route('productos.index')
                ->with('mensaje', 'Producto actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')
                ->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();
            return redirect()->route('productos.index')
                ->with('mensaje', 'Producto eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('productos.index')
                ->with('error', 'No se puede eliminar el producto porque tiene registros asociados');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')
                ->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }

    public function categorias()
    {
        $categorias = Categoria::where('estado', 1)->orderBy('nombre')->get(['id', 'nombre']);
        return response()->json($categorias);
    }

    public function unidades()
    {
        $unidades = ['Kg', 'G', 'Ml', 'L'];
        return response()->json($unidades);
    }
}
