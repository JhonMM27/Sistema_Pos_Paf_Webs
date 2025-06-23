<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'TipoProveedor_id', 'ruc_dni', 'telefono', 'direccion', 'correo', 'observaciones'
    ];

    public function tipoProveedor()
    {
        return $this->belongsTo(TipoProveedor::class, 'TipoProveedor_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedor_id');
    }
}
