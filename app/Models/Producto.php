<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Venta;
class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria',
        'cantidad',
        'activo',
    ];

    public function ventas(): BelongsToMany
    {
        return $this->belongsToMany(Venta::class)
            ->withPivot('cantidad', 'precio');
    }

}
