<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_solicitante',
        'valor_credito',
        'cuotas_solicitadas',
        'descripcion',
        'estado_solicitud',
        'fecha_solicitud',
        'tipo_credito',
        'observaciones_asesor'
    ];
}
