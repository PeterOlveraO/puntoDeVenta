<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Producto;

class Venta extends Model
{
    /** @use HasFactory<\Database\Factories\VentaFactory> */
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'monto_total',
        'metodo_pago'
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class)
            ->withPivot('cantidad', 'precio');
    }
}
