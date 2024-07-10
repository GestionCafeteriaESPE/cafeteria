<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_cli', 'cedula_cli', 'email_cli', 'telefono_cli'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cli');
    }
}
