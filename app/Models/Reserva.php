<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        //'lugar_id',
        //'cliente_id',
        'fechaInicio',
        'fechaFin',
        'precioTotal',
        'precioLimpieza',
        'precioNoches',
        'precioServicio',
        'costoLimpieza',
        'ciudad',
        'latitud',
        'longitud',
        // cliente
    ];
}
