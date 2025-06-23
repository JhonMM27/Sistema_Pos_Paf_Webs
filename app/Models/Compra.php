<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['proveedor_id', 'user_id', 'fecha', 'total', 'estado'];

    protected $casts = [
        'fecha' => 'datetime',
        'total' => 'decimal:2',
    ];

    // Estados de compra
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_COMPLETADA = 'completada';
    const ESTADO_CANCELADA = 'cancelada';

    public function proveedor()
    {
        return $this->belongsTo(Provedor::class, 'proveedor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    // Métodos útiles
    public function calcularTotal()
    {
        return $this->detalles->sum('subtotal');
    }

    public function getTotalFormateadoAttribute()
    {
        return 'S/ ' . number_format($this->total, 2);
    }

    public function getEstadoColorAttribute()
    {
        return match($this->estado) {
            self::ESTADO_COMPLETADA => 'green',
            self::ESTADO_PENDIENTE => 'yellow',
            self::ESTADO_CANCELADA => 'red',
            default => 'gray'
        };
    }

    public function scopeCompletadas($query)
    {
        return $query->where('estado', self::ESTADO_COMPLETADA);
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', self::ESTADO_PENDIENTE);
    }
}
