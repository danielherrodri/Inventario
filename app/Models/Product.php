<?php

namespace App\Models;

use Database\Factories\ProductosFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'fecha_compra',
        'categoria_id',
        'sucursal_id',
        'estado_id',
        'comentarios'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    protected static function newFactory()
    {
        return ProductosFactory::new();
    }
}
