<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'venta_id', 
        'producto_id', 
        'cantidad', 
        'precio_unitario', 
        'subtotal'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function devoluciones()
    {
        // Asumiendo que quieres encontrar los detalles de devolución para este producto de esta venta específica
        // Esto es complejo y podría necesitar una estructura diferente o una consulta más elaborada.
        // Por ahora, una relación simple.
        return $this->hasMany(DetalleDevolucion::class, 'producto_id', 'producto_id');
    }

    public function getCantidadDevueltaAttribute()
    {
        // Suma las cantidades devueltas para este producto en esta venta
        return DetalleDevolucion::join('devoluciones', 'detalle_devoluciones.devolucion_id', '=', 'devoluciones.id')
            ->where('devoluciones.venta_id', $this->venta_id)
            ->where('detalle_devoluciones.producto_id', $this->producto_id)
            ->sum('detalle_devoluciones.cantidad');
    }

    // Métodos útiles
    public function calcularSubtotal()
    {
        return $this->cantidad * $this->precio_unitario;
    }

    public function getSubtotalFormateadoAttribute()
    {
        return 'S/ ' . number_format($this->subtotal, 2);
    }

    public function getPrecioUnitarioFormateadoAttribute()
    {
        return 'S/ ' . number_format($this->precio_unitario, 2);
    }

    // Eventos del modelo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($detalle) {
            $detalle->subtotal = $detalle->cantidad * $detalle->precio_unitario;
        });

        static::updating(function ($detalle) {
            $detalle->subtotal = $detalle->cantidad * $detalle->precio_unitario;
        });
    }
}
