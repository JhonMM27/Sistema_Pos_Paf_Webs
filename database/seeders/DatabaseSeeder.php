<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            TipoUsuarioSeeder::class,
            TipoProveedorSeeder::class,
            UsuarioSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            ProvedorSeeder::class,
            // CompraSeeder::class,
            // DetalleCompraSeeder::class,
            // VentaSeeder::class,
            // DetalleVentaSeeder::class,
            // ConfiguracionSeeder::class,
        ]);
    }
}