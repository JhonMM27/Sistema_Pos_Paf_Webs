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
                'nombre' => 'Alimentos y comestibles',
                'descripcion' => 'Productos básicos como arroz, frijol, pastas, enlatados y conservas.',
                'estado' => true,
            ],
            [
                'nombre' => 'Dulces y botanas',
                'descripcion' => 'Golosinas, papas, cacahuates y otros snacks.',
                'estado' => true,
            ],
            [
                'nombre' => 'Bebidas',
                'descripcion' => 'Refrescos, jugos, agua embotellada, café y té.',
                'estado' => true,
            ],
            [
                'nombre' => 'Artículos de limpieza',
                'descripcion' => 'Productos para limpieza del hogar como detergentes, jabones y cloro.',
                'estado' => true,
            ],
            [
                'nombre' => 'Higiene personal',
                'descripcion' => 'Papel higiénico, pasta dental, shampoo, toallas sanitarias, entre otros.',
                'estado' => true,
            ],
            [
                'nombre' => 'Lácteos y refrigerados',
                'descripcion' => 'Leche, yogur, queso y productos que requieren refrigeración.',
                'estado' => true,
            ],
            [
                'nombre' => 'Carnes frías y embutidos',
                'descripcion' => 'Salchichas, jamón y productos cárnicos procesados.',
                'estado' => true,
            ],
            [
                'nombre' => 'Misceláneos',
                'descripcion' => 'Productos variados como pilas, veladoras, utensilios desechables, etc.',
                'estado' => true,
            ],
        ];

        DB::table('categorias')->insert($categorias);
    }
}