<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $table = 'devoluciones';

    protected $fillable = [
        'venta_id',
        'user_id',
        'fecha',
        'motivo',
        'total_devuelto',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'total_devuelto' => 'decimal:2',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleDevolucion::class);
    }
}
