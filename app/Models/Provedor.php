<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    // use HasFactory;

    protected $fillable = [
        'nombre', 'tipo', 'ruc_dni', 'telefono', 'direccion', 'correo', 'observaciones'
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
