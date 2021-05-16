<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestasPreguntas extends Model
{
    use HasFactory;

    protected $table = 'respuestas_preguntas';
    protected $primaryKey = 'idRespuesta';

    protected $fillable = [
        'idRespuesta',
        'respuesta',
        'rcorrecta',
        'pregunta_id'
    ];
}
