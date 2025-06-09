<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;


class CategoriaController extends Controller
{
    public function index(Request $request)
    {

        $texto = $request->get('texto', '');  // Default to empty string if 'texto' is not provided

        // Query to filter based on 'nombre' or 'id'
        $registros = Categoria::when($texto, function ($query) use ($texto) {
            return $query->where('nombre', 'LIKE', '%' . $texto . '%')
                ->orWhere('id', 'LIKE', '%' . $texto . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('categoria.index', compact('registros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {

        $registro = new Categoria();
        $registro->nombre = $request->input('nombre');
        $registro->descripcion = $request->input('descripcion');
        $registro->estado = $request->input('estado');
        $registro->save();

        return redirect()->route('categorias.index')->with('mensaje','Nuevo Registro [ '.$registro->nombre.' ] se agregó con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, $id)
    {
        $registro = Categoria::findOrFail($id);
        $registro->nombre = $request->input('nombre');
        $registro->descripcion = $request->input('descripcion');
        $registro->estado = $request->input('estado');
        $registro->save();
        return redirect()->route('categorias.index')->with('mensaje', 'El Registro [ ' . $registro->nombre . ' ] Se Actualizo con Exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $registro = Categoria::findOrFail($id);
            $registro->delete();
            return redirect()->route('categorias.index')->with('mensaje', 'Registro ' . $registro->nombre . ' eliminado con exito');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categorias.index')->with('error', 'Error al eliminar el registro porque esta siendo usado');
        }
    }
}
