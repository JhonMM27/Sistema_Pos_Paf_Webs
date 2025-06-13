<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $texto = $request->get('texto');
        // $user = User::with(['roles', 'permissions'])->findOrFail($id);
        $usuarios = User::all();
        $roles = Role::all();
        $permisos = Permission::all();
        $tipo_usuario = TipoUsuario::select('id','name')->get();


        $registros = User::where('name', 'LIKE', '%' . $texto . '%')->paginate(10);
        return view('configure.index', compact(['roles', 'permisos', 'texto', 'registros', 'usuarios','tipo_usuario']));

        // return view('configure.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email',
            'password' => 'min:6'
            // 'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'documento' => $request->documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'TipoUsuario_id' => $request->TipoUsuario_id ?: 2, // Default to 2 if not provided
        ]);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        return redirect()->route('configuracion.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
