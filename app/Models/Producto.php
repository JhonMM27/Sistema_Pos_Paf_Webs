<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'codigo_barras',
        'descripcion',
        'unidad',
        'precio',
        'stock',
        'estado',
        'categoria_id'
    ];

    protected $table = 'productos';

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
