<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Bebidas',
                'descripcion' => 'Refrescos, jugos, agua embotellada, bebidas energéticas y gaseosas.',
                'estado' => true,
            ],
            [
                'nombre' => 'Snacks y Golosinas',
                'descripcion' => 'Papas fritas, galletas, chocolates, caramelos, chicles y dulces.',
                'estado' => true,
            ],
            [
                'nombre' => 'Lácteos',
                'descripcion' => 'Leche, yogur, queso, mantequilla y productos lácteos.',
                'estado' => true,
            ],
            [
                'nombre' => 'Panadería',
                'descripcion' => 'Pan, galletas, pasteles, bollería y productos de panadería.',
                'estado' => true,
            ],
            [
                'nombre' => 'Carnes y Embutidos',
                'descripcion' => 'Jamón, salchichas, mortadela, chorizo y productos cárnicos.',
                'estado' => true,
            ],
            [
                'nombre' => 'Enlatados',
                'descripcion' => 'Atún, sardinas, frijoles, maíz, champiñones y conservas.',
                'estado' => true,
            ],
            [
                'nombre' => 'Pastas y Arroz',
                'descripcion' => 'Fideos, espaguetis, arroz, harina y productos básicos.',
                'estado' => true,
            ],
            [
                'nombre' => 'Condimentos',
                'descripcion' => 'Salsas, mayonesa, ketchup, mostaza, aceite y vinagre.',
                'estado' => true,
            ],
            [
                'nombre' => 'Higiene Personal',
                'descripcion' => 'Jabón, shampoo, pasta dental, papel higiénico y productos de cuidado.',
                'estado' => true,
            ],
            [
                'nombre' => 'Limpieza del Hogar',
                'descripcion' => 'Detergentes, cloro, desinfectantes y productos de limpieza.',
                'estado' => true,
            ],
            [
                'nombre' => 'Congelados',
                'descripcion' => 'Helados, pizzas congeladas, hamburguesas y productos congelados.',
                'estado' => true,
            ],
            [
                'nombre' => 'Cereales y Desayunos',
                'descripcion' => 'Cereales, avena, miel, mermeladas y productos para el desayuno.',
                'estado' => true,
            ],
            [
                'nombre' => 'Bebidas Alcohólicas',
                'descripcion' => 'Cerveza, vino, licores y bebidas alcohólicas.',
                'estado' => true,
            ],
            [
                'nombre' => 'Cigarrillos y Tabaco',
                'descripcion' => 'Cigarrillos, tabaco, encendedores y productos relacionados.',
                'estado' => true,
            ],
            [
                'nombre' => 'Misceláneos',
                'descripcion' => 'Pilas, velas, encendedores, útiles escolares y productos varios.',
                'estado' => true,
            ],
        ];

        DB::table('categorias')->insert($categorias);
    }
}