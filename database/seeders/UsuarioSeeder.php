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
            // Roles y usuarios
            'rol-listar', 'rol-crear', 'rol-editar', 'rol-eliminar',
            'usuario-listar', 'usuario-crear', 'usuario-editar', 'usuario-eliminar', 'usuario-activar',
            // Categorías
            'categoria-listar', 'categoria-crear', 'categoria-editar', 'categoria-eliminar', 'categoria-activar',
            // Productos
            'producto-listar', 'producto-crear', 'producto-editar', 'producto-eliminar', 'producto-activar',
            // Ventas
            'venta-listar', 'venta-crear', 'venta-editar', 'venta-eliminar', 'venta-anular', 'venta-activar', 'venta-ver',
            // Compras
            'compra-listar', 'compra-crear', 'compra-eliminar', 'compra-anular', 'compra-ver',
            // Clientes
            'cliente-listar', 'cliente-crear', 'cliente-editar', 'cliente-eliminar', 'cliente-ver',
            // Proveedores
            'proveedor-listar', 'proveedor-crear', 'proveedor-editar', 'proveedor-eliminar', 'proveedor-ver',
            // Devoluciones
            'devolucion-listar', 'devolucion-crear', 'devolucion-ver',
            // Reportes
            'reporte-generar', 'reporte-exportar', 'reporte-ver',
            // Otros
            'comprobante-venta',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $salesRole = Role::firstOrCreate(['name' => 'Vendedor']); // Alias: sales

        // Permisos por rol
        $adminRole->syncPermissions($permisos);

        $managerPermisos = [
            // Gestión casi total, excepto roles/usuarios
            // Categorías, productos, ventas, compras, clientes, proveedores, devoluciones, reportes
            'categoria-listar', 'categoria-crear', 'categoria-editar', 'categoria-eliminar', 'categoria-activar',
            'producto-listar', 'producto-crear', 'producto-editar', 'producto-eliminar', 'producto-activar',
            'venta-listar', 'venta-crear', 'venta-editar', 'venta-eliminar', 'venta-anular', 'venta-activar', 'venta-ver',
            'compra-listar', 'compra-crear', 'compra-eliminar', 'compra-anular', 'compra-ver',
            'cliente-listar', 'cliente-crear', 'cliente-editar', 'cliente-eliminar', 'cliente-ver',
            'proveedor-listar', 'proveedor-crear', 'proveedor-editar', 'proveedor-eliminar', 'proveedor-ver',
            'devolucion-listar', 'devolucion-crear', 'devolucion-ver',
            'reporte-generar', 'reporte-exportar', 'reporte-ver',
            'comprobante-venta',
        ];
        $managerRole->syncPermissions($managerPermisos);

        $salesPermisos = [
            // Ventas, clientes, ver productos/categorías, ver reportes
            'venta-listar', 'venta-crear', 'venta-anular', 'venta-activar', 'venta-ver',
            'cliente-listar', 'cliente-crear', 'cliente-editar', 'cliente-ver',
            'producto-listar', 'categoria-listar',
            'reporte-generar', 'reporte-ver',
            'comprobante-venta',
        ];
        $salesRole->syncPermissions($salesPermisos);

        // Obtener el id de tipo usuario Empleado
        $tipoEmpleadoId = DB::table('tipo_usuarios')->where('name', 'Empleado')->value('id');

        $usuarios = [
            [
                'name' => 'Usuario Administrador',
                'email' => 'admin@prueba.com',
                'password' => 'admin',
                'role' => $adminRole,
                'TipoUsuario_id' => $tipoEmpleadoId,
            ],
            [
                'name' => 'Usuario Manager',
                'email' => 'manager@prueba.com',
                'password' => 'manager',
                'role' => $managerRole,
                'TipoUsuario_id' => $tipoEmpleadoId,
            ],
            [
                'name' => 'Usuario Vendedor',
                'email' => 'sales@prueba.com',
                'password' => 'sales',
                'role' => $salesRole,
                'TipoUsuario_id' => $tipoEmpleadoId,
            ],
        ];

        foreach ($usuarios as $usuarioData) {
            $user = User::firstOrCreate(
                ['email' => $usuarioData['email']],
                [
                    'name' => $usuarioData['name'],
                    'password' => Hash::make($usuarioData['password']),
                    'TipoUsuario_id' => $usuarioData['TipoUsuario_id'],
                ]
            );
            $user->assignRole($usuarioData['role']);
        }
    }
}
