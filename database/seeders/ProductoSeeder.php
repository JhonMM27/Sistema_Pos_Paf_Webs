<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;
use Faker\Factory as Faker;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Coca Cola 500ml',
            'codigo_barras' => '2558425143072',
            'descripcion' => 'Refresco Coca Cola botella 500ml',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 150,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pepsi 1L',
            'codigo_barras' => '8054219072329',
            'descripcion' => 'Refresco Pepsi botella 1 litro',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 194,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Inca Kola 500ml',
            'codigo_barras' => '5557562724257',
            'descripcion' => 'Refresco Inca Kola botella 500ml',
            'precio' => 2.3,
            'precio_compra' => 1.84,

            'stock' => 25,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Agua San Luis 500ml',
            'codigo_barras' => '9172951421201',
            'descripcion' => 'Agua mineral San Luis botella 500ml',
            'precio' => 1.2,
            'precio_compra' => 0.96,

            'stock' => 141,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jugo de Naranja 1L',
            'codigo_barras' => '7928844854739',
            'descripcion' => 'Jugo de naranja natural 1 litro',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 139,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Red Bull 250ml',
            'codigo_barras' => '7240060678204',
            'descripcion' => 'Bebida energética Red Bull lata 250ml',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 38,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Sprite 500ml',
            'codigo_barras' => '5469468946339',
            'descripcion' => 'Refresco Sprite botella 500ml',
            'precio' => 2.4,
            'precio_compra' => 1.92,

            'stock' => 29,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Fanta 500ml',
            'codigo_barras' => '8292863849007',
            'descripcion' => 'Refresco Fanta botella 500ml',
            'precio' => 2.4,
            'precio_compra' => 1.92,

            'stock' => 102,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Agua con Gas 500ml',
            'codigo_barras' => '8560189356821',
            'descripcion' => 'Agua con gas San Luis 500ml',
            'precio' => 1.5,
            'precio_compra' => 1.2,

            'stock' => 172,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Limonada 1L',
            'codigo_barras' => '9876446022323',
            'descripcion' => 'Limonada natural 1 litro',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 62,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Papas Lays Clásicas',
            'codigo_barras' => '1616047347474',
            'descripcion' => 'Papas fritas Lays sabor clásico 150g',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 161,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Doritos Nacho',
            'codigo_barras' => '2089248154483',
            'descripcion' => 'Tortillas Doritos sabor nacho 150g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 67,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chocolate Hersheys',
            'codigo_barras' => '8732376341303',
            'descripcion' => 'Chocolate Hersheys barra 43g',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 77,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas Oreo',
            'codigo_barras' => '5610943878861',
            'descripcion' => 'Galletas Oreo paquete 137g',
            'precio' => 5.5,
            'precio_compra' => 4.4,

            'stock' => 71,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chicles Trident',
            'codigo_barras' => '9400668450987',
            'descripcion' => 'Chicles Trident sabor menta 12 unidades',
            'precio' => 2.8,
            'precio_compra' => 2.24,

            'stock' => 55,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Caramelos Halls',
            'codigo_barras' => '4621834560940',
            'descripcion' => 'Caramelos Halls sabor mentol 10 unidades',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 98,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Maní Salado',
            'codigo_barras' => '2519241623742',
            'descripcion' => 'Maní salado tostado 200g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 142,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chocolate Snickers',
            'codigo_barras' => '4127583724232',
            'descripcion' => 'Chocolate Snickers barra 57g',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 58,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas Ritz',
            'codigo_barras' => '9412101667760',
            'descripcion' => 'Galletas saladas Ritz 200g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 32,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chocolate M&M',
            'codigo_barras' => '8100095332566',
            'descripcion' => 'Chocolate M&M con maní 45g',
            'precio' => 3.9,
            'precio_compra' => 3.12,

            'stock' => 179,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Leche Gloria 1L',
            'codigo_barras' => '5020508673846',
            'descripcion' => 'Leche evaporada Gloria 1 litro',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 108,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Yogur Gloria Natural',
            'codigo_barras' => '7894557682832',
            'descripcion' => 'Yogur natural Gloria 170g',
            'precio' => 2.8,
            'precio_compra' => 2.24,

            'stock' => 100,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Queso Fresco 500g',
            'codigo_barras' => '5550668436123',
            'descripcion' => 'Queso fresco 500 gramos',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 81,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mantequilla Gloria 250g',
            'codigo_barras' => '1113792672023',
            'descripcion' => 'Mantequilla Gloria 250 gramos',
            'precio' => 6.8,
            'precio_compra' => 5.44,

            'stock' => 42,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Leche Condensada',
            'codigo_barras' => '5649829113376',
            'descripcion' => 'Leche condensada 395g',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 76,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Queso Edam 300g',
            'codigo_barras' => '6427024845013',
            'descripcion' => 'Queso Edam 300 gramos',
            'precio' => 12.5,
            'precio_compra' => 10.0,

            'stock' => 22,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Yogur de Fresa',
            'codigo_barras' => '637000659121',
            'descripcion' => 'Yogur de fresa 170g',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 39,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Leche Deslactosada',
            'codigo_barras' => '9591477642707',
            'descripcion' => 'Leche deslactosada 1L',
            'precio' => 5.8,
            'precio_compra' => 4.64,

            'stock' => 22,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Queso Mozzarella',
            'codigo_barras' => '9340567911366',
            'descripcion' => 'Queso mozzarella rallado 200g',
            'precio' => 9.5,
            'precio_compra' => 7.6,

            'stock' => 100,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Crema de Leche',
            'codigo_barras' => '5520914617064',
            'descripcion' => 'Crema de leche 200ml',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 42,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan de Molde',
            'codigo_barras' => '5834498932193',
            'descripcion' => 'Pan de molde integral 500g',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 63,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Croissants',
            'codigo_barras' => '7089492453672',
            'descripcion' => 'Croissants de mantequilla 6 unidades',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 82,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas de Vainilla',
            'codigo_barras' => '9328480442570',
            'descripcion' => 'Galletas de vainilla 200g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 153,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan Ciabatta',
            'codigo_barras' => '1917637244327',
            'descripcion' => 'Pan ciabatta artesanal 300g',
            'precio' => 5.2,
            'precio_compra' => 4.16,

            'stock' => 4,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Donas Glaseadas',
            'codigo_barras' => '384327216130',
            'descripcion' => 'Donas glaseadas 6 unidades',
            'precio' => 7.5,
            'precio_compra' => 6.0,

            'stock' => 193,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan de Yema',
            'codigo_barras' => '1091058249922',
            'descripcion' => 'Pan de yema tradicional 100g',
            'precio' => 1.5,
            'precio_compra' => 1.2,

            'stock' => 183,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas de Chocolate',
            'codigo_barras' => '2390235816063',
            'descripcion' => 'Galletas con chispas de chocolate 250g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 63,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan Integral',
            'codigo_barras' => '7799917786550',
            'descripcion' => 'Pan integral 400g',
            'precio' => 5.5,
            'precio_compra' => 4.4,

            'stock' => 199,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Muffins de Vainilla',
            'codigo_barras' => '4859297284626',
            'descripcion' => 'Muffins de vainilla 4 unidades',
            'precio' => 6.2,
            'precio_compra' => 4.96,

            'stock' => 58,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan de Ajo',
            'codigo_barras' => '7547102729123',
            'descripcion' => 'Pan de ajo 200g',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 34,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Coca Cola 500ml',
            'codigo_barras' => '6825331369527',
            'descripcion' => 'Refresco Coca Cola botella 500ml',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 102,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pepsi 1L',
            'codigo_barras' => '45601474973',
            'descripcion' => 'Refresco Pepsi botella 1 litro',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 170,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Inca Kola 500ml',
            'codigo_barras' => '4796504110326',
            'descripcion' => 'Refresco Inca Kola botella 500ml',
            'precio' => 2.3,
            'precio_compra' => 1.84,

            'stock' => 198,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Agua San Luis 500ml',
            'codigo_barras' => '4490592139930',
            'descripcion' => 'Agua mineral San Luis botella 500ml',
            'precio' => 1.2,
            'precio_compra' => 0.96,

            'stock' => 145,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jugo de Naranja 1L',
            'codigo_barras' => '3021154152077',
            'descripcion' => 'Jugo de naranja natural 1 litro',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 110,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Red Bull 250ml',
            'codigo_barras' => '7323939125914',
            'descripcion' => 'Bebida energética Red Bull lata 250ml',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 76,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Sprite 500ml',
            'codigo_barras' => '4557882997288',
            'descripcion' => 'Refresco Sprite botella 500ml',
            'precio' => 2.4,
            'precio_compra' => 1.92,

            'stock' => 176,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Fanta 500ml',
            'codigo_barras' => '1955849059612',
            'descripcion' => 'Refresco Fanta botella 500ml',
            'precio' => 2.4,
            'precio_compra' => 1.92,

            'stock' => 52,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Agua con Gas 500ml',
            'codigo_barras' => '9856309118356',
            'descripcion' => 'Agua con gas San Luis 500ml',
            'precio' => 1.5,
            'precio_compra' => 1.2,

            'stock' => 89,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Limonada 1L',
            'codigo_barras' => '9528851808794',
            'descripcion' => 'Limonada natural 1 litro',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 22,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Papas Lays Clásicas',
            'codigo_barras' => '4618348731546',
            'descripcion' => 'Papas fritas Lays sabor clásico 150g',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 134,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Doritos Nacho',
            'codigo_barras' => '3529888571824',
            'descripcion' => 'Tortillas Doritos sabor nacho 150g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 30,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chocolate Hersheys',
            'codigo_barras' => '7451260851391',
            'descripcion' => 'Chocolate Hersheys barra 43g',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 70,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas Oreo',
            'codigo_barras' => '8289895704046',
            'descripcion' => 'Galletas Oreo paquete 137g',
            'precio' => 5.5,
            'precio_compra' => 4.4,

            'stock' => 63,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chicles Trident',
            'codigo_barras' => '9415548445519',
            'descripcion' => 'Chicles Trident sabor menta 12 unidades',
            'precio' => 2.8,
            'precio_compra' => 2.24,

            'stock' => 181,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Caramelos Halls',
            'codigo_barras' => '5036050016765',
            'descripcion' => 'Caramelos Halls sabor mentol 10 unidades',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 57,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Maní Salado',
            'codigo_barras' => '52305223363',
            'descripcion' => 'Maní salado tostado 200g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 29,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chocolate Snickers',
            'codigo_barras' => '7095834846651',
            'descripcion' => 'Chocolate Snickers barra 57g',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 125,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas Ritz',
            'codigo_barras' => '1315184484034',
            'descripcion' => 'Galletas saladas Ritz 200g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 164,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chocolate M&M',
            'codigo_barras' => '1883926266403',
            'descripcion' => 'Chocolate M&M con maní 45g',
            'precio' => 3.9,
            'precio_compra' => 3.12,

            'stock' => 135,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Snacks y Golosinas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Leche Gloria 1L',
            'codigo_barras' => '173047875556',
            'descripcion' => 'Leche evaporada Gloria 1 litro',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 12,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Yogur Gloria Natural',
            'codigo_barras' => '2844190012461',
            'descripcion' => 'Yogur natural Gloria 170g',
            'precio' => 2.8,
            'precio_compra' => 2.24,

            'stock' => 167,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Queso Fresco 500g',
            'codigo_barras' => '6151099254103',
            'descripcion' => 'Queso fresco 500 gramos',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 149,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mantequilla Gloria 250g',
            'codigo_barras' => '5859337089388',
            'descripcion' => 'Mantequilla Gloria 250 gramos',
            'precio' => 6.8,
            'precio_compra' => 5.44,

            'stock' => 165,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Leche Condensada',
            'codigo_barras' => '7149155583327',
            'descripcion' => 'Leche condensada 395g',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 104,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Queso Edam 300g',
            'codigo_barras' => '4561153078835',
            'descripcion' => 'Queso Edam 300 gramos',
            'precio' => 12.5,
            'precio_compra' => 10.0,

            'stock' => 107,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Yogur de Fresa',
            'codigo_barras' => '9731957088056',
            'descripcion' => 'Yogur de fresa 170g',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 22,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Leche Deslactosada',
            'codigo_barras' => '2721792883050',
            'descripcion' => 'Leche deslactosada 1L',
            'precio' => 5.8,
            'precio_compra' => 4.64,

            'stock' => 192,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Queso Mozzarella',
            'codigo_barras' => '5393455440343',
            'descripcion' => 'Queso mozzarella rallado 200g',
            'precio' => 9.5,
            'precio_compra' => 7.6,

            'stock' => 12,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Crema de Leche',
            'codigo_barras' => '7817846302174',
            'descripcion' => 'Crema de leche 200ml',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 102,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Lácteos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan de Molde',
            'codigo_barras' => '7079235150852',
            'descripcion' => 'Pan de molde integral 500g',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 199,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Croissants',
            'codigo_barras' => '2848881358333',
            'descripcion' => 'Croissants de mantequilla 6 unidades',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 136,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas de Vainilla',
            'codigo_barras' => '8326458054900',
            'descripcion' => 'Galletas de vainilla 200g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 128,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan Ciabatta',
            'codigo_barras' => '2092709853160',
            'descripcion' => 'Pan ciabatta artesanal 300g',
            'precio' => 5.2,
            'precio_compra' => 4.16,

            'stock' => 178,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Donas Glaseadas',
            'codigo_barras' => '1713067264290',
            'descripcion' => 'Donas glaseadas 6 unidades',
            'precio' => 7.5,
            'precio_compra' => 6.0,

            'stock' => 173,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan de Yema',
            'codigo_barras' => '208645276525',
            'descripcion' => 'Pan de yema tradicional 100g',
            'precio' => 1.5,
            'precio_compra' => 1.2,

            'stock' => 189,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Galletas de Chocolate',
            'codigo_barras' => '8405984779829',
            'descripcion' => 'Galletas con chispas de chocolate 250g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 155,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan Integral',
            'codigo_barras' => '1025129770640',
            'descripcion' => 'Pan integral 400g',
            'precio' => 5.5,
            'precio_compra' => 4.4,

            'stock' => 189,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Muffins de Vainilla',
            'codigo_barras' => '3225030718702',
            'descripcion' => 'Muffins de vainilla 4 unidades',
            'precio' => 6.2,
            'precio_compra' => 4.96,

            'stock' => 185,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pan de Ajo',
            'codigo_barras' => '5554304935216',
            'descripcion' => 'Pan de ajo 200g',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 188,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Panadería')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jamón de Pavo',
            'codigo_barras' => '1120235645759',
            'descripcion' => 'Jamón de pavo 200g',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 32,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Salchichas de Pollo',
            'codigo_barras' => '8129791956043',
            'descripcion' => 'Salchichas de pollo 400g',
            'precio' => 6.8,
            'precio_compra' => 5.44,

            'stock' => 131,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mortadela',
            'codigo_barras' => '8826658420500',
            'descripcion' => 'Mortadela 300g',
            'precio' => 7.2,
            'precio_compra' => 5.76,

            'stock' => 104,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chorizo Parrillero',
            'codigo_barras' => '6510559354980',
            'descripcion' => 'Chorizo parrillero 250g',
            'precio' => 9.5,
            'precio_compra' => 7.6,

            'stock' => 168,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jamón de Cerdo',
            'codigo_barras' => '5267038130511',
            'descripcion' => 'Jamón de cerdo 250g',
            'precio' => 8.8,
            'precio_compra' => 7.04,

            'stock' => 65,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Salami',
            'codigo_barras' => '6158021571017',
            'descripcion' => 'Salami 200g',
            'precio' => 10.5,
            'precio_compra' => 8.4,

            'stock' => 81,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Tocino Ahumado',
            'codigo_barras' => '8798622808099',
            'descripcion' => 'Tocino ahumado 300g',
            'precio' => 12.8,
            'precio_compra' => 10.24,

            'stock' => 192,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pechuga de Pavo',
            'codigo_barras' => '1217189086506',
            'descripcion' => 'Pechuga de pavo 400g',
            'precio' => 15.5,
            'precio_compra' => 12.4,

            'stock' => 64,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Chorizo Español',
            'codigo_barras' => '1990493998108',
            'descripcion' => 'Chorizo español 200g',
            'precio' => 11.2,
            'precio_compra' => 8.96,

            'stock' => 48,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jamón Serrano',
            'codigo_barras' => '548180255587',
            'descripcion' => 'Jamón serrano 150g',
            'precio' => 18.5,
            'precio_compra' => 14.8,

            'stock' => 129,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Carnes y Embutidos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Atún en Agua',
            'codigo_barras' => '2055993254426',
            'descripcion' => 'Atún en agua 170g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 22,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Sardinas en Aceite',
            'codigo_barras' => '1279596951860',
            'descripcion' => 'Sardinas en aceite 125g',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 10,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Frijoles Negros',
            'codigo_barras' => '6797807257044',
            'descripcion' => 'Frijoles negros enlatados 400g',
            'precio' => 2.8,
            'precio_compra' => 2.24,

            'stock' => 135,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Maíz Dulce',
            'codigo_barras' => '871799816932',
            'descripcion' => 'Maíz dulce enlatado 340g',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 102,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Champiñones',
            'codigo_barras' => '4058710347898',
            'descripcion' => 'Champiñones enlatados 400g',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 48,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Atún en Aceite',
            'codigo_barras' => '7523741453438',
            'descripcion' => 'Atún en aceite 170g',
            'precio' => 5.2,
            'precio_compra' => 4.16,

            'stock' => 28,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Garbanzos',
            'codigo_barras' => '1600598707795',
            'descripcion' => 'Garbanzos enlatados 400g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 127,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Aceitunas Verdes',
            'codigo_barras' => '5500739707966',
            'descripcion' => 'Aceitunas verdes 200g',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 32,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Sardinas en Salsa',
            'codigo_barras' => '4743853142898',
            'descripcion' => 'Sardinas en salsa de tomate 125g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 118,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Lentejas',
            'codigo_barras' => '6981178378488',
            'descripcion' => 'Lentejas enlatadas 400g',
            'precio' => 2.9,
            'precio_compra' => 2.32,

            'stock' => 66,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Enlatados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Arroz Extra',
            'codigo_barras' => '1137937900185',
            'descripcion' => 'Arroz extra 1kg',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 49,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Fideos Spaghetti',
            'codigo_barras' => '1741340615538',
            'descripcion' => 'Fideos spaghetti 500g',
            'precio' => 2.8,
            'precio_compra' => 2.24,

            'stock' => 102,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Harina de Trigo',
            'codigo_barras' => '2869007598709',
            'descripcion' => 'Harina de trigo 1kg',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 136,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Fideos Tallarín',
            'codigo_barras' => '7664444699652',
            'descripcion' => 'Fideos tallarín 500g',
            'precio' => 2.8,
            'precio_compra' => 2.24,

            'stock' => 87,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Arroz Integral',
            'codigo_barras' => '5448552899966',
            'descripcion' => 'Arroz integral 1kg',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 0,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Fideos Rigatti',
            'codigo_barras' => '2829465389837',
            'descripcion' => 'Fideos rigatti 500g',
            'precio' => 3.2,
            'precio_compra' => 2.56,

            'stock' => 108,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Harina de Maíz',
            'codigo_barras' => '6161364863183',
            'descripcion' => 'Harina de maíz 500g',
            'precio' => 2.2,
            'precio_compra' => 1.76,

            'stock' => 104,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Arroz Basmati',
            'codigo_barras' => '8979478779928',
            'descripcion' => 'Arroz basmati 1kg',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 170,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Fideos Penne',
            'codigo_barras' => '7315497016278',
            'descripcion' => 'Fideos penne 500g',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 48,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Quinoa',
            'codigo_barras' => '3245146019098',
            'descripcion' => 'Quinoa 500g',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 179,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Pastas y Arroz')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Ketchup Heinz',
            'codigo_barras' => '4994663581425',
            'descripcion' => 'Ketchup Heinz 500ml',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 67,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mayonesa Hellmanns',
            'codigo_barras' => '9678922770113',
            'descripcion' => 'Mayonesa Hellmanns 400ml',
            'precio' => 5.8,
            'precio_compra' => 4.64,

            'stock' => 95,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mostaza Dijon',
            'codigo_barras' => '2252005650096',
            'descripcion' => 'Mostaza Dijon 200ml',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 15,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Aceite de Oliva',
            'codigo_barras' => '3347963684906',
            'descripcion' => 'Aceite de oliva extra virgen 500ml',
            'precio' => 12.5,
            'precio_compra' => 10.0,

            'stock' => 64,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Salsa de Soya',
            'codigo_barras' => '8037279778271',
            'descripcion' => 'Salsa de soya 500ml',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 98,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Vinagre de Manzana',
            'codigo_barras' => '9663923512015',
            'descripcion' => 'Vinagre de manzana 500ml',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 147,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Salsa Tabasco',
            'codigo_barras' => '3812303876919',
            'descripcion' => 'Salsa picante Tabasco 60ml',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 83,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Aceite Vegetal',
            'codigo_barras' => '234757010993',
            'descripcion' => 'Aceite vegetal 1L',
            'precio' => 6.8,
            'precio_compra' => 5.44,

            'stock' => 0,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Salsa BBQ',
            'codigo_barras' => '6635686716064',
            'descripcion' => 'Salsa BBQ 500ml',
            'precio' => 5.5,
            'precio_compra' => 4.4,

            'stock' => 46,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Vinagre Blanco',
            'codigo_barras' => '3813891444177',
            'descripcion' => 'Vinagre blanco 500ml',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 88,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Condimentos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jabón Dove',
            'codigo_barras' => '634155607410',
            'descripcion' => 'Jabón Dove barra 90g',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 42,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Shampoo Head & Shoulders',
            'codigo_barras' => '2439272656109',
            'descripcion' => 'Shampoo Head & Shoulders 400ml',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 118,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pasta Dental Colgate',
            'codigo_barras' => '9133148133543',
            'descripcion' => 'Pasta dental Colgate 100g',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 62,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Papel Higiénico Scott',
            'codigo_barras' => '9483500270936',
            'descripcion' => 'Papel higiénico Scott 4 rollos',
            'precio' => 5.8,
            'precio_compra' => 4.64,

            'stock' => 133,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Desodorante Rexona',
            'codigo_barras' => '8576587052913',
            'descripcion' => 'Desodorante Rexona 150ml',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 113,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Toallas Húmedas',
            'codigo_barras' => '1572753297352',
            'descripcion' => 'Toallas húmedas 80 unidades',
            'precio' => 7.2,
            'precio_compra' => 5.76,

            'stock' => 131,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cepillo de Dientes',
            'codigo_barras' => '8392619951876',
            'descripcion' => 'Cepillo de dientes Oral-B',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 176,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Crema Facial',
            'codigo_barras' => '3927573994581',
            'descripcion' => 'Crema facial hidratante 50ml',
            'precio' => 12.5,
            'precio_compra' => 10.0,

            'stock' => 99,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Toallas Sanitarias',
            'codigo_barras' => '101613033079',
            'descripcion' => 'Toallas sanitarias 10 unidades',
            'precio' => 8.8,
            'precio_compra' => 7.04,

            'stock' => 167,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Enjuague Bucal',
            'codigo_barras' => '4380649088970',
            'descripcion' => 'Enjuague bucal Listerine 500ml',
            'precio' => 15.5,
            'precio_compra' => 12.4,

            'stock' => 77,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Higiene Personal')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Detergente Ariel',
            'codigo_barras' => '1477122203739',
            'descripcion' => 'Detergente Ariel 1kg',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 63,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cloro Clorox',
            'codigo_barras' => '7720475674171',
            'descripcion' => 'Cloro Clorox 1L',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 33,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jabón Líquido',
            'codigo_barras' => '684593962138',
            'descripcion' => 'Jabón líquido para platos 500ml',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 146,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Desinfectante Lysol',
            'codigo_barras' => '8480294250749',
            'descripcion' => 'Desinfectante Lysol 500ml',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 197,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Limpiador Multiuso',
            'codigo_barras' => '8122647110576',
            'descripcion' => 'Limpiador multiuso 500ml',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 175,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Detergente para Ropa',
            'codigo_barras' => '5309068106965',
            'descripcion' => 'Detergente para ropa 2kg',
            'precio' => 12.5,
            'precio_compra' => 10.0,

            'stock' => 22,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Limpiador de Baño',
            'codigo_barras' => '9374677492095',
            'descripcion' => 'Limpiador de baño 500ml',
            'precio' => 5.2,
            'precio_compra' => 4.16,

            'stock' => 185,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Desodorante Ambiental',
            'codigo_barras' => '9139787743884',
            'descripcion' => 'Desodorante ambiental 400ml',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 83,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Jabón en Polvo',
            'codigo_barras' => '6473507566289',
            'descripcion' => 'Jabón en polvo 1kg',
            'precio' => 6.8,
            'precio_compra' => 5.44,

            'stock' => 68,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Limpiador de Cocina',
            'codigo_barras' => '8172417574862',
            'descripcion' => 'Limpiador de cocina 500ml',
            'precio' => 4.2,
            'precio_compra' => 3.36,

            'stock' => 199,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Limpieza del Hogar')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Helado de Vainilla',
            'codigo_barras' => '6892108120865',
            'descripcion' => 'Helado de vainilla 1L',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 162,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pizza Congelada',
            'codigo_barras' => '5651492036180',
            'descripcion' => 'Pizza congelada 4 quesos',
            'precio' => 12.8,
            'precio_compra' => 10.24,

            'stock' => 111,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Hamburguesas',
            'codigo_barras' => '9230666403483',
            'descripcion' => 'Hamburguesas congeladas 6 unidades',
            'precio' => 15.5,
            'precio_compra' => 12.4,

            'stock' => 130,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Papas Fritas',
            'codigo_barras' => '3212061742073',
            'descripcion' => 'Papas fritas congeladas 1kg',
            'precio' => 6.8,
            'precio_compra' => 5.44,

            'stock' => 75,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Helado de Chocolate',
            'codigo_barras' => '9662866871715',
            'descripcion' => 'Helado de chocolate 1L',
            'precio' => 9.2,
            'precio_compra' => 7.36,

            'stock' => 10,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Nuggets de Pollo',
            'codigo_barras' => '3390192553673',
            'descripcion' => 'Nuggets de pollo 500g',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 88,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Lasagna Congelada',
            'codigo_barras' => '5702841023426',
            'descripcion' => 'Lasagna congelada 400g',
            'precio' => 11.5,
            'precio_compra' => 9.2,

            'stock' => 20,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Helado de Fresa',
            'codigo_barras' => '4056677678680',
            'descripcion' => 'Helado de fresa 1L',
            'precio' => 8.8,
            'precio_compra' => 7.04,

            'stock' => 111,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Empanadas',
            'codigo_barras' => '7681294174924',
            'descripcion' => 'Empanadas congeladas 6 unidades',
            'precio' => 7.5,
            'precio_compra' => 6.0,

            'stock' => 133,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pollo Frito',
            'codigo_barras' => '194568759620',
            'descripcion' => 'Pollo frito congelado 500g',
            'precio' => 13.2,
            'precio_compra' => 10.56,

            'stock' => 117,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Congelados')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cereal Corn Flakes',
            'codigo_barras' => '8380153529590',
            'descripcion' => 'Cereal Corn Flakes 500g',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 106,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Avena Quaker',
            'codigo_barras' => '8096533004662',
            'descripcion' => 'Avena Quaker 500g',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 171,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Miel de Abeja',
            'codigo_barras' => '6937501710654',
            'descripcion' => 'Miel de abeja natural 500g',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 166,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mermelada de Fresa',
            'codigo_barras' => '8040028394714',
            'descripcion' => 'Mermelada de fresa 250g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 137,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cereal Choco Krispis',
            'codigo_barras' => '3520470824649',
            'descripcion' => 'Cereal Choco Krispis 400g',
            'precio' => 7.2,
            'precio_compra' => 5.76,

            'stock' => 195,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Granola',
            'codigo_barras' => '1973088333423',
            'descripcion' => 'Granola con frutos secos 300g',
            'precio' => 9.5,
            'precio_compra' => 7.6,

            'stock' => 58,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mermelada de Durazno',
            'codigo_barras' => '7702885672909',
            'descripcion' => 'Mermelada de durazno 250g',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 42,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cereal Special K',
            'codigo_barras' => '3104844905068',
            'descripcion' => 'Cereal Special K 400g',
            'precio' => 8.8,
            'precio_compra' => 7.04,

            'stock' => 185,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Mantequilla de Maní',
            'codigo_barras' => '1978529900424',
            'descripcion' => 'Mantequilla de maní 300g',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 66,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cereal All Bran',
            'codigo_barras' => '9977830882728',
            'descripcion' => 'Cereal All Bran 400g',
            'precio' => 7.8,
            'precio_compra' => 6.24,

            'stock' => 170,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cereales y Desayunos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cerveza Pilsen',
            'codigo_barras' => '1284591859424',
            'descripcion' => 'Cerveza Pilsen lata 355ml',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 4,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cerveza Cristal',
            'codigo_barras' => '8271512714446',
            'descripcion' => 'Cerveza Cristal botella 650ml',
            'precio' => 4.8,
            'precio_compra' => 3.84,

            'stock' => 95,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Vino Tinto',
            'codigo_barras' => '694124485920',
            'descripcion' => 'Vino tinto 750ml',
            'precio' => 25.5,
            'precio_compra' => 20.4,

            'stock' => 187,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cerveza Heineken',
            'codigo_barras' => '7029411030294',
            'descripcion' => 'Cerveza Heineken lata 355ml',
            'precio' => 5.2,
            'precio_compra' => 4.16,

            'stock' => 32,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Vino Blanco',
            'codigo_barras' => '4631341401001',
            'descripcion' => 'Vino blanco 750ml',
            'precio' => 22.8,
            'precio_compra' => 18.24,

            'stock' => 136,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cerveza Corona',
            'codigo_barras' => '160320969620',
            'descripcion' => 'Cerveza Corona botella 355ml',
            'precio' => 6.5,
            'precio_compra' => 5.2,

            'stock' => 70,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Whisky Johnnie Walker',
            'codigo_barras' => '8506554781607',
            'descripcion' => 'Whisky Johnnie Walker 750ml',
            'precio' => 85.5,
            'precio_compra' => 68.4,

            'stock' => 154,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cerveza Stella Artois',
            'codigo_barras' => '1214225421222',
            'descripcion' => 'Cerveza Stella Artois 330ml',
            'precio' => 7.2,
            'precio_compra' => 5.76,

            'stock' => 64,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Ron Bacardi',
            'codigo_barras' => '7234323097253',
            'descripcion' => 'Ron Bacardi 750ml',
            'precio' => 45.8,
            'precio_compra' => 36.64,

            'stock' => 107,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cerveza Budweiser',
            'codigo_barras' => '6526125700655',
            'descripcion' => 'Cerveza Budweiser lata 355ml',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 16,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Bebidas Alcohólicas')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cigarrillos Marlboro',
            'codigo_barras' => '3221103912794',
            'descripcion' => 'Cigarrillos Marlboro caja 20 unidades',
            'precio' => 12.5,
            'precio_compra' => 10.0,

            'stock' => 166,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cigarrillos Lucky Strike',
            'codigo_barras' => '4037321319128',
            'descripcion' => 'Cigarrillos Lucky Strike caja 20 unidades',
            'precio' => 11.8,
            'precio_compra' => 9.44,

            'stock' => 16,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Encendedor BIC',
            'codigo_barras' => '3508150579126',
            'descripcion' => 'Encendedor BIC 3 unidades',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 196,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cigarrillos Camel',
            'codigo_barras' => '1351449178942',
            'descripcion' => 'Cigarrillos Camel caja 20 unidades',
            'precio' => 13.2,
            'precio_compra' => 10.56,

            'stock' => 141,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Tabaco para Enrollar',
            'codigo_barras' => '9123079913550',
            'descripcion' => 'Tabaco para enrollar 30g',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 70,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cigarrillos Winston',
            'codigo_barras' => '6747031312255',
            'descripcion' => 'Cigarrillos Winston caja 20 unidades',
            'precio' => 11.5,
            'precio_compra' => 9.2,

            'stock' => 27,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Encendedor Zippo',
            'codigo_barras' => '8662214131493',
            'descripcion' => 'Encendedor Zippo',
            'precio' => 25.8,
            'precio_compra' => 20.64,

            'stock' => 6,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cigarrillos Parliament',
            'codigo_barras' => '777545846706',
            'descripcion' => 'Cigarrillos Parliament caja 20 unidades',
            'precio' => 12.8,
            'precio_compra' => 10.24,

            'stock' => 14,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Papel para Enrollar',
            'codigo_barras' => '1761732465954',
            'descripcion' => 'Papel para enrollar 50 hojas',
            'precio' => 1.5,
            'precio_compra' => 1.2,

            'stock' => 2,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cigarrillos Virginia Slims',
            'codigo_barras' => '4198632784866',
            'descripcion' => 'Cigarrillos Virginia Slims caja 20 unidades',
            'precio' => 13.5,
            'precio_compra' => 10.8,

            'stock' => 185,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Cigarrillos y Tabaco')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pilas AA',
            'codigo_barras' => '8230617029466',
            'descripcion' => 'Pilas AA 4 unidades',
            'precio' => 8.5,
            'precio_compra' => 6.8,

            'stock' => 111,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Velas',
            'codigo_barras' => '639950332819',
            'descripcion' => 'Velas aromáticas 6 unidades',
            'precio' => 5.2,
            'precio_compra' => 4.16,

            'stock' => 15,
            'estado' => false,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Lápices HB',
            'codigo_barras' => '3783042582129',
            'descripcion' => 'Lápices HB paquete 12 unidades',
            'precio' => 3.8,
            'precio_compra' => 3.04,

            'stock' => 182,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cuaderno A4',
            'codigo_barras' => '3465336010166',
            'descripcion' => 'Cuaderno A4 100 hojas',
            'precio' => 4.5,
            'precio_compra' => 3.6,

            'stock' => 169,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pilas AAA',
            'codigo_barras' => '3327073230941',
            'descripcion' => 'Pilas AAA 4 unidades',
            'precio' => 7.2,
            'precio_compra' => 5.76,

            'stock' => 183,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Fósforos',
            'codigo_barras' => '1789196792331',
            'descripcion' => 'Fósforos 10 cajas',
            'precio' => 2.5,
            'precio_compra' => 2.0,

            'stock' => 99,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Resaltadores',
            'codigo_barras' => '6052612081179',
            'descripcion' => 'Resaltadores 5 colores',
            'precio' => 6.8,
            'precio_compra' => 5.44,

            'stock' => 1,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Cinta Adhesiva',
            'codigo_barras' => '8835496627514',
            'descripcion' => 'Cinta adhesiva Scotch',
            'precio' => 3.5,
            'precio_compra' => 2.8,

            'stock' => 45,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Pilas 9V',
            'codigo_barras' => '5916906571733',
            'descripcion' => 'Pilas 9V 2 unidades',
            'precio' => 9.5,
            'precio_compra' => 7.6,

            'stock' => 165,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);

        Producto::create([
            'nombre' => 'Calculadora',
            'codigo_barras' => '2955242959877',
            'descripcion' => 'Calculadora básica',
            'precio' => 12.8,
            'precio_compra' => 10.24,

            'stock' => 172,
            'estado' => true,
            'categoria_id' => Categoria::where('nombre', 'Misceláneos')->value('id'),
        ]);
    }
}
