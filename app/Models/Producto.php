<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_pro','descripcion_pro','precio_pro','disponibilidad_pro','imagenRef_pro','id_categoria'];

    public function categorias(){
        return $this->belongsTo(Categoria::cass, 'id_categoria');
    }
}
