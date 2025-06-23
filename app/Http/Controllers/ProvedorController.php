<?php

namespace App\Http\Controllers;

use App\Models\Provedor;
use App\Models\TipoProveedor;
use App\Http\Requests\StoreProvedorRequest;
use App\Http\Requests\UpdateProvedorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Provedor::with('tipoProveedor');

        // Filtro por texto de búsqueda
        if ($request->filled('texto')) {
            $texto = $request->texto;
            $query->where(function ($q) use ($texto) {
                $q->where('nombre', 'LIKE', "%{$texto}%")
                    ->orWhere('ruc_dni', 'LIKE', "%{$texto}%")
                    ->orWhere('correo', 'LIKE', "%{$texto}%");
            });
        }

        // Filtro por tipo
        if ($request->filled('TipoProveedor_id')) {
            $query->where('TipoProveedor_id', $request->TipoProveedor_id);
        }

        $registros = $query->orderBy('nombre')->paginate(10);
        $tipos_proveedor = TipoProveedor::all();

        return view('proveedor.index', compact('registros', 'tipos_proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos_proveedor = TipoProveedor::all();
        return view('proveedor.create', compact('tipos_proveedor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvedorRequest $request)
    {
        try {
            DB::beginTransaction();

            Provedor::create($request->validated());

            DB::commit();

            return redirect()->route('proveedores.index')
                ->with('mensaje', 'Proveedor creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Error al crear el proveedor: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Provedor $proveedore)
    {
        $proveedore->load('tipoProveedor');
        return view('proveedor.show', compact('proveedore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provedor $proveedore)
    {
        $tipos_proveedor = TipoProveedor::all();
        return view('proveedor.edit', compact('proveedore', 'tipos_proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvedorRequest $request, Provedor $proveedore)
    {
        try {
            DB::beginTransaction();

            $proveedore->update($request->validated());

            DB::commit();

            return redirect()->route('proveedores.index')
                ->with('mensaje', 'Proveedor actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Error al actualizar el proveedor: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provedor $proveedore)
    {
        try {
            DB::beginTransaction();

            // Verificar si el proveedor tiene compras asociadas
            if ($proveedore->compras()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'No se puede eliminar el proveedor porque tiene compras asociadas.');
            }

            $proveedore->delete();

            DB::commit();

            return redirect()->route('proveedores.index')
                ->with('mensaje', 'Proveedor eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Error al eliminar el proveedor: ' . $e->getMessage());
        }
    }
}
