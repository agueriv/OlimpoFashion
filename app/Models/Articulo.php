<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulo';

    protected $fillable = ['nombre', 'seccion', 'temporada', 'picture', 'idcategoria', 'en_rebaja', 'precio', 'precio_rebaja', 'descripcion'];

    function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'idcategoria');
    }
}
