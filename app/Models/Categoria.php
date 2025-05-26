<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKay = 'id';

    protected $fillable = ['nombre'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
    
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
