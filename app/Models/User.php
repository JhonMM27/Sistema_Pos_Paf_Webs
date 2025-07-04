<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'TipoUsuario_id',
        'documento',
        'direccion',
        'telefono',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function TipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'TipoUsuario_id');
    }

    // Relaciones para ventas
    public function ventasComoVendedor()
    {
        return $this->hasMany(Venta::class, 'user_id');
    }

    public function ventasComoCliente()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    // Métodos útiles
    public function esEmpleado()
    {
        return $this->TipoUsuario && $this->TipoUsuario->name === 'Empleado';
    }

    public function esCliente()
    {
        return $this->TipoUsuario && $this->TipoUsuario->name === 'Cliente';
    }

    public function getTipoUsuarioNombreAttribute()
    {
        return $this->TipoUsuario ? $this->TipoUsuario->name : 'Sin tipo';
    }
}
