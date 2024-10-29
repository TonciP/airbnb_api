<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lugar extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantPersonas',
        'cantCamas',
        'cantBanios',
        'cantHabitaciones',
        'tieneWifi',
        'cantVehiculosParqueo',
        'precioNoche',
        'costoLimpieza',
        'ciudad',
        'latitud',
        'longitud',
        'arrendatario_id',
        // 'fotos
    ];

    function fotos(): HasMany
    {
        return $this->hasMany(Foto::class, 'lugar_id');
    }
}
