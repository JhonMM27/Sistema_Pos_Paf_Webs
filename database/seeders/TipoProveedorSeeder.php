<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoProveedor;

class TipoProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            'Empresa',
            'Persona Natural',
            'Distribuidor Mayorista',
            'Fabricante',
            'Proveedor de Servicios',
        ];

        foreach ($tipos as $tipo) {
            TipoProveedor::create(['name' => $tipo]);
        }
    }
}
