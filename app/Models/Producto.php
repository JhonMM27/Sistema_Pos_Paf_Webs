<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo_barras',
        'descripcion',
        // 'unidad',
        'precio',
        'precio_compra',
        'stock',
        'estado',
        'categoria_id'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'precio_compra' => 'decimal:2',
        'stock' => 'integer',
    ];

    protected $table = 'productos';

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    // Métodos útiles para ventas
    public function tieneStock($cantidad = 1)
    {
        return $this->stock >= $cantidad;
    }

    public function reducirStock(int $cantidad): void
    {
        if (!$this->tieneStock($cantidad)) {
            throw new \Exception("No hay stock suficiente para el producto {$this->nombre}.");
        }
        $this->stock -= $cantidad;
        $this->save();
    }

    public function aumentarStock(int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new \InvalidArgumentException('La cantidad a aumentar debe ser positiva.');
        }
        $this->stock += $cantidad;
        $this->save();
    }

    public function getPrecioFormateadoAttribute()
    {
        return 'S/ ' . number_format($this->precio, 2);
    }

    public function getStockDisponibleAttribute()
    {
        return $this->stock > 0 ? $this->stock : 0;
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopeConStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopePorCodigoBarras($query, $codigo)
    {
        return $query->where('codigo_barras', $codigo);
    }

    public function scopeBuscar($query, $termino)
    {
        return $query->where(function ($q) use ($termino) {
            $q->where('nombre', 'LIKE', "%{$termino}%")
                ->orWhere('codigo_barras', 'LIKE', "%{$termino}%")
                ->orWhere('descripcion', 'LIKE', "%{$termino}%");
        });
    }
}
