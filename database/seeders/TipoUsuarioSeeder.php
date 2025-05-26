<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo_usuarios = [
            ['name' => 'Cliente'],
            ['name' => 'Empleado']
        ];

        // Insertar categorías en la base de datos

    // TipoUsuario::insert($tipo_usuarios);
        // Categoria::insert($categorias);

        DB::table('tipo_usuarios')->insert($tipo_usuarios);
    }
}
