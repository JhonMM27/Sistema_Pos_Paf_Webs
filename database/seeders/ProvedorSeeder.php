<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provedor;
use App\Models\TipoProveedor;
use Faker\Factory as Faker;

class ProvedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_PE'); // Usar localización de Perú para datos más realistas
        $tipoProveedorIds = TipoProveedor::pluck('id')->all();

        if (empty($tipoProveedorIds)) {
            $this->command->info('La tabla de tipos de proveedor está vacía. Ejecute TipoProveedorSeeder primero.');
            return;
        }

        // Lista de proveedores realistas para un minimarket en Perú
        $proveedores = [
            ['nombre' => 'Arca Continental Lindley', 'ruc' => '20101234567'], // Coca-Cola, Inca Kola
            ['nombre' => 'Backus y Johnston', 'ruc' => '20100113610'], // Cervezas (Pilsen, Cristal)
            ['nombre' => 'AJEGROUP', 'ruc' => '20331032126'], // Big Cola, Sporade, Cifrut
            ['nombre' => 'Pepsico Alimentos', 'ruc' => '20418413551'], // Lays, Doritos
            ['nombre' => 'Nestlé Perú', 'ruc' => '20100122136'], // Sublime, Donofrio
            ['nombre' => 'Mondelez Perú', 'ruc' => '20551351231'], // Oreo, Ritz, Trident
            ['nombre' => 'Gloria S.A.', 'ruc' => '20100190797'], // Leche, yogur, quesos
            ['nombre' => 'Laive S.A.', 'ruc' => '20100095450'], // Lácteos y embutidos
            ['nombre' => 'Alicorp S.A.A.', 'ruc' => '20100055237'], // Aceites, pastas, harinas
            ['nombre' => 'Molitalia S.A.', 'ruc' => '20100035121'], // Pastas y galletas
            ['nombre' => 'San Jorge', 'ruc' => '20100022345'], // Galletas y confitería
            ['nombre' => 'G.W. Yichang & Cia', 'ruc' => '20100045151'], // Conservas y enlatados
            ['nombre' => 'Procter & Gamble Perú (P&G)', 'ruc' => '20100115353'], // Ariel, Head & Shoulders
            ['nombre' => 'Colgate-Palmolive Perú', 'ruc' => '20100124694'], // Colgate, Protex
            ['nombre' => 'Kimberly-Clark Perú', 'ruc' => '20298046927'], // Scott, Huggies
            ['nombre' => 'Clorox Perú', 'ruc' => '20507202379'], // Cloro y desinfectantes
            ['nombre' => 'Distribuidora D\'Onofrio', 'ruc' => '20100263629'], // Helados y panetones
            ['nombre' => 'Panificadora Bimbo del Perú', 'ruc' => '20342332197'], // Pan de molde
            ['nombre' => 'Vega Distribuidor', 'ruc' => '20518737381'], // Distribuidor mayorista
        ];

        foreach ($proveedores as $proveedorData) {
            Provedor::create([
                'nombre' => $proveedorData['nombre'],
                'TipoProveedor_id' => $faker->randomElement($tipoProveedorIds),
                'ruc_dni' => $proveedorData['ruc'],
                'telefono' => $faker->numerify('9########'),
                'direccion' => $faker->address,
                'correo' => strtolower(str_replace(' ', '', $proveedorData['nombre'])) . '@correo.com',
                'observaciones' => $faker->optional(0.2)->sentence, // 20% de probabilidad de tener observaciones
            ]);
        }
    }
}
