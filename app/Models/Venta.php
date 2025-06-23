<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $fillable = [
        'user_id',
        'cliente_id',
        'fecha',
        'metodo_pago',
        'total',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'total' => 'decimal:2',
    ];

    // Estados de venta
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_COMPLETADA = 'completada';
    const ESTADO_ANULADA = 'anulada';

    // Métodos de pago
    const METODO_EFECTIVO = 'efectivo';
    const METODO_TARJETA = 'tarjeta';
    const METODO_TRANSFERENCIA = 'transferencia';
    const METODO_YAPE = 'yape';
    const METODO_PLIN = 'plin';

    public static function getMetodosPago()
    {
        return [
            self::METODO_EFECTIVO,
            self::METODO_TARJETA,
            self::METODO_TRANSFERENCIA,
            self::METODO_YAPE,
            self::METODO_PLIN,
        ];
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    // Métodos para verificar tipos de usuario
    public function getClienteAttribute()
    {
        return $this->cliente()->whereHas('tipoUsuario', function($query) {
            $query->where('name', 'Cliente');
        })->first();
    }

    public function getVendedorAttribute()
    {
        return $this->vendedor()->whereHas('tipoUsuario', function($query) {
            $query->where('name', 'Empleado');
        })->first();
    }

    // Scope para ventas con cliente
    public function scopeConCliente($query)
    {
        return $query->whereNotNull('cliente_id');
    }

    // Scope para ventas sin cliente (venta general)
    public function scopeSinCliente($query)
    {
        return $query->whereNull('cliente_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function devoluciones()
    {
        return $this->hasMany(Devolucion::class);
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
            self::ESTADO_ANULADA => 'red',
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
