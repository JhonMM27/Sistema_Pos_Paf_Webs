<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // use HasFactory;

    protected $fillable = ['user_id', 'cliente_id', 'fecha', 'metodo_pago', 'total', 'estado'];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        // REVISAR ESTO YA QUE NO TENGO TABLA CLIENTE EL QUE SE DIFEREBCIAS ES UN ENUM
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
