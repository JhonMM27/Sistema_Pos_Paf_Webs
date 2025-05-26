<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permisos = [
            'rol-listar',
            'rol-crear',
            'rol-editar',
            'rol-eliminar',

            'usuario-listar',
            'usuario-crear',
            'usuario-editar',
            'usuario-eliminar',
            'usuario-activar',

            'categoria-listar',
            'categoria-crear',
            'categoria-editar',
            'categoria-activar',
            'categoria-eliminar',

            'producto-listar',
            'producto-crear',
            'producto-editar',
            'producto-activar',
            'producto-eliminar',

            'venta-crear',
            'venta-listar',
            'venta-anular',
            'venta-eliminar',
            'venta-listar',
            'venta-activar',

            'reporte-generar',
            'comprobante-venta',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $adminRole->syncPermissions($permisos);

        $vendedorPermisos = [
            'venta-crear',
            'venta-listar',
            'venta-anular',
            'producto-listar',
            'categoria-listar',
            'comprobante-venta',
        ];

        $vendedorRole = Role::firstOrCreate(['name' => 'Vendedor']);
        $vendedorRole->syncPermissions($vendedorPermisos);

        // $tipo_usuarios = DB::table('tipo_usuarios')->pluck('id', 'name');
        $usuarios = [
            ['name' => 'Usuario Administrador', 'email' => 'admin@prueba.com', 'password' => 'admin' ,'role' => $adminRole],
            ['name' => 'Usuario Vendedor', 'email' => 'vendedor@prueba.com', 'password' => 'vendedor', 'role' => $vendedorRole],
        ];


        foreach ($usuarios as $usuarioData) {
            $user = User::firstOrCreate(
                ['email' => $usuarioData['email']],
                ['name' => $usuarioData['name'], 'password' => Hash::make($usuarioData['password'])]
            );
            $user->assignRole($usuarioData['role']);
        }
    }
}
