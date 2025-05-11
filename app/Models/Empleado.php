<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    /** @use HasFactory<\Database\Factories\EmpleadoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'usuario',
        'contrasena',
        'administrador',
        'activo',
    ];

    protected $hidden = [
        'contrasena',
    ];

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'empleado_id', 'id');
    }

}
