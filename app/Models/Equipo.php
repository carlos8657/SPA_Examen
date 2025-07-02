<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{

    use SoftDeletes;

    protected $table = 'equipos';

    protected $fillable = [
        'nombre_equipo',
        'tipo_motor',
        'fecha_fabricacion',
        'potencia_kw',
        'velocidad_rpm',
    ];

    protected $casts = [
        'fecha_fabricacion' => 'date',
        'potencia_kw' => 'decimal:2',
        'velocidad_rpm' => 'integer',
    ];

}
