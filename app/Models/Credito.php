<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_cuenta',
        'valor_credito',
        'numero_cuotas',
        'valor_cuota',
        'cliente_solicitante',
        'fecha_aprobacion',
        'aprobador',
        'tipo_credito',
    ];
    
    public function solicitud()
{
    return $this->belongsTo(Solicitudes::class, 'solicitud_id');
}
}
