<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    // use HasFactory;

    protected $fillable = ['provedor_id', 'user_id', 'fecha', 'total', 'estado'];

    public function proveedor()
    {
        return $this->belongsTo(Provedor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
