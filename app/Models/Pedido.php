<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_ped', 'nombre_ped', 'cedula_ped', 'telefono_ped', 'email_ped', 'total_ped', 'id_cli'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cli');
    }

    public function peDetalles()
    {
        return $this->hasMany(PeDetalle::class, 'id_ped');
    }
}
